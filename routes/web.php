<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PostManageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpDownController;
use App\Http\Middleware\IpLimit;
use App\StrRandom;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function (StrRandom $random) {  // ★ ← 注目
    $secret = $random->get(10);

    return view('welcome', compact('secret'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('login', function () {
    return 'ログイン画面';
})->name('login');

Route::middleware('auth')->group(function () {
    // 認証が必要なページ
    Route::get('members', [MemberController::class, 'index']);
    Route::get('members/posts', [PostManageController::class, 'index'])->name('posts.index');
    Route::post('members/posts', [PostManageController::class, 'store'])->name('posts.store');
    Route::get('members/posts/{post}/edit', [PostManageController::class, 'edit'])->name('posts.edit');
    Route::put('members/posts/{post}', [PostManageController::class, 'update'])->name('posts.update');
    Route::delete('members/posts/{post}', [PostManageController::class, 'destroy'])
        ->name('posts.destroy')
        ->middleware(IpLimit::class);
});

Route::get('avatar', [AvatarController::class, 'index']);
Route::post('avatar', [AvatarController::class, 'store']);

Route::get('updown', [UpDownController::class, 'index']);
Route::post('updown', [UpDownController::class, 'download']);

Route::get('enter', function () {
    $uuid = Str::uuid();

    return redirect('result/'.$uuid);
});
