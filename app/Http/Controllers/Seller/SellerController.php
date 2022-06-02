<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function create(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ]);

        $user = new Seller();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->passowrd = Hash::make($req->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'You are now registered successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');

        }
    }
    public function check(Request $req)
    {
//validate input
        $req->validate([
            'email' => 'required|email|exists:sellers,email',
            'password' => 'required|min:5|max:15',
        ], [
            'email.exists' => 'This email is not exists in Seller table',
        ]);

        $data = $req->only('email', 'password');

        if (Auth::guard('seller')->attempt($data)) {
            return redirect()->route('seller.home');
        } else {
            return redirect()->route('seller.login')->with('fail', 'Incorrect credentials');
        }
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect('/');
    }
}
