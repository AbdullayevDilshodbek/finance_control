<div class="flex flex-col min-h-screen px-6 pt-12 pb-8">
    {{-- Header --}}
    <div class="flex items-center mb-10">
        <a href="/" wire:navigate class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-white ml-4">{{ __('messages.add_transaction') }}</h1>
    </div>

    {{-- Type Selection --}}
    <div class="flex flex-col gap-6 flex-1 justify-center">
        <a
            href="/add/income"
            wire:navigate
            class="flex items-center justify-center gap-3 w-full py-6 rounded-2xl bg-green-500 active:bg-green-600 text-white text-2xl font-bold shadow-lg"
        >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0-16l-4 4m4-4l4 4"/>
            </svg>
            {{ __('messages.income') }}
        </a>

        <a
            href="/add/expense"
            wire:navigate
            class="flex items-center justify-center gap-3 w-full py-6 rounded-2xl bg-red-500 active:bg-red-600 text-white text-2xl font-bold shadow-lg"
        >
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m0 16l-4-4m4 4l4-4"/>
            </svg>
            {{ __('messages.expense') }}
        </a>
    </div>
</div>
