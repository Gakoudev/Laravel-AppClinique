<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getAll()
    {
        if (Session::has('user')) {
            $roles=Role::all();
            $users=User::all();
            return view('user.user',['roles'=>$roles,'users'=>$users]);
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }
    public function add(Request $request)
    {
        if (Session::has('user')) {
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
                'roles_id' => $request->role,
                'email' => $request->email,
                'password' => Hash::make('passer'),
            ]);
            return redirect()->route('listUser');
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

    public function update($id)
    {
        if (Session::has('user')) {
            $user=User::find($id);
            $user->etat=1-$user->etat;
            $user->save();
            return redirect()->route('listUser');
        }
        else {
            Auth::guard('web')->logout();
            return redirect('/');
        }
    }

}
