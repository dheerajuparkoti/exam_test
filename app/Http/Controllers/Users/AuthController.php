<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificationCodeMail; // Create this Mailable class


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(Request $request)
    {
     
        
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if the "remember me" checkbox was checked

        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed; redirect to the dashboard
            return redirect()->route('dashboard.index');
        }

        // $email = $request->input('email');
        // $password = $request->input('password');

        // if ($email === '123@gmail.com' && $password === '123') {
        //     return redirect()->route('dashboard.index');
        // }

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
    //  */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([ 
    //         'name' => 'required|string|max:45', 
    //         'user_name'=>'required|string|max:20',
    //         'email'=>'required|email',
    //         'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]          
    //     ]); 
    //     Log::info('data are', $validatedData); 
    //     User::create($validatedData); 
    //     return redirect()->route('login')->with('success', 'Thank you for registration. Now login with your credentials.!'); 
    
    // }

    public function store(Request $request)
{
    // Validate form input
    $validatedData = $request->validate([
        'name' => 'required|string|max:45',
        'user_name' => 'required|string|max:20',
        'email' => 'required|email',
        'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
    ]);

    // Generate a random verification code
    $verificationCode = rand(100000, 999999); // 6-digit code

    // Store user data and the verification code in the session
    Session::put('registration_data', $validatedData);
    Session::put('verification_code', $verificationCode);
    
    // Send verification code to user's email
    Mail::to($validatedData['email'])->send(new VerificationCodeMail($verificationCode));

   // Return JSON response to show the modal
   return response()->json([
    'success' => true,
    'message' => 'A verification code has been sent to your email.',
]);
}

// Method to handle code verification
public function verifyCode(Request $request)
{
    $request->validate([
        'verification_code' => 'required|numeric',
    ]);

    // Retrieve the code from the session
    $sessionCode = Session::get('verification_code');

    // Check if the provided code matches the session code
    if ($request->verification_code == $sessionCode) {
        // Retrieve registration data from session
        $registrationData = Session::get('registration_data');
        // Create the user and clear session data
        User::create($registrationData);
        Session::forget(['registration_data', 'verification_code']);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in with your credentials.');
    }

    // If code does not match, redirect back with error
    return redirect()->back()->withErrors(['verification_code' => 'Invalid verification code. Please try again.']);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Remove the remember_token
        DB::table('users')->where('id', $user->id)->update(['remember_token' => null]);

        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the home page or any other page
        return redirect('/');
    }

}
