<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\IndexStorageRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class StorageController extends Controller
{
    public function index(IndexStorageRequest $request)
    {
        $validated = $request->validated();
        
        $path = $validated['path'] ?? '';
        
        try {
            $files = Storage::disk('local')->files($path);
            $directories = Storage::disk('local')->directories($path);
        
        } catch (\Exception $e) {
            Log::error('Error retrieving files and directories: ', ['error' => $e->getMessage()]);
            return redirect()->route('storage.index')->withErrors(['error' => 'Ошибка при получении содержимого.']);
        }
    
        return view('storage.index', compact('files', 'directories', 'path'));
    }
}
