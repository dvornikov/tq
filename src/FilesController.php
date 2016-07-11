<?php

namespace Dvornikov\TQ;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Dvornikov\TQ\File;
use Storage;

class FilesController extends Controller
{
    public function add(Request $request)
    {
        $file = $request->file('filefield');
        $name = substr(sha1(mt_rand()), 0, 5) . '.'. $file->getClientOriginalExtension();
        Storage::put(
            $name,
            file_get_contents($file->getRealPath())
        );

        $request->session()->push($request->input('_id'). '_photos', [
            'filename' => $name
        ]);
    }

    public function get($filename){

		$entry = File::where('filename', '=', $filename)->firstOrFail();
		return response()->download(storage_path().'/app/'.$entry->filename);
	}
}
