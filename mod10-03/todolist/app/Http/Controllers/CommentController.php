<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Auth;
use Illuminate\Http\Request;
use Session;

class CommentController extends Controller
{

    public function addComment(Request $request)
    {
        $new_comment = new comment();
        $new_comment->comments = $request->comment;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->task_id = $request->task_id;
        $new_comment->save();

        return redirect("/");
    }

}
