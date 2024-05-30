<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    // Borrar post
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
        }
        return redirect('/');
    }

    // Edición de post
    public function actuallyUpdatePost(Post $post, Request $request) {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }
    
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required|string|in:Completado,Drop,Platinado,On-Hold',
            'platform' => ['nullable', 'string', 'in:PS1,PS2,PS3,PS4,PS5,XBOX,XBOX360,XBOX One,XBOX Series X|S,Nintendo SW,Nintendo DS,Nintendo 3DS,PC']
        ]);
    
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
    
        $post->update($incomingFields);
        return redirect('/');
    }
    
    // Edición de post, vista de edición de post
    public function showEditScreen(Post $post) {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    // Buscar por nombre de usuario y que me salgan los posts 
    public function searchUserPosts(Request $request) {
        $user = User::where('name', 'like', '%' . $request->query('query') . '%')->first();
        $posts = $user ? $user->posts : [];
        return view('user-searchpost', compact('user', 'posts'));
    }
    
    // Creación de post
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required|string|in:Completado,Drop,Platinado,On-Hold',
            'platform' => ['required', 'string', Rule::in(['PS1','PS2','PS3','PS4','PS5','XBOX','XBOX360','XBOX One','XBOX Series X|S','Nintendo SW','Nintendo DS','Nintendo 3DS','PC'])]
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }
}
