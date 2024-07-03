<?php

use Illuminate\Support\Facades\Route;



Route::get('/user', function () {
    return view('users.license_mcq.index');
});
Route::get('/', function () {
    return view('users.home.index');
});


Route::get('/', function () {
    return view('users.about.index');
});
