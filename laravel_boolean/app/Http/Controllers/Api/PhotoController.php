<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Photo;

class PhotoController extends Controller
{
       public function getAll()
    {
        $photos = Photo::all();

        return response()->json([
            'result' => 'success',
            'data' => $photos,
            'count' => $photos->count()
        ]);
    }

}
