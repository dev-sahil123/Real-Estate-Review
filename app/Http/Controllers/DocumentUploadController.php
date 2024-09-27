<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentUploadController extends Controller
{
    public function upload(Request $request) {
        $destination_path = 'documents/properties/';
        if (!is_dir($destination_path)) {
            mkdir($destination_path, 0755, true);
        }
        if ($request->hasFile('filepond_document')) {
            $document = new Document();
            $file = $request->file('filepond_document');
            $original_name = $file->getClientOriginalName();
            $file_name = time() . '.' . $original_name;
            $file->move('documents/properties', $file_name);
            $path = 'documents/properties/' . $file_name;

            $document->type = $request->type;
            $document->type_id = $request->type_id;
            $document->name = $original_name;
            $document->path = $path;
            $document->save();

            return $document->id;
        }
    }

    public function delete(Request $request) {
        $document = Document::find($request->id);
        unlink($document->path);
        $document->delete();
        return response(['success', true]);
    }
}