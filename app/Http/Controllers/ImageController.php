<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Image;

class ImageController extends Controller
{
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        return redirect('/')->with('message', 'You just uploaded an image!');
    }

    public function store(Request $request, $id)
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
        $destination_path = base_path() . '/public/images/catalog/';
        $filename = str_random(6) . '_' . $file->getClientOriginalName();
        $file->move($destination_path, $filename);
        $image->file = '/images/catalog/' . $filename;
        $image->album_id = $id;
        $image->save();

        return redirect('/album/' . $id)->with('success', 'File uploaded successfully.');
    }
}
