<?php

namespace App\Http\Controllers;

use App\Model\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(3);
        return view('pages.index')->with('albums', $albums);
    }

    public function show($id)
    {
        $images = Album::find($id)->images()->get();
        return view('pages.details', array(
            'images' => $images,
            'id' => $id
        ));
    }
}
