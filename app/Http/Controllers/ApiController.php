<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function featuredProducts() {
        $products = Product::where('featured', 1)
                            ->where('quantity', '>', 0)   
                            ->get();

        return response()->json([
            'status' => 'OK',
            'products' => $products
        ], 200);
    }

    public function productsByCategory($id) {
        if($id === '*')
            $products = Product::where('quantity', '>', 0)->get();
        else
            $products = Product::where('quantity', '>', 0)->where('category_id', $id)->get();

        return response()->json([
            'status' => 'OK',
            'products' => $products
        ], 200);
    }

    public function deleteEditor($id) {
        if(auth()->user()->role != 'ADMIN') {
            return response()->json([
                'status' => 'ERROR',
                'msg' => __('auth.failed')
            ], 401);
        }

        $user = User::where('id', $id)
                    ->where('role', 'EDITOR')
                    ->first();

        if(!$user) {
            return response()->json([
                'status' => 'ERROR',
                'msg' => 'Došlo je do greške prilikom brisanja editora.'
            ], 400);
        }

        $user->delete();
        
        return response()->json([
            'status' => 'OK',
            'msg' => 'Uspešno ste obrisali administratora.'
        ], 200);
    }

    public function addAdministrator() {
        if(auth()->user()->role != 'ADMIN') {
            return response()->json([
                'status' => 'ERROR',
                'msg' => __('auth.failed')
            ], 401);
        }

        $validator = Validator::make(request()->all(),[ 
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role' => 'required|string|in:ADMIN,EDITOR',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            $errors = $validator->errors();

            return response()->json([
                'status' => 'ERROR',
                'msg' => $errors
            ], 400);
        }

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
            'password' => Hash::make(request('password'))
        ]);

        return response()->json([
            'status' => 'OK',
            'msg' => 'Uspešno ste dodali administratora/editora.'
        ], 200);
    }
}
