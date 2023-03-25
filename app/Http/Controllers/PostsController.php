<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //if active is not checked set it to 0else set it to 1
        $data['active'] = $request->has('active') ?'Y' : 'N';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/post_images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
        //insert data into database response json data with scuccess message
        $response =DB::table('posts')->insert($data);
        return response()->json(['success' => 'Post created successfully.'], 200);

    }
}
