<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\property_images;
use App\Services\GoogleService;
use App\Http\Requests\ImagesRequest;
use App\Http\Resources\imgsResource;

class ImagesController extends Controller
{

    protected $googleService;
    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $img = property_images ::all();
        return imgsResource::collection($img);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 

        $request->validate([
            'image' => 'required|image|max:2048',
            'properties_id' => 'required'|'string'
        ]);
    
        $imagePath = $request->file('image')->store('images');
        $fullImagePath = storage_path("app/$imagePath");
        $sheetId = env('SPREADSHEET_ID'); 
    
        $fileId = $this->googleService->uploadImage($fullImagePath);
        $this->googleService->makeFilePublic($fileId);
    
        $imageUrl = "https://drive.google.com/uc?id=$fileId";
    
        // Insert the image URL into the next available row in Google Sheets and local db
        $this->googleService->insertImageLink( $sheetId, $imageUrl);

        property_images::create($request->only('properties_id'),$imageUrl);
    
        // return view('image_display', ['imageUrl' => $imageUrl]);
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
        $propimage = property_images::where('id', $id)->firstorfail();
        if (!$propimage) {
            return response()->json(['message' => 'Images not found'], 404);
        }
        return new imgsResource($propimage);
    }

    public function PropImages($id)
    {
        // 
        $propimage = property_images::where('properties_id', $id)->firstorfail();
        if (!$propimage) {
            return response()->json(['message' => 'Images not found'], 404);
        }
        return imgsResource::collection($propimage);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImagesRequest $request, property_images $propimages)
    {
        // 
        $propimages ->update($request->validated());
                return response()->json([
                    'msg'=>"records updated",
                    'success' => true,
                    'data'=> new imgsResource($propimages),
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
}
