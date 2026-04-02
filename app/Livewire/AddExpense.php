<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class AddExpense extends Component
{
    public string $amount = '';

    public string $description = '';

    protected function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
        ];
    }

    public function save(): void
    {
        $this->validate();

        Transaction::create([
            'type' => 'expense',
            'amount' => $this->amount,
            'description' => $this->description,
        ]);

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.add-expense')
            ->layout('layouts.app');
    }
}
