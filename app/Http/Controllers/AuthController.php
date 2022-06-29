<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('register');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerUser(Request $request)
    {
        $request->validate([
            'email'=> 'required|email|unique:accounts',
            'password'=> 'required|min:3',
            'confirmPassword'=>'required|min:3'
        ]);

        $password = $request->password;
        $confirmPassword = $request->confirmPassword;

        if($password == $confirmPassword){

            $account = new Account;
            $account->email = $request->email;
            $account->password = Hash::make($request->password);
            $account->save();

            $request->session()->put('msgHook','green');
            return redirect(route('login'))->with('msg', 'Registration success. Login to continue.');

        }else{

            $request->session()->put('msgHook','red');
            return redirect(route('register'))->with('msg', "Passwords don't match");

        }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:3'
        ]);

        $password = $request->password;
        $email = $request->email;

        $checkUser = Account::where('email', $email)->first();

        if($checkUser){

            if(Hash::check($password, $checkUser->password)){
                $request->session()->put('msgHook','green');
                $request->session()->put('access','granted');
                return redirect(route('indexPro'))->with('msg', 'Login success.');
            }else{
                $request->session()->put('msgHook','green');
                return redirect(route('login'))->with('msg', 'Wrong Password.');
            }

            $request->session()->put('msgHook','green');
            return redirect(route('login'))->with('msg', 'Registration success. Login to continue.');

        }else{

            $request->session()->put('msgHook','red');
            return redirect(route('login'))->with('msg', "No such user.");

        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
