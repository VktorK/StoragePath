<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\IndexStorageRequest;
use Illuminate\Http\Request;


class StorageController extends Controller
{
    protected $storageService;

    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    public function index(IndexStorageRequest $request)
    {
        $validated = $request->validated();
        $path = $validated['path'] ?? '';

        try {

            $data = $this->storageService->getStorageIndex($path);
            return view('storage.index', [
                'files' => $data['files'],
                'directories' => $data['directories'],
                'path' => $path,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in StorageController: ', ['error' => $e->getMessage()]);
            return redirect()->route('storage.index')->withErrors(['error' => 'Ошибка при получении содержимого.']);
        }
    }
}
