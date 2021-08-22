<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumreadController extends Controller
{
    public function index()
    {
        $forumread = Forum::paginate(5);
        return view('dahsboard.users.forumread.index', compact('forumread'));

    }
}
