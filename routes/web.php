<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/app', function (){
    return view('app');
});

Route::get('/reset-password/{token}',function($token){
    return view('auth.password-reset', ['token'=>$token]) ;
})
->middleware(['guest:'.config('fortify.guard')])
->name('password.reset');



if(\Illuminate\Support\Facades\App::environment('local')){

    \Illuminate\Support\Facades\App::setLocale('en');
    // $trans = \Illuminate\Support\Facades\Lang::get('auth.failed');
    // $trans = __('auth.password');
    // $trans = __('auth.throttle',['seconds' => 5]);

    //dd(\Illuminate\Support\Facades\App::currentLocale());
    // dump(App::isLocal('en'));

    //you can use json file in translation
    // $trans = __('password');
    // dd($trans);

    //$trans = trans_choice('auth.pants',0);
    // $trans = trans_choice('auth.apples', 5, ['baskets'=>2]);
    // dd($trans);


    $trans = __('auth.welcome' , ['name'=> 'ahmed']);
    dd($trans);

    Route::get('playground' , function(){
        $user = \App\Models\User::factory()->make();
        Illuminate\Support\Facades\Mail::to($user)
            ->send(new  \App\Mail\welcomeMail($user));
        return null;
    });
};
