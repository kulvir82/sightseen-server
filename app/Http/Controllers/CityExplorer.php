<?php
namespace App\Http\Controllers;
Use View;
use App\Models\CityExplorerModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Storage;

class CityExplorer extends Controller
{

  public function getCountry()
  {
    $model = new CityExplorerModel;
    $countries = $model->getCountries();
    return  response()->json($countries);
  }

  public function getCity(Request $request)
  {

    $countryID = $request->country;
    $model = new CityExplorerModel;
    $cities = $model->getCities($countryID);
    return response()->json($cities);
  }

  public function getSightSeenFromCountry(Request $request)
  {
    $model = new CityExplorerModel;
    $sightseen = $model->getSightSeenFromCountry($request);
    return response()->json($sightseen);
  }

  public function sight_seen()
	{
    $model = new CityExplorerModel;
    $sightseen = $model->getSightSeen();
    return response()->json($sightseen);
	}

	public function createSightSeen(Request $request)
	{
    $imageData = $_FILES;
    $model = new CityExplorerModel;
    $sightseen = $model->createSightSeen($request,$imageData);
    return response()->json($sightseen);
	}

  public function searchSight(Request $request)
  {
    $model = new CityExplorerModel;
    $sightseen = $model->searchSightSeen($request);
    return response()->json($sightseen);
  }

	public function set_sightseen()
	{

		$this->load->model('User_Model');
		$success=$this->User_Model->set_sightseen_db($_POST);
			if($success==1)
			{redirect('/users/sight_seen/', 'refresh');}

	}
	public function getSightSeen(Request $request)
	{
    $model = new CityExplorerModel;
    $singlesightseen = $model->getSingleSight($request->id);
    $city = $singlesightseen->city;
    $country = $singlesightseen->country;
    $selecteableCities = $model->getCities($country);
    $selectedCity = $model->getSingleCity($city);
    $singlesightseen['cityname'] = $selectedCity;
    $singlesightseen['citiesList'] = $selecteableCities;
    return response()->json($singlesightseen);
	}

  public function cityForEditPage($city)
  {
    $model = new CityExplorerModel;

    return $selectedCity;
  }

	public function updatesight(Request $request)
	{
    $model = new CityExplorerModel;
    $sightseen = $model->updateSightSeen($request);
    return response()->json($sightseen);
	}

  public function getProductDetail(Request $request)
  {
    $model = new CityExplorerModel;
    $productDetail = $model->getProductDetail($request);
    return response()->json($productDetail);
  }

	public function updateImages(Request $request)
	{
    $imageData = $_FILES;
    $model = new CityExplorerModel;
    $updatedImages = $model->updateImageSeen($request,$imageData);
    return response()->json($updatedImages);
	}

  public function getImages(Request $request)
  {
    $model = new CityExplorerModel;
    $images = $model->getImages($request->id);
    return response()->json($images);
  }

	public function singleSightSeen(Request $request)
	{
    $model = new CityExplorerModel;
    $singleSight = $model->getSingleSight($request->id);
    $countryID = $singleSight->country;
    $city_code = $singleSight->city;
    $singleCountry = $model->getSingleSightCountry($countryID);
    $singleCity = $model->getSingleSightCity($city_code);
    $singleSight['countryName'] = $singleCountry;
    $singleSight['cityName'] = $singleCity;
    return response()->json($singleSight);
	}

  public function removeImage(Request $request)
  {
    $model = new CityExplorerModel;
    $removed = $model->removeSelectedImage($request);
    return response()->json($removed);
  }

	public function delete_sight(Request $request)
	{
    $model = new CityExplorerModel;
    $singleSight = $model->deleteSightSeen($request->id);
    return response()->json($singleSight);

	}

}
