<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\properties;
use Illuminate\Http\Request;
use App\Http\Requests\PropertyRequest;
use App\Http\Resources\propertyResource;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prop = properties::all();

        return propertyResource::collection($prop);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request) 
    {
        // 

        try{
            properties::create($request->validated());
            return response()->json([
                'msg'=> 'property added successfully',
                'success' => true,
             ], 201);

        }catch(Exception $e)
        {

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
        $prop = properties::where('id', $id)->firstorfail();
        if (!$prop) {
            return response()->json(['message' => 'property not found'], 404);
        }
        return new propertyResource($prop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, properties $properties)
    {
        // 
        try{ 

            $properties->update($request->validated());
                return response()->json([
                    'msg'=>"records updated",
                    'success' => true,
                    'data'=> new propertyResource ($properties),
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
