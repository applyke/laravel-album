<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(3);
        return view('pages.index',array(
            'albums'=>  $albums
        ));
    }

    public function show($id)
    {
        $images = Album::find($id)->images()->get();

        return view('pages.details', array(
            'images' => $images,
            'id' => $id
        ));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3|max:250',
            'description' => 'required|min:3|max:250'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }
        Album::create($request->all());

        return redirect()->route('album.index')->with('message', 'Album created successfully');

    }

    public function edit($id)
    {
        $album = Album::find($id);
        return view('pages.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3|max:250',
            'description' => 'required|min:3|max:250'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        Album::find($id)->update($request->all());
        return redirect()->route('album.index')->with('message', 'Album updated successfully');
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        if (!isset($album)) {
            return redirect('/')->with('message', 'Album doesn\'t exist.');
        }
        $album->delete();
        return redirect()->route('album.index')->with('message', 'Album deleted!');
    }

}
