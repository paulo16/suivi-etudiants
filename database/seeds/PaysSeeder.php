<?php

use Illuminate\Database\Seeder;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the countries table
        DB::table('pays')->delete();
        $countries= Countries::all()
           ->sortBy('name');

        foreach ($countries as $value) {
            DB::table('pays')->insert([
                'officiel' => isset($value['translations']["fra"]["official"])?addslashes($value['translations']["fra"]["official"]):$value['name']["common"],
                'nom' => addslashes($value['name']["common"]),
                'capital' => $value['capital'],
                'region' => $value['region'],
            ]);
        }

    }
}
