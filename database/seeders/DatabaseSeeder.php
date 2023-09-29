<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Price;
use App\Models\queue;
use App\Models\Relation;
use App\Models\Vehicles;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Driver::factory(100)->create();
        // Vehicles::factory(100)->create();

        // $driver = Driver::all();
        // $vehicle = Vehicles::all();

        // foreach ( $driver as $i => $value) {
        //     Relation::create([
        //         'driver_id' => $driver[$i]->id,
        //         'vehicle_id' => $vehicle[$i]->id,
        //         'category_id' => $vehicle[$i]->category_id,
        //     ]);
        // }


        // $Relation = Relation::all();

        // foreach ($Relation as $value) {
        //     queue::create([
        //         'relation_id' => $value->id,
        //         'arrive_time' => fake()->dateTimeThisMonth(),
        //     ]);
        // }

        // $Category[] = [ 'type' => 'Hatchback','fair'=>30];
        // $Category[] = ['type' => 'Super Hatchback', 'fair'=>55];
        // $Category[] = ['type' =>'Sedan', 'fair'=>35];
        // $Category[] = ['type' =>'Suv', 'fair'=>45];
        // $Category[] = ['type' =>'Super Suv', 'fair'=>40];

        // foreach ($Category as $values) {
        //     Category::create([
        //         'type' => $values['type'],
        //         'fair' => $values['fair']
        //     ]);
        // }

        // Price::create([
        //     'cgst' => 15,
        //     'sgst'=> 15,
        //     'igst'=> 15,
        //     'night_charges' => 300,
        //     'booking_charges'=>500,
        // ]);

        admin::create([
            'name'=>'admin',
            'email'=>'admin123@gmail.com',
            'password'=>Hash::make('admin123@'),
        ]);

            // Customer::factory(4000)->create();

    }
}
