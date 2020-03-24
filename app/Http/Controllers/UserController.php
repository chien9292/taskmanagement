<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users($role)
    {
        if (Auth::user()->role == consts('user.role.manager')) {
            $users = User::where('group_id', Auth::user()->managed_group)->get();
        } else {
            switch ($role) {
                //search available manager to assign to a group
                case 'manager':
                    $assigned_managers = Group::whereNotNull('manager_id')->get(['manager_id']);
                    $users = User::where('role', '2')->whereNotIn('id', $assigned_managers)->get();
                    break;
                //search available employee to assign to a group
                case 'employee':
                    $users = User::where('role', '3')->where('group_id', null)->get();
                    break;
                default:
                    $users = User::where('role', '!=', '1')->get();
                    break;
            }
        }
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function store(CreateRequest $request, User $user)
    {
        $data = $request->merge([
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ])->all();
        $user->create($data);
        return response()->json([
            'message' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->merge([
            'updated_by' => Auth::user()->id,
        ])->all();
        $user->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!($user->group()->first()) && !($user->managed_group()->first())) {
            $user->delete();
            $user->update(['updated_by' => Auth::user()->id]);
            return response()->json([
                "message" => "success"
            ]);
        } else {
            return response()->json([
                "message" => "Can not delete user, they are already in group"
            ]);
        }
    }
}
