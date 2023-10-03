<?php

namespace App\Http\Controllers\Api;

use App\Models\File; 
// use App\Http\Requests\StoreFileRequest;
// use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obj = 'hello';
        if($obj){
            return response()->json([
                'success'=>true,
                'results'=> $obj
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=> 'not found'
            ],404);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $file = $request->file('file');
        $fileStored = Storage::put('file_upload',$file);
        $newFile = new File();
        $newFile->file_path = $fileStored;
        $newFile->name = $formData['name'];
        $res = $newFile->save();
        if($res){
            return response()->json([
                        'success'=>true,
                        'results'=> 'successful file upload'
                    ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'results'=> 'unsuccessful file upload'
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
