<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $transactions = [
            ['type' => 'income', 'amount' => 5000.00, 'description' => 'Salary'],
            ['type' => 'income', 'amount' => 200.00, 'description' => 'Freelance work'],
            ['type' => 'income', 'amount' => 50.00, 'description' => 'Cashback reward'],
            ['type' => 'expense', 'amount' => 1200.00, 'description' => 'Rent payment'],
            ['type' => 'expense', 'amount' => 85.50, 'description' => 'Groceries'],
            ['type' => 'expense', 'amount' => 45.00, 'description' => 'Internet bill'],
            ['type' => 'expense', 'amount' => 30.00, 'description' => 'Transport'],
            ['type' => 'income', 'amount' => 150.00, 'description' => 'Sold old phone'],
            ['type' => 'expense', 'amount' => 22.00, 'description' => 'Coffee & snacks'],
            ['type' => 'expense', 'amount' => 60.00, 'description' => 'Phone top-up'],
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
