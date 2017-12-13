<?php

use Illuminate\Database\Seeder;

class CountriesCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// countries data
    	echo "seeding countries\n";
    	$country_data =array(
    				array('country_name'=>'Thailand'),
					array('country_name'=>'Malaysia'),
				    array('country_name'=>'United Arab Emirates'),
					array('country_name'=>'Singapore'),	
				);
    	DB::table('ce_countries')->insert($country_data);
		// cities data
		echo "seeding cities\n";
        $data =array(
				array('city_name'=>'Bangkok' , 'country_id'=>1),
				array('city_name'=>'Pattaya' , 'country_id'=>1),
				array('city_name'=>'Phuket' , 'country_id'=>1),
				array('city_name'=>'Ko Samui' , 'country_id'=>1),
				array('city_name'=>'Krabi' , 'country_id'=>1),
				array('city_name'=>'Kuala Lumpur' , 'country_id'=>2),
				array('city_name'=>'Penang' , 'country_id'=>2),
				array('city_name'=>'Langkawi' , 'country_id'=>2),
				array('city_name'=>'Gentingh Highland' , 'country_id'=>2),
				array('city_name'=>'Johor Legoland' , 'country_id'=>2),
				array('city_name'=>'Dubai' , 'country_id'=>3),
				array('city_name'=>'Singapore' , 'country_id'=>4),
		);

		DB::table('ce_cities')->insert($data);
    }
}
