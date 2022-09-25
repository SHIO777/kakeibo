<?php
// to generate seed data -> sail php artisan db:seed --class=CategoriesSeeder
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaction::factory()->count(10)->create();
        DB::table('categories')->insert([
            [
                'kind_id' => 1,
                'category' => 'Transport',
                'description' => 'Train, Taxi, Bus, Airfares',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Daily goods',
                'description' => 'Consumable, Child-related, Pet-related, Tobacco',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Food',
                'description' => 'Groceries, Cafe, Breakfast, Lunch, Dinner',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Socializing',
                'description' => 'Party, Gifts, Ceremonial events',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Hobbies',
                'description' => 'Leisure, Events, Cinema, Music, Cartoon, Books, Games',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Education',
                'description' => 'Adult tuition fees, Newspapers, Reference book, Examination fee, Tuition, Student insurance, Cram school',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Fashion',
                'description' => 'Clothes, Accessories, Underwear, Gym, Health, Beauty salon, Cosmetics, Esthetic clinic, Laundry',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Medical',
                'description' => 'Hospital, Prescription, Life insurance',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Phone, Net',
                'description' => 'Cell phone, Fixed-line phones, Internet-related, TV license, Delivery, Postcard',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Utilities',
                'description' => 'Water, Electricity, Gas',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Home',
                'description' => 'Rent, Mortgage, Furniture, Home electronics, Reform, Home insurance',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Automobile',
                'description' => 'Gasoline, Parking, Auto insurance, Auto tax, Auto loan, Accreditation fees, Tools',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Taxes',
                'description' => 'Pension, Income tax, Sales tax, Residence tax, Corporate tax',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 1,
                'category' => 'Big outlay',
                'description' => 'Travel, Home, Automotive, Motorbike, Wedding, Childbirth, Nursing, Furniture, Home electronics',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 2,
                'category' => 'Salary',
                'description' => 'Salary',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 2,
                'category' => 'Advances repayment',
                'description' => 'Advances repayment',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 2,
                'category' => 'Bonus',
                'description' => 'Bonus',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 2,
                'category' => 'Extraordinary revenue',
                'description' => 'Extraordinary revenue',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
            [
                'kind_id' => 2,
                'category' => 'Business income',
                'description' => 'Business income',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ],
        ]);
    }
}
