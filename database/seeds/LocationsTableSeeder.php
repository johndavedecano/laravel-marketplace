<?php

use Illuminate\Database\Seeder;
use App\Location;
use Illuminate\Database\Connection as DB;

class LocationsTableSeeder extends Seeder
{
    private $locations = [
        'Manila',
        'Quezon City',
        'Caloocan',
        'Pasay',
        'Las Piñas',
        'Makati',
        'Malabon',
        'Mandaluyong',
        'Marikina',
        'Muntinlupa',
        'Navotas',
        'Parañaque',
        'Pasig',
        'San Juan',
        'Taguig',
        'Valenzuela',
        'Pateros'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();

        foreach ($this->locations as $location) {
            Location::create([
                'name' => $location
            ]);
        }
    }
}
