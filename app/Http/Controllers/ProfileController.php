<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8',
        ]);

        $user = Auth::user();

        $user->update($request->all());

        return redirect()->route('profile')->with('message', 'Profilo aggiornato con successo');
    }
}
