<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function indexRegister()
    {
        return view("register");
    }  

    public function storeRegister(Request $request)
    {
        $dataRequest = $request->all();
        $request->validate([
            'name'=>['required', 'string', 'min:3', 'max:255'],
            'email'=>['required','string', 'email', 'unique:users,email'],
            'password'=>['required','string', 'min:8'],
        ]);

        // Generate 6 digit token
        $token = rand(100000, 999999);

        // Simpan token ke session sementara
        session(['verification_token' => $token, 'email_verification' => $request->email]);

        if($request->password === $request->confirmPassword) {  
            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
            ]);

        // Kirim token melalui email
        Mail::send('emails.verify-email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification');
        });

            return redirect()->route('verify')->with('success', 'Token verifikasi telah dikirim ke email Anda.');
        } else {
            return redirect()->route('register.form')->with('failed','password not match')->withInput($dataRequest);
        }
    }

    public function indexLogin()
    {
        return view('login');
    }

    //Login validation
    public function authenticate(Request $request)
    {
        
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'Email not registered.']);
        }

        //cek verifikasi email berdasarkan email_verified_at
        if (! $user->email_verified_at) {
            return redirect()->route('login.form')->with('error', 'email belum  terverifikasi, silahkan cek email anda untuk verifikasi');
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withInput()->withErrors(['password' => 'Email and password do not match.']);
        }
        return redirect()->route('login.form')->with('error', 'Email or password is incorrect');
        
    }

    public function verify()
    {
        return view('verifyEmail');
    }

    public function verifyPost(Request $request)
    {
        $request->validate([
            'token' => 'required|digits:6',
        ]);

        // Ambil token dari session
        $storedToken = session('verification_token');
        $email = session('email_verification');

        if ($request->input('token') == $storedToken) {
            // Verifikasi email berhasil
            $user = User::where('email', $email)->first();
            if ($user && !$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();

                // Hapus token dari session
                session()->forget(['verification_token', 'email_verification']);

                return redirect()->route('login.form')->with('status', 'Email berhasil diverifikasi, silakan login.');
            } else {
                return redirect()->route('verify')->withErrors(['token' => 'Email sudah diverifikasi.']);
            }
        } else {
            return redirect()->route('verify')->withErrors(['token' => 'Token tidak valid.']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/login');
    }

    

}