<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'image' => 'required|min:1|max:1250|mimes:jpeg,png,jpg'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors());
        }

        $image = new Image;
        $file = $request->file('image');
        $album_id = $request->get('album_id');
        $destination_path = base_path() . '/public/images/catalog/';
        $filename = str_random(6) . '_' . $file->getClientOriginalName();
        $file->move($destination_path, $filename);
        $image->file = '/images/catalog/' . $filename;
        $image->album_id = $album_id;
        $image->save();

        return redirect('/album/' . $album_id)->with('message', 'File uploaded successfully.');
    }

    public function destroy($id)
    {
        $image = Image::find($id);
        if (!isset($image)) {
            return redirect('/')->with('message', 'Image doesn\'t exist.');
        }
        $image->delete();
        File::delete(base_path() . '/public' . $image->file);
        return redirect('/album/' . $image->album_id)->with('message', 'Image deleted!');
    }
}
