<?php

use App\Models\Ville;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the countries table
        /**
        DB::table('villes')->delete();
        $states =Countries::where('name.common', 'Morocco')
        ->first()
        ->states
        ->sortBy('name');

        foreach ($states as $value) {
            DB::table('villes')->insert([
                'nom' => $value['name'],
                'longitude' => $value['longitude'],
                'latitude' => $value['latitude'],
            ]);
        }
        **/

            // Uncomment the below to wipe the table clean before populating
        DB::table('villes')->delete();

        $csvFile = public_path().'/assets/help-data/ville.csv';
        $handle = fopen($csvFile, "r");
        $header = true;
            
        while ($csvLine = fgetcsv($handle, 1000, ",")) {
        
            if ($header) {
                $header = false;
            } else {
                Ville::create([
                    'region' => $csvLine[0] ,
                    'nom' => mb_strtoupper($csvLine[1],'UTF-8'),
                ]);
            }
        }

   
     
    }
}