<?php

namespace App\Http\Controllers;
use App\Models\SightSeen;
use Illuminate\Http\Request;

class SightSeensController extends Controller
{
    
    public function getPopularSightSeen()
    {
    	$sightseens = Sightseen::select('ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country')
                    ->join('ce_cities','ce_cities.city_code','=','ce_sightseen.city' )
                    // ->orderBy('popularity', 'desc')
                    ->take(4)
                    ->get();

        return response()->json($sightseens);
    }
}
