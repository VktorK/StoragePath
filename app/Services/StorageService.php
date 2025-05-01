<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StorageService 
{
    public function getStorageIndex($path)
    {
        return $this->storageIndex($path);
    }


    private function storageIndex($path)
    {
        try {

            $files = Storage::disk('local')->files($path);
            $directories = Storage::disk('local')->directories($path);
        
            return [
                'files' => $files,
                'directories' => $directories,
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving files and directories: ' . ['error' => $e->getMessage()]);
            throw new \Exception('Ошибка при получении содержимого.');
        }
    }
}