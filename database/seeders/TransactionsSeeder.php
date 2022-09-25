<?php
// sail php artisan make:seeder TransactionsSeeder
// to generate seed data -> sail php artisan db:seed --class=TransactionsSeeder
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory()->count(20)->create();
    }
}
