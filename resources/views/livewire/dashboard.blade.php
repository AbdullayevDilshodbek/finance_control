<div class="flex flex-col min-h-screen px-6 pt-10 pb-24">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold text-white">{{ __('messages.daily_tracker') }}</h1>
            <button
                wire:click="toggleBalanceVisibility"
                class="w-9 h-9 rounded-full bg-gray-800 flex items-center justify-center active:bg-gray-700"
                title="{{ $balanceHidden ? __('messages.show_balance') : __('messages.hide_balance') }}"
            >
                @if($balanceHidden)
                    {{-- Eye-off icon --}}
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l18 18"/>
                    </svg>
                @else
                    {{-- Eye icon --}}
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                @endif
            </button>
        </div>
        <div class="flex items-center gap-2">
            <livewire:language-switcher />
            <a href="/monthly" wire:navigate class="px-3 py-2 rounded-lg bg-gray-800 active:bg-gray-700 text-gray-400 text-xs font-medium">{{ __('messages.monthly') }}</a>
        </div>
    </div>

    {{-- Date Navigation --}}
    <div class="flex items-center justify-between mb-6">
        <button wire:click="previousDay" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center active:bg-gray-700">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <div class="text-center">
            <p class="text-white text-sm font-medium">{{ $displayDate }}</p>
            @if(!$isToday)
                <button wire:click="goToToday" class="text-blue-400 text-xs mt-1">{{ __('messages.back_to_today') }}</button>
            @endif
        </div>
        <button wire:click="nextDay" class="w-10 h-10 rounded-full {{ $isToday ? 'bg-gray-800/50' : 'bg-gray-800' }} flex items-center justify-center active:bg-gray-700" {{ $isToday ? 'disabled' : '' }}>
            <svg class="w-5 h-5 {{ $isToday ? 'text-gray-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-3 gap-3 mb-8">
        <div class="bg-gray-800 rounded-xl p-3 overflow-hidden">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.income') }}</p>
            <p class="text-sm font-bold text-green-400 truncate">{{ $balanceHidden ? '••••••' : number_format($totalIncome, 2) }}</p>
        </div>
        <div class="bg-gray-800 rounded-xl p-3 overflow-hidden">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.expense') }}</p>
            <p class="text-sm font-bold text-red-400 truncate">{{ $balanceHidden ? '••••••' : number_format($totalExpense, 2) }}</p>
        </div>
        <div class="bg-gray-800 rounded-xl p-3 overflow-hidden">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.balance') }}</p>
            <p class="text-sm font-bold {{ $balance >= 0 ? 'text-white' : 'text-red-400' }} truncate">{{ $balanceHidden ? '••••••' : number_format($balance, 2) }}</p>
        </div>
    </div>

    {{-- Chart --}}
    @if($transactions->count() > 0 && !$balanceHidden)
        <div class="bg-gray-800 rounded-xl p-4 mb-8">
            <canvas id="dailyChart" height="180"></canvas>
        </div>
    @endif

    {{-- Transaction List --}}
    <h2 class="text-lg font-semibold text-white mb-4">{{ $isToday ? __('messages.todays_transactions') : __('messages.dates_transactions', ['date' => \Carbon\Carbon::parse($selectedDate)->format('M d')]) }}</h2>

    @if($transactions->count() > 0)
        <div class="flex flex-col gap-3">
            @foreach($transactions as $transaction)
                <div class="flex items-center bg-gray-800 rounded-xl px-4 py-3" wire:key="txn-{{ $transaction->id }}">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $transaction->type === 'income' ? 'bg-green-500/20' : 'bg-red-500/20' }}">
                        @if($transaction->type === 'income')
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0-16l-4 4m4-4l4 4"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m0 16l-4-4m4 4l4-4"/>
                            </svg>
                        @endif
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-white text-sm font-medium">{{ $transaction->description }}</p>
                        <p class="text-gray-500 text-xs">{{ $transaction->created_at->format('H:i') }}</p>
                    </div>
                    <p class="text-sm font-bold {{ $transaction->type === 'income' ? 'text-green-400' : 'text-red-400' }} mr-3">
                        @if($balanceHidden)
                            ••••••
                        @else
                            {{ $transaction->type === 'income' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                        @endif
                    </p>
                    <button
                        wire:click="deleteTransaction({{ $transaction->id }})"
                        wire:confirm="{{ __('messages.delete_confirm') }}"
                        class="w-8 h-8 rounded-full bg-red-500/10 flex items-center justify-center active:bg-red-500/30"
                    >
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16">
            <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="text-gray-500 text-lg">{{ $isToday ? __('messages.no_transactions_today') : __('messages.no_transactions_on_this_day') }}</p>
            <p class="text-gray-600 text-sm mt-1">{{ __('messages.tap_to_add') }}</p>
        </div>
    @endif

    {{-- FAB Button --}}
    <a
        href="/add"
        wire:navigate
        class="fixed bottom-8 right-6 w-16 h-16 rounded-full bg-blue-500 active:bg-blue-600 flex items-center justify-center shadow-xl"
    >
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
    </a>
</div>

@if($transactions->count() > 0 && !$balanceHidden)
    @script
    <script>
        const ctx = document.getElementById('dailyChart');
        if (ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['{{ __('messages.income') }}', '{{ __('messages.expense') }}'],
                    datasets: [{
                        data: [{{ $totalIncome }}, {{ $totalExpense }}],
                        backgroundColor: ['#22c55e', '#ef4444'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { color: '#9ca3af', padding: 16 }
                        }
                    },
                    cutout: '60%',
                }
            });
        }
    </script>
    @endscript
@endif
