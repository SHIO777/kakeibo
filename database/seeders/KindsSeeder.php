<?php
// to generate seed data -> sail php artisan db:seed --class=KindsSeeder
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kind;

class KindsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kinds')->insert([
            [
                'kind' => 'Payment',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind' => 'Income',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
        ]);
    }
}
