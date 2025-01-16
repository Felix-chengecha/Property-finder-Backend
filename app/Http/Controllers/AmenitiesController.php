<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\amenities;
use Illuminate\Http\Request;
use App\Http\Requests\AmenitiesRequest;
use App\Http\Resources\amenitiesResource;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $amenities = amenities::all(); 

        return amenitiesResource::collection($amenities); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmenitiesRequest $request)
    {
        //
        try{
            amenities::create($request->validated());

            return response()->json([
                'msg'=> 'Amenity added successfully',
                'success' => true,
             ], 201);



        }catch(Exception $e){

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
        $amenit = amenities::where('id', $id)->firstorfail();
        if (!$amenit) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return new amenitiesResource($amenit);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AmenitiesRequest $request, amenities $amenit)
    {
        //

        $amenit->update($request->validated());
                return response()->json([
                    'msg'=>"records updated",
                    'success' => true,
                    'data'=> new amenitiesResource($amenit),
                ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    } 

    public function amenities(Request $request){
        $prop_id=$request->prop_id;
        return amenitiesResource::collection(amenities::where('properties_id',$prop_id)->get());
    }
}
