<?php

namespace App\Livewire;

use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public string $selectedDate = '';

    public bool $balanceHidden = false;

    public function mount(): void
    {
        $this->selectedDate = now()->toDateString();
        $this->balanceHidden = Setting::get('balance_hidden', '0') === '1';
    }

    public function toggleBalanceVisibility(): void
    {
        $this->balanceHidden = ! $this->balanceHidden;
        Setting::set('balance_hidden', $this->balanceHidden ? '1' : '0');
    }

    public function previousDay(): void
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subDay()->toDateString();
    }

    public function nextDay(): void
    {
        $next = Carbon::parse($this->selectedDate)->addDay()->toDateString();

        if ($next <= now()->toDateString()) {
            $this->selectedDate = $next;
        }
    }

    public function goToToday(): void
    {
        $this->selectedDate = now()->toDateString();
    }

    public function deleteTransaction(int $id): void
    {
        Transaction::findOrFail($id)->delete();
    }

    public function render()
    {
        $transactions = Transaction::whereDate('created_at', $this->selectedDate)
            ->latest()
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $isToday = $this->selectedDate === now()->toDateString();
        $displayDate = Carbon::parse($this->selectedDate)->format('l, M d, Y');

        return view('livewire.dashboard', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'isToday' => $isToday,
            'displayDate' => $displayDate,
        ])->layout('layouts.app');
    }
}
