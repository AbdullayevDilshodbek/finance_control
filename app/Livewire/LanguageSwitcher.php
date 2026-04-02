<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $locale = '';

    public function mount(): void
    {
        $this->locale = app()->getLocale();
    }

    public function switchLanguage(string $locale): void
    {
        if (in_array($locale, ['en', 'uz'])) {
            session(['locale' => $locale]);
            $this->locale = $locale;
            $this->redirect(request()->header('Referer', '/'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
