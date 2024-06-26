<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get a random user with role 'user'
        $role_id = Role::where('name','user')->first()->id;
        $user = User::where('role_id', $role_id)->inRandomOrder()->first(); // Assuming role_id for 'user' is 2, adjust as per your setup

        return [
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
            'user_id' => $user->id,
        ];
    }
}
