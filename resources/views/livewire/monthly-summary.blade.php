<div class="flex flex-col min-h-screen px-6 pt-10 pb-24">
    {{-- Header --}}
    <div class="flex items-center mb-6">
        <a href="/" wire:navigate class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center active:bg-gray-700 mr-3">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-white">{{ __('messages.monthly_summary') }}</h1>
    </div>

    {{-- Month Navigation --}}
    <div class="flex items-center justify-between mb-6">
        <button wire:click="previousMonth" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center active:bg-gray-700">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <p class="text-white text-sm font-medium">{{ $displayMonth }}</p>
        <button wire:click="nextMonth" class="w-10 h-10 rounded-full {{ $isCurrentMonth ? 'bg-gray-800/50' : 'bg-gray-800' }} flex items-center justify-center active:bg-gray-700" {{ $isCurrentMonth ? 'disabled' : '' }}>
            <svg class="w-5 h-5 {{ $isCurrentMonth ? 'text-gray-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- Monthly Totals --}}
    <div class="grid grid-cols-3 gap-3 mb-8">
        <div class="bg-gray-800 rounded-xl p-4">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.income') }}</p>
            <p class="text-lg font-bold text-green-400">{{ number_format($totalIncome, 2) }}</p>
        </div>
        <div class="bg-gray-800 rounded-xl p-4">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.expense') }}</p>
            <p class="text-lg font-bold text-red-400">{{ number_format($totalExpense, 2) }}</p>
        </div>
        <div class="bg-gray-800 rounded-xl p-4">
            <p class="text-xs text-gray-400 mb-1">{{ __('messages.balance') }}</p>
            <p class="text-lg font-bold {{ $balance >= 0 ? 'text-white' : 'text-red-400' }}">{{ number_format($balance, 2) }}</p>
        </div>
    </div>

    {{-- Chart --}}
    @if($totalIncome > 0 || $totalExpense > 0)
        <div class="bg-gray-800 rounded-xl p-4 mb-8">
            <canvas id="monthlyChart" height="180"></canvas>
        </div>
    @endif

    {{-- Daily Breakdown --}}
    <h2 class="text-lg font-semibold text-white mb-4">{{ __('messages.daily_breakdown') }}</h2>

    @if($dailyBreakdown->count() > 0)
        <div class="flex flex-col gap-3">
            @foreach($dailyBreakdown as $day)
                <div class="bg-gray-800 rounded-xl px-4 py-3">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-white text-sm font-medium">{{ $day['date'] }}</p>
                        <p class="text-gray-500 text-xs">{{ $day['count'] }} {{ $day['count'] === 1 ? __('messages.transaction_singular') : __('messages.transaction_plural') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-green-400 text-sm">+{{ number_format($day['income'], 2) }}</p>
                        <p class="text-red-400 text-sm">-{{ number_format($day['expense'], 2) }}</p>
                        @php $dayBalance = $day['income'] - $day['expense']; @endphp
                        <p class="text-sm font-bold {{ $dayBalance >= 0 ? 'text-white' : 'text-red-400' }}">{{ number_format($dayBalance, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16">
            <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">{{ __('messages.no_transactions_this_month') }}</p>
        </div>
    @endif
</div>

@if($totalIncome > 0 || $totalExpense > 0)
    @script
    <script>
        const ctx = document.getElementById('monthlyChart');
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
