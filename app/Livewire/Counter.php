<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function decrement(): void
    {
        if ($this->count > 0) {
            $this->count--;
        }
    }

    public function resetCounter(): void
    {
        $this->count = 0;
    }

    public function render()
    {
        return view('livewire.counter')
            ->layout('layouts.app');
    }
}
