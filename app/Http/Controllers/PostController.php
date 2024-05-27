<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Borrar post
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
        }
        return redirect('/');
    }
//Edicion de post
    public function actuallyUpdatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
    
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required|string|in:Completado,Drop,Platinado,On-Hold'
        ]);
    
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
    
        $post->update($incomingFields);
        return redirect('/');
    }
    
//Edicion de post, vista de edicion de post
    public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    //Bucar por nombre de usuario y que me salgan los post 
    public function searchUserPosts(Request $request) {
        $user = User::where('name', 'like', '%' . $request->query('query') . '%')->first();
        $posts = $user ? $user->posts : [];
        return view('user-searchpost', compact('user', 'posts'));
    }
    
    // Creacion de post  

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required|string|in:Completado,Drop,Platinado,On-Hold'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }
}
