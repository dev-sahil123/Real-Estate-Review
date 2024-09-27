<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageUploadController extends Controller
{
    public function upload(Request $request) {
        $destination_path = 'images/properties/';
        if (!is_dir($destination_path)) {
            mkdir($destination_path, 0755, true);
        }

        $image = new Image();
        if ($request->hasFile('filepond_image')) {
            $file = $request->file('filepond_image');
            $original_name = $file->getClientOriginalName();
            $file_name = time() . '.' . $original_name;
            $file->move('images/properties', $file_name);
            $path = 'images/properties/' . $file_name;

            $image->type = $request->type;
            $image->type_id = $request->type_id;
            $image->name = $original_name;
            $image->path = $path;
            $image->save();

            return $image->id;
        }
    }

    public function delete(Request $request) {
        $photo = Image::find($request->id);
        unlink($photo->path);
        $photo->delete();
        return response(['success', true]);
    }
}