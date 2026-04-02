<div class="flex flex-col items-center justify-center min-h-screen px-6">
    {{-- Counter Display --}}
    <div class="mb-16">
        <span class="text-9xl font-bold text-white select-none">{{ $count }}</span>
    </div>

    {{-- Plus / Minus Buttons --}}
    <div class="flex items-center gap-8 mb-10">
        <button
            wire:click="decrement"
            class="w-20 h-20 rounded-full bg-red-500 active:bg-red-600 text-white text-4xl font-bold flex items-center justify-center shadow-lg"
        >
            &minus;
        </button>

        <button
            wire:click="increment"
            class="w-20 h-20 rounded-full bg-green-500 active:bg-green-600 text-white text-4xl font-bold flex items-center justify-center shadow-lg"
        >
            +
        </button>
    </div>

    {{-- Reset Button --}}
    <button
        wire:click="resetCounter"
        class="px-8 py-3 rounded-full bg-gray-600 active:bg-gray-700 text-white text-sm font-medium shadow"
    >
        Reset
    </button>
</div>
