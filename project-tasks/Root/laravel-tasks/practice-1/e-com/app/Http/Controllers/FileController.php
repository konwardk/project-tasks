<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\Upload;

class FileController extends Controller
{
    //
   public function uploadFile(Request $request){

    //check user
    $user = $request->user();
    // dd($user->id);


    //validate  uploads
    $validator = Validator::make($request->all(), [
        'uploadfile' => 'required|file|mimes:pdf,docx,txt|max:10240',

    ]);

    if($validator->fails()){
        Log::error("File upload failed by {{$user->name}}");
        return response()->json([
            'errors' => $validator->errors()
        ],422);

    }

    //save file to DB
    if ($request->hasFile('uploadfile')) {
        $file = $request->file('uploadfile');
        $path = $file->store('uploads'); // stored in storage/app/private/uploads

        Upload::create([
            'uploadfile' => $path,
            'user_id' => $user->id
        ]);

    Log::info("File upload Successful by {{$user->name}}");
    return response()->json(['message' => 'File uploaded successfully']);


    }

    return response()->json([
        'message' => "undefined"
    ],404);
   }
}
