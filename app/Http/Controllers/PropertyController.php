<?php

namespace App\Http\Controllers;

use App\Http\Resources\amenitiesResource;
use App\Models\amenities;
use App\Models\properties;
use Illuminate\Http\Request;
use App\Models\property_images;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\imgsResource;
use App\Http\Resources\propsResource;
use App\Http\Resources\detailsResource;
use App\Http\Resources\propertyResource;
use App\Http\Resources\locationsResource;

class PropertyController extends Controller
{
    public function all_properties(){

        return propertyResource::collection(DB::table('properties')
           ->select( 'properties.id', 'properties.name', 'properties.category', 'properties.type',
                     'properties.cost', 'properties.display', 'locations.loc_name')
           ->leftJoin( 'locations', 'locations.properties_id', '=', 'properties.id')
           ->get()  );
    }

    public function nearby_properties(Request $request){
        $loc=$request->location;

        return propertyResource::collection(DB::table('properties')
           ->select( 'properties.id', 'properties.name', 'properties.category', 'properties.type',
                     'properties.cost', 'properties.display', 'locations.loc_name')
           ->leftJoin( 'locations', 'locations.properties_id', '=', 'properties.id')
           ->where('locations.loc_name', '=', $loc)
           ->get()  );
    }


    public function details_property(Request $request){
        $prop_id =$request->prop_id;
            return detailsResource::collection(DB::table('properties')
                  ->select( 'properties.id', 'properties.name', 'properties.category', 'properties.type', 'properties.description',
                  'properties.owner_contact', 'properties.cost', 'locations.loc_name', 'locations.longitude', 'locations.latitude')
                  ->leftJoin( 'locations', 'locations.properties_id', '=', 'properties.id')
                  ->where('properties.id', '=', $prop_id)
                  ->get()  );
    }


    public function imgs_property(Request $request ){
        $prop_id =$request->prop_id;
        return imgsResource::collection(Property_images::where('properties_id',$prop_id)->get());

    }


    public function all_categories(Request $request){
        $category = $request->category;
        // return propertyResource::collection(properties::where('category', $category)->get());

        return propertyResource::collection(DB::table('properties')
                  ->select( 'properties.id', 'properties.name', 'properties.category', 'properties.type',
                   'properties.cost', 'properties.display', 'locations.loc_name')
                  ->leftJoin( 'locations', 'locations.properties_id', '=', 'properties.id')
                  ->where('properties.category', '=', $category)
                  ->get()  );
    }


    public function all_locations(){
       return locationsResource::collection(DB::table('locations')->select('loc_name')->get());
    }


    public function prop_names(){
        return propsResource::collection(DB::table('properties')->select('type')->get());
    }


    public function search_properties( Request $request){
        $category = $request-> category;
        $location = $request-> location;
        $cost = $request-> cost;
        $type = $request-> type;

        return propertyResource::collection(DB::table('properties')
        ->select( 'properties.id', 'properties.name', 'properties.category', 'properties.type',
                    'properties.cost', 'properties.display', 'locations.loc_name')
        ->leftJoin( 'locations', 'locations.properties_id', '=', 'properties.id')
        ->where('properties.category', 'LIKE', '%' .$category. '%' )
        ->where('locations.loc_name', 'LIKE',  '%' .$location. '%' )
        ->where('cost', '<=', $cost)
        ->where('properties.type', '=', $type)
        ->get()  );
    }



    public function amenities(Request $request){
        $prop_id=$request->prop_id;
        return amenitiesResource::collection(amenities::where('properties_id',$prop_id)->get());
    }




}







