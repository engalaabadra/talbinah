<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{
    /**
     * @param $files
     * @param string $path
     * @param string $disk
     * @return mixed
     */
    public static function store($files, string $path = 'files', string $disk = 'public'): mixed
    {
        $items = is_array($files) ? $files : [$files];

        $paths = [];
        if (!empty($items)) {
            foreach ($items as $name => $item) {
                if (is_file($item)) {
                    $paths[] = Storage::disk($disk)->putFile($path, $item);

                } elseif (is_string($item)) {

                    $name = is_numeric($name) ? (Str::random(10) . time()) : $name;
                    $path .= "/$name.jpg";

                    if (Storage::disk($disk)->put($path, $item)) {
                        $paths[] = $path;
                    }
                } elseif (is_string($item) && is_base64($item)) {

                    $name = is_numeric($name) ? (Str::random(10) . time()) : $name;
                    $path .= "/$name.jpg";

                    if (Storage::disk($disk)->put($path, base64_decode($item))) {
                        $paths[] = $path;
                    }
                }
            }
        }

        return $paths ? (count($paths) == 1 ? $paths[0] : $paths) : null;
    }

    /**
     * @param $files
     * @param string $disk
     * @return bool
     */
    public static function delete($files = null, string $disk = 'public'): bool
    {
        try {

            if ($files === null) {
                return true;
            }

            $items = Arr::wrap($files);

            foreach ($items as $item) {
                if (!empty($item) && Storage::disk($disk)->exists($item)) {
                    Storage::disk($disk)->delete($item);
                }
            }

        } catch (Exception $ex) {
            info('Image Error => ' . $ex->getMessage());
        }

        return true;
    }
}
