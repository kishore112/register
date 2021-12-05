<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Hash;


class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function registration(){
        return view('auth.register');
    }
    public function postLogin(){
        $request_validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully logged in');
        }
  
        return redirect("login")->withSuccess('Sorry! You have entered invalid credentials');
            }

        public function postRegistration(){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
               
            $data = $request->all();
            $check = $this->create($data);
             
            return redirect("login")->withSuccess('Great! please login.');
        }

        public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}

