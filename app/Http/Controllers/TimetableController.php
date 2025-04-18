<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Timetable;

class TimetableController extends Controller
{
    public function updateFile(Request $request, $id)
    {
        $this->authorize('manage_timetables'); 

        $request->validate([
            'file_title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg|max:10240', // Max 10 Mo
        ]);

        $timetable = Timetable::findOrFail($id);
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileType = in_array($extension, ['png', 'jpg', 'jpeg']) ? 'image' : 'pdf';

        $path = $file->store('timetables', 'public');

        $timetable->update([
            'file_title' => $request->file_title,
            'file_path' => $path,
            'file_type' => $fileType,
            'file_extension' => $extension,
            'file_size' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'Timetable file uploaded successfully.');
    }
}
