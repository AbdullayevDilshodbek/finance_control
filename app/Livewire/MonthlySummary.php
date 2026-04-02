<?php

namespace App\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class MonthlySummary extends Component
{
    public string $selectedMonth = '';

    public function mount(): void
    {
        $this->selectedMonth = now()->format('Y-m');
    }

    public function previousMonth(): void
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth.'-01')->subMonth()->format('Y-m');
    }

    public function nextMonth(): void
    {
        $next = Carbon::parse($this->selectedMonth.'-01')->addMonth()->format('Y-m');

        if ($next <= now()->format('Y-m')) {
            $this->selectedMonth = $next;
        }
    }

    public function render()
    {
        $start = Carbon::parse($this->selectedMonth.'-01')->startOfMonth();
        $end = Carbon::parse($this->selectedMonth.'-01')->endOfMonth();

        $transactions = Transaction::whereBetween('created_at', [$start, $end])
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $dailyBreakdown = $transactions->groupBy(fn ($t) => $t->created_at->format('Y-m-d'))
            ->map(fn ($dayTransactions) => [
                'date' => Carbon::parse($dayTransactions->first()->created_at)->format('M d, D'),
                'income' => $dayTransactions->where('type', 'income')->sum('amount'),
                'expense' => $dayTransactions->where('type', 'expense')->sum('amount'),
                'count' => $dayTransactions->count(),
            ])
            ->sortKeysDesc()
            ->values();

        $isCurrentMonth = $this->selectedMonth === now()->format('Y-m');
        $displayMonth = Carbon::parse($this->selectedMonth.'-01')->format('F Y');

        return view('livewire.monthly-summary', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'dailyBreakdown' => $dailyBreakdown,
            'isCurrentMonth' => $isCurrentMonth,
            'displayMonth' => $displayMonth,
        ])->layout('layouts.app');
    }
}
