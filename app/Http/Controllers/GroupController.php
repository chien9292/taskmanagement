<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\CreateRequest;
use App\Http\Requests\Group\UpdateRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Group\CreateRequest  $request
     * @return json
     */
    public function store(CreateRequest $request, Group $group)
    {
        $data = $request->merge([
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ])->all(); 
        $createdGroup = $group->create($data);
        //update manager
        if (request('manager_id')) {
            User::where('id', request('manager_id'))->update(['group_id' => $createdGroup->id, 'updated_by' => Auth::user()->id,]);
        }
        //update members
        if (request('members')) {
            User::whereIn('id', request('members'))->update(['group_id' => $createdGroup->id, 'updated_by' => Auth::user()->id,]);
        }
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
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Group $group)
    {
        //update group
        $data = $request->merge([
            'updated_by' => Auth::user()->id,
        ])->all(); 
        $group->update($data);
        //update manager
        if (request('manager_id')) {
            User::where('id', request('manager_id'))->update(['group_id' => $group->id, 'updated_by' => Auth::user()->id,]);
        }
        //update members
        if (request('members')) {
            User::whereIn('id', request('members'))->update(['group_id' => $group->id, 'updated_by' => Auth::user()->id,]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
