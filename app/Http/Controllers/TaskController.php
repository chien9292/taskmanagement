<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Get list of personal task
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $tasks = $user->personal_tasks;
        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request, Task $task)
    {
        $addition = [];
        //Auto approve task created by manager or admin
        if (Auth::user()->role != consts('user.role.user')) {
            $addition = [
                'approved_at' => Carbon::now(),
                'approved_by' => Auth::user()->id,
            ];
        }
        //If assignee is set, assigner is set too
        if(request('assignee_id')) {
            $addition['assigned_by'] = Auth::user()->id;
        }
        $request->merge($addition);
        $data = $request->merge([
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ])->all();
        $task->create($data);
        return response()->json([
            'message' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
