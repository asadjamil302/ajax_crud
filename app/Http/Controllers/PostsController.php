<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    // public function index()
    // {
    //     $posts = DB::table('posts')->paginate(10);
    //     return view('posts.index', ['posts' => $posts]);
    // }
    public function index(Request $request)
    {
        $query = DB::table('posts');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', '%'.$searchTerm.'%')
                ->orWhere('id', $searchTerm)
                ->orWhere('active', $searchTerm);
            });
        }

        $posts = $query->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }
}
