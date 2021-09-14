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
// [ControllerClass, return function]

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [\App\Http\Controllers\HelloController::class, "index"]);

Route::get('/hello/array', [\App\Http\Controllers\HelloController::class, "array"])
    ->name("hello.array"); // name route

// ตำแหน่งพารามิเตอร์ในปีกกาต้องตรงกับตำแหน่งพารามิเตอร์ในฟังก์ชัน
// ? optional ต่อท้าย
Route::get('/posts/{id?}', [\App\Http\Controllers\HelloController::class, "posts"]);

Route::get('about', [\App\Http\Controllers\HelloController::class, "about"]);

// user-defined routes ห้ามประกาศหลัง resource routes
Route::get('apartments/{apartment}/rooms/create',
    [\App\Http\Controllers\ApartmentController::class, "createRoom"])
    ->name('apartments.rooms.create');

Route::resource('apartments',\App\Http\Controllers\ApartmentController::class);

Route::resource('rooms', \App\Http\Controllers\RoomController::class);

Route::resource('tasks', \App\Http\Controllers\TaskController::class);

Route::resource('tags', \App\Http\Controllers\TagController::class);
Route::get('tag/{slug}', [\App\Http\Controllers\TagController::class, 'showBySlug'])
    ->name('tags.slug');
