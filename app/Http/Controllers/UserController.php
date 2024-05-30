<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Login successful');
        }

        return redirect('/')->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request) {
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede tener más de 10 caracteres.',
            'name.unique' => 'El nombre ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 200 caracteres.',
        ];

        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ], $messages);

        $incomingFields['password'] = Hash::make($incomingFields['password']);
        $user = User::create($incomingFields);
        Auth::login($user);
        return redirect('/')->with('success', 'Registro exitoso. Bienvenido a GameBase!');
    }

    public function search(Request $request) {
        $query = $request->input('query');

        // Buscar usuarios que coincidan con la consulta
        $users = User::where('name', 'LIKE', "%$query%")->get();

        // Para cada usuario encontrado, obtener sus posts asociados
        foreach ($users as $user) {
            $user->load('posts');
        }

        // Pasar los usuarios y sus posts a la vista
        return view('user-search-results', ['users' => $users]);
    }
}
