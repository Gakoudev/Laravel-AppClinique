<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll()
    {
        $roles=Role::all();
        $users=User::all();
        return view('user.user',['roles'=>$roles,'users'=>$users]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'etat' => 1,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make('passer'),
        ]);
        return redirect()->route('listUser');
    }

    public function update($id)
    {
        $user=User::find($id);
        $user->etat=1-$user->etat;
        $user->save();
        return redirect()->route('listUser');
    }

}
