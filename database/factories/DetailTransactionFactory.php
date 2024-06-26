<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaction>
 */
class DetailTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random transaction and menu
        $transaction = Transaction::inRandomOrder()->first();
        $menu = Menu::inRandomOrder()->first();

        return [
            'qty' => $this->faker->numberBetween(1, 5),
            'transaction_id' => $transaction->id,
            'menu_id' => $menu->id,
        ];
    }
}
