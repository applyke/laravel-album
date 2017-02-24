<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Album;

class AlbumApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $albums = Album::paginate(5);
        return response()->json([
            'albums' => $albums
        ], 200);
    }

}
