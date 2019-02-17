<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Faker\Factory as Faker;

class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all('id')->toArray();
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('adverts')->insert([
                'title' => $faker->word,
                'description' => $faker->paragraph,
                'created_at'=>date('Y-m-d H:i:s'),
                'user_id'=>$users[rand(0,count($users)-1)]['id'],
                'photo'=>'/img/all_adverts/sm.Xiaomi-Redmi-5-official-renders-1-1.750.jpg'
            ]);
        }
    }
}
