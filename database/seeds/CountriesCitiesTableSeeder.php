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
    	echo "sedding countries\n";
    	$country_data =array(
    				array('country_name'=>'Thailand'),
					array('country_name'=>'Malaysia'),
				    array('country_name'=>'United Arab Emirates'),
					array('country_name'=>'Singapore'),	
				);
    	DB::table('ce_countries')->insert($country_data);

		// cities data
		echo "sedding cities\n";
        $data =array(
				array('city_name'=>'Bangkok' , 'country_id'=>1),
				array('city_name'=>'Nonthaburi' , 'country_id'=>1),
			    array('city_name'=>'Nakhon Ratchasima' , 'country_id'=>1),
				array('city_name'=>'Chiang Mai' , 'country_id'=>1),
		        array('city_name'=>'Hat Yai' , 'country_id'=>1),
				array('city_name'=>'Udon Thani' , 'country_id'=>1),
				array('city_name'=>'Pak Kret' , 'country_id'=>1),
				array('city_name'=>'Chaophraya Surasak' , 'country_id'=>1),
				array('city_name'=>'Khon Kaen' , 'country_id'=>1),
				array('city_name'=>'Ubon Ratchathani' , 'country_id'=>1),
				array('city_name'=>'Nakhon Si Thammarat' , 'country_id'=>1),
				array('city_name'=>'Nakhon Sawan' , 'country_id'=>1),
				array('city_name'=>'Nakhon Pathom' , 'country_id'=>1),
				array('city_name'=>'Phitsanulok' , 'country_id'=>1),
				array('city_name'=>'Pattaya' , 'country_id'=>1),
				array('city_name'=>'Songkhla' , 'country_id'=>1),
				array('city_name'=>'Surat Thani' , 'country_id'=>1),
				array('city_name'=>'Rangsit' , 'country_id'=>1),
				array('city_name'=>'Yala' , 'country_id'=>1),
				array('city_name'=>'Phuket' , 'country_id'=>1),
				array('city_name'=>'Samut Prakan' , 'country_id'=>1),
				array('city_name'=>'Lampang' , 'country_id'=>1),
				array('city_name'=>'Laem Chabang' , 'country_id'=>1),
				array('city_name'=>'Chiang Rai' , 'country_id'=>1),
				array('city_name'=>'Trang' , 'country_id'=>1),
				array('city_name'=>'Phra Nakhon Si Ayutthaya' , 'country_id'=>1),
				array('city_name'=>'Ko Samui' , 'country_id'=>1),
				array('city_name'=>'Samut Sakhon' , 'country_id'=>1),
				array('city_name'=>'Rayong' , 'country_id'=>1),
				array('city_name'=>'Mae Sot' , 'country_id'=>1),
				array('city_name'=>'Om Noi' , 'country_id'=>1),
				array('city_name'=>'Sakon Nakhon' , 'country_id'=>1),
				array('city_name'=>'Krabi' , 'country_id'=>1),
				array('city_name'=>'Kuala Lumpur' , 'country_id'=>2),
				array('city_name'=>'Penang Island' , 'country_id'=>2),
				array('city_name'=>'Ipoh' , 'country_id'=>2),
				array('city_name'=>'Petaling Jaya' , 'country_id'=>2),
				array('city_name'=>'Shah Alam' , 'country_id'=>2),
				array('city_name'=>'Iskandar Puteri' , 'country_id'=>2),
				array('city_name'=>'Johor Bahru' , 'country_id'=>2),
				array('city_name'=>'Malacca City' , 'country_id'=>2),
				array('city_name'=>'Kota Kinabalu' , 'country_id'=>2),
				array('city_name'=>'Alor Setar' , 'country_id'=>2),
				array('city_name'=>'Kuala Terengganu' , 'country_id'=>2),
				array('city_name'=>'Kuching' , 'country_id'=>2),
				array('city_name'=>'Miri' , 'country_id'=>2),
				array('city_name'=>'Ajman' , 'country_id'=>3),
				array('city_name'=>'Al ain' , 'country_id'=>3),
				array('city_name'=>'Dubai' , 'country_id'=>3),
				array('city_name'=>'Fujairah' , 'country_id'=>3),
				array('city_name'=>'Khorfakkan' , 'country_id'=>3),
				array('city_name'=>'Ras al khaimah' , 'country_id'=>3),
				array('city_name'=>'Sharjah' , 'country_id'=>3),
				array('city_name'=>'Umm al quwain' , 'country_id'=>3),
				array('city_name'=>'Singapore' , 'country_id'=>4),
		);

		DB::table('ce_cities')->insert($data);
    }
}
