<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index() {
        $users = User::whereIn('role', ['ADMIN', 'EDITOR'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store() {
        $validator = request()->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role' => 'required|string|in:ADMIN,EDITOR',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'role' => $validator['role'],
            'password' => Hash::make($validator['password'])
        ]);

        return redirect()->route('adminUsers')->with('success', 'Uspešno ste dodali administratora.');
    }

    public function destroy($id) {
        $user = User::where('id', $id)
                    ->where('role', 'EDITOR')
                    ->first();

        if(!$user) {
            return redirect()->route('adminUsers')->with('error', 'Došlo je do greške prilikom brisanja administratora.');
        }

        $user->delete();
        
        return redirect()->route('adminUsers')->with('success', 'Uspešno ste obrisali administratora.');
    }
}
