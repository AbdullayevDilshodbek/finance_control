<div class="flex items-center gap-1">
    <button
        wire:click="switchLanguage('en')"
        class="px-2 py-1 rounded text-xs font-medium {{ $locale === 'en' ? 'bg-blue-500 text-white' : 'bg-gray-800 text-gray-400' }}"
    >
        EN
    </button>
    <button
        wire:click="switchLanguage('uz')"
        class="px-2 py-1 rounded text-xs font-medium {{ $locale === 'uz' ? 'bg-blue-500 text-white' : 'bg-gray-800 text-gray-400' }}"
    >
        UZ
    </button>
</div>
