<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login-google');
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    
    $userExists = User::where('external_id',$user->id)->where('external_auth', 'google')->first();
    //dd($userExists);
    if($userExists){
        Auth::login($userExists);
    }else{
        $userNew = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'google',
        ]);

        Auth::login($userNew);
    }
    return redirect('/dashboard');
    // $user->token
});

Route::get('/login-github', function () {
    return Socialite::driver('github')->redirect();
})->name('login-github');

Route::get('/github-callback', function () {
    $user = Socialite::driver('github')->user();
    
    $userExists = User::where('external_id',$user->id)->where('external_auth', 'github')->first();
    dd($userExists);
    //dd($userExists);
    if($userExists){
        Auth::login($userExists);
    }else{
        $userNew = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'github',
        ]);

        Auth::login($userNew);
    }
    return redirect('/dashboard');
    // $user->token
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
