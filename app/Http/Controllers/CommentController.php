<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Notifications\RepliedToThread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request, Forum $forum)
    {
        $request->validate([
            'content' => 'required|min:5'
        ]);
        $comment = New Comment;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $forum->comments()->save($comment);

        // auth()->user->notify(new RepliedToThread());
        auth()->user()->notify(new RepliedToThread($forum));


        return back()->withInfo('Komentar Terkirim. ');

    }

    public function replyComment(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|min:5'
        ]);
        $reply = New Comment;
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;

        $comment->comments()->save($reply);

        return back()->withInfo('Komentar Balasan Terkirim. ');

    }
}
