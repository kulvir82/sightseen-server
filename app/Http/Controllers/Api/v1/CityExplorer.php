<?php
namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
Use View;
use App\Models\CityExplorerModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityExplorer extends Controller
{

  public function getCountry()
  {
    $model = new CityExplorerModel;
    $countries = $model->getCountries();
    return response()->json(['countries'=>$countries, 'success'=>true],200);
  }

  public function getPopularSightSeen()
	{
    $model = new CityExplorerModel;
    $sightseens = $model->getPopularSightSeen();
    return response()->json(['sightseens'=>$sightseens,'success'=>true],200);
	}

  public function getSightSeenFromCountry(Request $request)
  {
    $model = new CityExplorerModel;
    $sightseens = $model->getSightSeenFromCountry($request);
    return response()->json(['sightseens'=>$sightseens,'success'=>true],200);
  }

  public function getSightSeenFromCity(Request $request)
  {
    $model = new CityExplorerModel;
    $sightseens = $model->getSightSeenFromCity($request);
    return response()->json(['sightseens'=>$sightseens,'success'=>true],200);
  }

}
