<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Auth;
use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function displayTasks()
    {
        $comments = Comment::all();
        $tasks = Task::all();
        $user_id = Auth::user()->id;
        // $tasks = Auth::user()->tasks; //display only tasks by logged-in user

        return view("tasks", compact("tasks", "comments", "user_id"));
    }

    public function addTask(Request $request)
    {
        $new_task = new Task();
        $new_task->name = $request->task;
        $new_task->user_id = Auth::user()->id;
        $new_task->save();
        
        return redirect("/");
    }
    
    public function editTask(Request $request, $id)
    {
        $edit_task = Task::find($id);
        
        $rules = array(
            "task" => "required | min:5",
        );
        $this->validate($request, $rules);
        
        $edit_task->name = $request->task;
        $edit_task->save();

    }

    public function deleteTask($id)
    {
        $comment = Comment::where("task_id", $id)->delete();
        $task = Task::find($id)->delete();

        Session::flash("status", "Task was successfully deleted!");

        return redirect("/");
    }
}
