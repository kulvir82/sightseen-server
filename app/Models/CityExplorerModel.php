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
      $sightseen->country_id =  $request->country_id;
      $sightseen->city_id = $request->city_id;
      $sightseen->information = $request->information;
      $sightseen->pickup = $request->pickup;
      $sightseen->discount = $request->discount;
      $sightseen->latitude = $request->latitude;
      $sightseen->longitude = $request->longitude;
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
    public function getSingleSightCountry($country_id)
    {
      $country = Countries::where('id',$country_id)->value('country_name');
      return $country;
    }

    public function getCities($country_id)
    {
      $cities = Cities::select('city_name','id')->where('country_id', $country_id)->get()->toArray();
      return $cities;
    }

    public function getSingleSightCity($city_id)
    {
      $city = Cities::where('id',$city_id)->value('city_name');
      return $city;
    }

    public function getSightSeen($request)
  	{
      if($request->has('country'))
        $sightseen = Sightseen::where('country_id',$request->country)->where('city_id', $request->city)->paginate(10);
      else
        $sightseen = Sightseen::paginate(10);
      return $sightseen;
  	}

    public function getPopularSightSeen(){
      $sightseens = Sightseen::select(DB::raw('round(ce_sightseen.price, 2) as price'),'ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country_id')
                    ->join('ce_cities','ce_cities.id','=','ce_sightseen.city_id' )
                    ->orderBy('popularity', 'desc')
                    ->take(10)
                    ->get();
      
      $sightseens = $this->setSightSeenData($sightseens); 

      return $sightseens;
    }

    public function getSightSeenFromCountry($request)
    {
      $sightseens =  Sightseen::where('ce_sightseen.country_id',$request->country)
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country_id')
                    ->join('ce_cities','ce_cities.id','=','ce_sightseen.city_id' )
                    ->select(DB::raw('round(ce_sightseen.price, 2) as price'),'ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->get();

      $sightseens = $this->setSightSeenData($sightseens);              

      return $sightseens;
    }

    public function getSightSeenFromCity($request)
    {
      $sightseens =  Sightseen::where('ce_sightseen.city_id',$request->city)
                    ->join('ce_countries','ce_countries.id','=','ce_sightseen.country_id')
                    ->join('ce_cities','ce_cities.id','=','ce_sightseen.city_id' )
                    ->select(DB::raw('round(ce_sightseen.price, 2) as price'),'ce_sightseen.*','ce_countries.country_name','ce_cities.city_name')
                    ->get();

      $sightseens = $this->setSightSeenData($sightseens); 

      return $sightseens;
    }

    public function setSightSeenData($sightseens)
    {
      $data = array();
      $i= 0;
      
      foreach($sightseens as $sightseen)
      {
        $data[$i]['id'] = $sightseen->id;
        $data[$i]['title'] = $sightseen->title;
        $data[$i]['image1'] = $sightseen->image1;
        $data[$i]['image2'] = $sightseen->image2;
        $data[$i]['image3'] = $sightseen->image3;
        $data[$i]['image4'] = $sightseen->image4;
        $data[$i]['description'] = $sightseen->description;
        $data[$i]['information'] = $sightseen->information;
        $data[$i]['price'] = $sightseen->price;
        $data[$i]['popularity'] = $sightseen->popularity;
        $data[$i]['discount'] = $sightseen->discount;
        $data[$i]['pickup'] = $sightseen->pickup;
        $data[$i]['country_name'] = $sightseen->country_name;
        $data[$i]['city_name'] = $sightseen->city_name;
        $data[$i]['latitude'] = $sightseen->latitude;
        $data[$i]['longitude'] = $sightseen->longitude;
        $data[$i]['city_id'] = $sightseen->city_id;
        $data[$i]['country_id'] = $sightseen->country_id;
        $data[$i]['comment_count'] = $sightseen->feedbacks->count();

        $i++;
      }

      return $data;
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
        $discount = $request->discount;
        $description = $request->description;
        $information = $request->info;
        $country_id = $request->country_id;
        $city_id = $request->city_id;
        $pickup = $request->pickup;
        $lat = $request->latitude;
        $lng = $request->longitude;
        $sightseen = Sightseen::where('id','=',$id)->update(['title' => $title,'country_id'=>$country_id, 'city_id'=> $city_id,'price' => $price, 'discount' => $discount, 'description' => $description, 'information' => $information,'pickup'=>$pickup,'latitude'=>$lat,'longitude'=>$lng]);
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
      $singleSight = Sightseen::where('id',$id)->first()->toArray();
      return $singleSight;
  	}

    public function getSingleCity($city)
    {
      $selectedCity = Cities::where('city',$city_id)->value('city_name');
      return $selectedCity;
    }

  	public function deleteSightSeen($id)
  	{
      	$deletedRows = Sightseen::where('id', $id)->delete();
        return 'Sight seen deleted';
  	}

    public function searchSightSeen($request)
    {
      $searchedSights = Sightseen::where('country_id',$request->country)->where('city_id',$request->city)->paginate(10);
      return $searchedSights;
    }

}
