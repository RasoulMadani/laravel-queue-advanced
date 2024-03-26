<?php

namespace App\Http\Controllers;

use App\Jobs\SendVerificationEmailJob;
use App\Mail\SendVerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register()
    {

        // $validatedData = [
        //     'name' => 'hesam',
        //     'email' => 'hesam@gmail.com',
        //     'password' => '12345678'
        // ];

        // $user = User::create($validatedData);
        $user = User::whereEmail('hesam@gmail.com')->first();
        SendVerificationEmailJob::dispatch($user);
        SendVerificationEmailJob::dispatch($user);
        

        return response()->json([
            'status' => 'success'
        ]);
    }
}
