<?php

use App\Livewire\AddExpense;
use App\Livewire\AddIncome;
use App\Livewire\AddTransaction;
use App\Livewire\Dashboard;
use App\Livewire\MonthlySummary;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class);
Route::get('/add', AddTransaction::class);
Route::get('/add/income', AddIncome::class);
Route::get('/add/expense', AddExpense::class);
Route::get('/monthly', MonthlySummary::class);
