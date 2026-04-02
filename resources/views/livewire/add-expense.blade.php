<div class="flex flex-col min-h-screen px-6 pt-12 pb-8">
    {{-- Header --}}
    <div class="flex items-center mb-10">
        <a href="/add" wire:navigate class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-red-400 ml-4">{{ __('messages.add_expense') }}</h1>
    </div>

    {{-- Form --}}
    <form wire:submit="save" class="flex flex-col gap-6 flex-1">
        <div>
            <label class="block text-sm text-gray-400 mb-2">{{ __('messages.amount') }}</label>
            <input
                type="number"
                step="0.01"
                inputmode="decimal"
                wire:model="amount"
                placeholder="0.00"
                class="w-full px-4 py-4 rounded-xl bg-gray-800 text-white text-xl border border-gray-700 focus:border-red-500 focus:outline-none"
            >
            @error('amount')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-400 mb-2">{{ __('messages.description') }}</label>
            <input
                type="text"
                wire:model="description"
                placeholder="{{ __('messages.placeholder_expense') }}"
                class="w-full px-4 py-4 rounded-xl bg-gray-800 text-white text-lg border border-gray-700 focus:border-red-500 focus:outline-none"
            >
            @error('description')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="mt-auto w-full py-4 rounded-xl bg-red-500 active:bg-red-600 text-white text-lg font-bold shadow-lg"
        >
            {{ __('messages.save_expense') }}
        </button>
    </form>
</div>
