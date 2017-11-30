<?php
namespace App\Models;

use File;
use DB;
use App\Http\Controllers\api\v1;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Sightseen;
use Illuminate\Contracts\Filesystem\Filesystem;
class CityExplorerModel extends Model
{
    //
    public function createSightSeen($request,$imageData)
  	{
      $sightseen = new Sightseen;
      $sightseen->title = $request->title;
      $sightseen->description = $request->description;
      $sightseen->price = $request->price;
      $sightseen->country =  $request->countryID;
      $sightseen->city = $request->city;
      $sightseen->information = $request->information;
      $i = 1;
      $images = "image";
      $imagename = "";
      $s3 = \Storage::disk('s3');
      foreach($imageData['file']['name'] as $index => $imagename){
        $filePath = 'sightseenimages/' . $imagename;
        $s3->put($filePath, file_get_contents($imageData['file']['tmp_name'][$index]), 'public');
        $image = $images.$i;
        $sightseen->$image = $s3->url('sightseenimages/'.$imagename);
        $i = $i + 1;
      }
      $sightseen->save();
      return 'datasaved';
  	}


    public function getCountries()
    {
      $countries = Countries::select('country_name','id')->orderBy('country_name','ASC')->get();
      return  $countries;
    }
    public function getSingleSightCountry($countryID)
    {
      $country = Countries::where('id',$countryID)->value('country_name');
      return $country;
    }

    public function getCities($countryID)
    {
      $cities = Cities::select('city_name','city_code')->where('country_id', $countryID)->get();
      $cities = $cities->toArray();

      return $cities;
    }

    public function getSingleSightCity($city_code)
    {
      $city = Cities::where('city_code',$city_code)->value('city_name');
      return $city;
    }

    public function getSightSeen()
  	{
      $sightseen = Sightseen::paginate(10);
      return $sightseen;
  	}
    public function getSightSeenFromCountry($request)
    {
      $sightseen =  Sightseen::where('country',$request->country)
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country')
                    ->join('ce_cities','ce_cities.city_code','=','ce_sightseen.city' )
                    ->select('ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->get();

      return $sightseen;
    }

    public function getSightSeenFromCity($request)
    {
      $sightseen =  Sightseen::where('city',$request->city)
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country')
                    ->join('ce_cities','ce_cities.city_code','=','ce_sightseen.city' )
                    ->select('ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->get();

      return $sightseen;
    }
    public function getProductDetail($request)
    {
      $ids = explode(',',$request->product_ids);
        $products = Sightseen::whereIn('id',$ids)->get();
      return $products;
    }
  	public function updateSightSeen($request)
  	{
        $id = $request->id;

        $title = $request->title;
        $price = $request->price;
        $description = $request->description;
        $information = $request->info;
        $country = $request->countryID;
        $city = $request->cityCode;
        $sightseen = Sightseen::where('id','=',$id)->update(['title' => $title,'country'=>$country, 'city'=> $city,'price' => $price, 'description' => $description, 'information' => $information]);
        return 'success';
  	}
    public function updateImageSeen($request,$imageData)
    {

      $id = $request->id;
      $s3 = \Storage::disk('s3');
      $imagename = $imageData['file']['name'];
      $filePath = 'sightseenimages/' . $imagename;
      $s3->put($filePath, file_get_contents($imageData['file']['tmp_name']), 'public'); 
      $emptyImages = Sightseen::select('image1','image2','image3','image4')->where('id','=',$id)->first();
      if($emptyImages->image1 == ''){
         //move_uploaded_file($imageData['file']['tmp_name'], public_path().'/uploads/images/'.$imagename);
         $sightseen = Sightseen::where('id','=',$id)->update(['image1' => $s3->url('sightseenimages/'.$imagename)]);
         return $imageData;
      }
      if($emptyImages->image2 == ''){
         // move_uploaded_file($imageData['file']['tmp_name'], public_path().'/uploads/images/'.$imagename);
         $sightseen = Sightseen::where('id','=',$id)->update(['image2' => $s3->url('sightseenimages/'.$imagename)]);
         return 'image2 uploaded';
      }
      if($emptyImages->image3 == ''){
         // move_uploaded_file($imageData['file']['tmp_name'], public_path().'/uploads/images/'.$imagename);
         $sightseen = Sightseen::where('id','=',$id)->update(['image3' => $s3->url('sightseenimages/'.$imagename)]);
         return 'image3 uploaded';
      }
      if($emptyImages->image4 == ''){
         // move_uploaded_file($imageData['file']['tmp_name'], public_path().'/uploads/images/'.$imagename);
         $sightseen = Sightseen::where('id','=',$id)->update(['image4' => $s3->url('sightseenimages/'.$imagename)]);
         return 'image4 uploaded';
      }
    }
    public function removeSelectedImage($request)
    {
      $s3 = \Storage::disk('s3');
      $filename = explode("/",$request->image);
      $s3->delete('sightseenimages/'.end($filename));
      $sightseen = Sightseen::where('id','=',$request->id)->update([$request->column => '']);
      return 'image removed';
    }
    public function getImages($id)
    {
      $refreshedImages = Sightseen::select('image1','image2','image3','image4')->where('id','=',$id)->first();
      return $refreshedImages;
    }
    public function getSingleSight($id)
  	{
      $singleSight = Sightseen::where('id',$id)->first();

      return $singleSight;
  	}

    public function getSingleCity($city)
    {
      $selectedCity = Cities::where('city_code',$city)->value('city_name');
      return $selectedCity;
    }

  	public function deleteSightSeen($id)
  	{
      	$deletedRows = Sightseen::where('id', $id)->delete();
        return 'Sight seen deleted';
  	}

    public function searchSightSeen($request)
    {
      $searchedSights = Sightseen::where('country','like',$request->country)->orWhere('city','like',$request->city)->paginate(10);
      return $searchedSights;
    }

}
