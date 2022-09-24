<?php
// sail artisan make:factory TransactionFactory --model==Transaction
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kind_id' => $this->faker->numberBetween(1, 2),
            'category_id' => $this->faker->numberBetween(21, 38),
            'price' => $this->faker->numberBetween(1000, 50000),
            'date' => $this->faker->date(),
            'place' => $this->faker->streetName(),
            'note' => $this->faker->realText($this->faker->numberBetween(10, 20)),
        ];
    }
}
