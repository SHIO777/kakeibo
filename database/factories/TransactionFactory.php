<?php
// sail artisan make:factory TransactionFactory --model==Transaction
// php artisan db:seed --class=TransactionsSeeder
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
        // https://stackoverflow.com/questions/45930892/how-to-parse-a-faker-datetimebetween-with-carbon-in-laravel
        // 過去1ヶ月間での収入支出を記録する
        $events = $this->faker->dateTimeBetween('-30 days', 'now');

        // // kind => Payment（支出）のとき
        // return [
        //     'user_id' => $this->faker->numberBetween(1, 10),
        //     'kind_id' => $this->faker->numberBetween(1, 1),
        //     'category_id' => $this->faker->numberBetween(1, 14),
        //     'price' => $this->faker->numberBetween(1000, 50000),
        //     // 'date' => $this->faker->date(),
        //     'date' => $events->format('Y-m-d'),     // dateTimeをフォーマット変換
        //     'place' => $this->faker->streetName(),
        //     'note' => $this->faker->realText($this->faker->numberBetween(10, 20)),
        // ];

        // // kind => Income（収入）のとき
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'kind_id' => $this->faker->numberBetween(2, 2),
            'category_id' => $this->faker->numberBetween(15, 19),
            'price' => $this->faker->numberBetween(1000, 50000),
            // 'date' => $this->faker->date(),
            'date' => $events->format('Y-m-d'),     // dateTimeをフォーマット変換
            'place' => $this->faker->streetName(),
            'note' => $this->faker->realText($this->faker->numberBetween(10, 20)),
        ];
    }
}
