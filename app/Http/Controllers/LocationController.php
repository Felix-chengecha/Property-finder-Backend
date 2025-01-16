<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\locations;
use Illuminate\Http\Request;
use App\Http\Requests\locationsRequest;
use App\Http\Resources\locationsResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loc = locations::all();

        return locationsResource::collection($loc);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(locationsRequest $request)
    {
        // 
        try{

            locations::create($request->validated());
            return response()->json([
                'msg'=> 'location added successfully',
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
        $location = locations::where('id', $id)->firstorfail();
        if (!$location) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return new locationsResource($location);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(locationsRequest $request, locations $loc)
    {
        //

        try{ 

            $loc->update($request->validated());
                return response()->json([
                    'msg'=>"records updated",
                    'success' => true,
                    'data'=> new locationsResource($loc),
                ]); 

        }catch(Exception $e){


        }
        
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
}
