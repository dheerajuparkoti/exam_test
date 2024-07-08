<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect()->route('dashboard.index');
        // }

        $email = $request->input('email');
        $password = $request->input('password');

        if ($email === '123@gmail.com' && $password === '123') {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
