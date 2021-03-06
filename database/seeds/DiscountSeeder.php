<?php

use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = new DateTime();
        App\Discount::create([
            'code' => 'TestDevinweb',
            'percentage' => 10,
            'created_at' => $dt->format('Y-m-d H:i:s')
        ]);
    }
}
