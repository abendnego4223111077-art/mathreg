<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\PemantikController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FinalReflectionController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LkpdController;
use App\Http\Controllers\QuizController;
Route::get('/', [StartController::class, 'index'])->name('start');
Route::post('/start', [StartController::class, 'store'])->name('start.store');
Route::post('/logout', [StartController::class, 'logout'])->name('logout');

Route::get('/petunjuk', [LearningController::class, 'petunjuk'])->name('petunjuk');
Route::get('/petunjuk2', [LearningController::class, 'petunjuk2'])->name('petunjuk2');
Route::get('/petunjuk3', [LearningController::class, 'petunjuk3'])->name('petunjuk3');
Route::get('/petunjuk4', [LearningController::class, 'petunjuk4'])->name('petunjuk4');
Route::get('/tujuan2', [LearningController::class, 'tujuan2'])->name('tujuan2');
Route::get('/tujuan', [LearningController::class, 'tujuan'])->name('tujuan');
Route::get('/orientasi', [LearningController::class, 'orientasi'])->name('orientasi');
Route::get('/orientasi2', [LearningController::class, 'orientasi2'])->name('orientasi2');

Route::get('/pemantik', [PemantikController::class, 'index'])->name('pemantik');
Route::post('/pemantik', [PemantikController::class, 'store'])->name('pemantik.store');

Route::get('/kelompok', [GroupController::class, 'index'])->name('kelompok');
Route::post('/kelompok/random', [GroupController::class, 'random'])->name('kelompok.random');

Route::get('/presentasi', [PresentationController::class, 'index'])->name('presentasi');
Route::get('/presentasi2', [PresentationController::class, 'index2'])->name('presentasi2');
Route::get('/presentasi3', [PresentationController::class, 'index3'])->name('presentasi3');
Route::post('/presentasi', [PresentationController::class, 'store'])->name('presentasi.store');
Route::post('/presentasi/{presentation}/like', [PresentationController::class, 'like'])->name('presentasi.like');

Route::get('/evaluasi', [LearningController::class, 'evaluasi'])->name('evaluasi');

Route::get('/kuis', [QuizController::class, 'index'])->name('kuis');
Route::get('/kuis2', [QuizController::class, 'index2'])->name('kuis2');
Route::post('/kuis/submit', [QuizController::class, 'submit'])->name('kuis.submit');
Route::get('/kuis/result/{quizResult}', [QuizController::class, 'result'])->name('kuis.result');
Route::get('/kuis2/result/{quizResult}', [QuizController::class, 'result2'])->name('kuis2.result');

Route::get('/lkpd', [LkpdController::class, 'index'])->name('lkpd');
Route::post('/lkpd/scatter', [LkpdController::class, 'saveScatter'])->name('lkpd.scatter');
Route::post('/lkpd/manual-line', [LkpdController::class, 'saveManualLine'])->name('lkpd.manual-line');
Route::post('/lkpd/ols', [LkpdController::class, 'calculateOls'])->name('lkpd.ols');
Route::get('/selesai', [LearningController::class, 'selesai'])->name('selesai');
Route::get('/selesai2', [LearningController::class, 'selesai2'])->name('selesai2');

Route::post('/final-reflection', [FinalReflectionController::class, 'store'])
    ->name('final-reflection.store');



    Route::get('/guru/login', [TeacherController::class, 'loginPage'])->name('guru.login');
Route::post('/guru/login', [TeacherController::class, 'login'])->name('guru.login.submit');
Route::post('/guru/logout', [TeacherController::class, 'logout'])->name('guru.logout');

Route::get('/guru/dashboard', [TeacherController::class, 'dashboard'])->name('guru.dashboard');
Route::get('/guru/students', [TeacherController::class, 'students'])->name('guru.students');
Route::get('/guru/pemantik', [TeacherController::class, 'pemantik'])->name('guru.pemantik');
Route::get('/guru/presentations', [TeacherController::class, 'presentations'])->name('guru.presentations');
Route::get('/guru/lkpds', [TeacherController::class, 'lkpds'])->name('guru.lkpds');
Route::get('/guru/quizzes', [TeacherController::class, 'quizzes'])->name('guru.quizzes');
Route::get('/guru/reflections', [TeacherController::class, 'reflections'])->name('guru.reflections');