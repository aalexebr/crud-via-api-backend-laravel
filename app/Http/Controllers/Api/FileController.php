<?php

namespace App\Http\Controllers\Api;

use App\Models\File; 
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// helpers
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obj = File::all();
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
    public function store(StoreFileRequest $request)
    {
        $formData = $request->all();
        if($request->file('file')){
            $file = $request->file('file');
            $fileStored = Storage::put('file_upload',$file);
        }
        else{
            $fileStored = null;
        }
        $newFile = new File();
        $newFile->file_path = $fileStored;
        $newFile->name = $formData['name'];
        $res = $newFile->save();
        if($res){
            return response()->json([
                        'success'=>true,
                        'message'=> 'successful file upload'
                    ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=> 'unsuccessful file upload'
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        if($file){
            return response()->json([
                        'success'=>true,
                        'result'=> $file
                    ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=> 'unsuccessful file upload'
            ]);
        }
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
    public function update(Request $request, string $id)
    {
        $obj = File::findOrFail($id);
        $formData = $request->all();
        // dealing with the file 
        if($request->file('file') && $formData['remove'] = false){
            if($obj->file_path){
                Storage::delete($obj->file_path);
            }
            $file = $request->file('file');
            $fileStored = Storage::put('file_upload',$file);
        }
        elseif($formData['remove'] = true){
            if($obj->file_path){
                Storage::delete($obj->file_path);
            }
            $fileStored = null;
        }

        // // saving the new data
        $obj->name = $formData['name'];
        $obj->file_path = $fileStored;
        $res = $obj->save();
        if($res){
            return response()->json([
                        'success'=>true,
                        'message'=> 'successful file upload'
                    ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=> 'unsuccessful file upload'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        if($file->file_path){
            Storage::delete($file->file_path);
        }
        $file->delete();
    }
}
