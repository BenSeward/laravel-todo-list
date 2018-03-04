<?php

namespace App\Http\Controllers;

use App\task;
use Illuminate\Http\Request;
use Session;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the users ID and display only their posts
        $getUserId = Auth::user()->id;
        
        $tasks = Task::where('user_id', $getUserId)->orderBy('id', 'desc')->paginate(5);
        return view('tasks.index')->with('storedTasks', $tasks);
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
    public function store(Request $request)
    {
        //
        $this->validate($request, [
          'newTaskName' => 'required | min: 5 | max:255',
        ]);
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->status = 'incomplete';
        $task->name = $request->newTaskName;

        $task->save();
        Session::flash('success', 'New task has successfully been added.');

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        return view('tasks.edit')->with('taskUnderEdit', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
          'updatedTaskName' => 'required | min: 5 | max:255',
          'updateTaskStatus' => 'required',
        ]);

        $task = Task::find($id);

        // Adding validation for checking if status is complete or incomplete
        if($request->updateTaskStatus == 'complete' || $request->updateTaskStatus == 'incomplete' ){
          $task->status = $request->updateTaskStatus;
        };

        $task->name = $request->updatedTaskName;

        $task->save();

        Session::flash('success', 'Task #' . $id . ' has been updated successfully.');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
