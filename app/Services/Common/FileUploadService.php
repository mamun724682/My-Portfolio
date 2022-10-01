<?php

namespace App\Services\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public function __construct($disk = 'public')
    {
        $this->disk = $disk;
    }

    /*
     * Upload regular file
     */
    public function uploadFile($file, $upload_path = null, $delete_path = null)
    {
        // Delete old file
        if ($delete_path) {
            $this->delete($delete_path);
        }
        // Upload new file
        return $this->upload($file, $upload_path);
    }

    public function upload($file, $path = 'uploads/others', $use_client_file_name = false)
    {
        $file_name = $use_client_file_name ?
            (pathinfo($this->getFileName($file), PATHINFO_FILENAME) . '.' . $file->getClientOriginalExtension())
            : (time() . '_' . rand() . '_' . (auth()->id() ?? '') . '.' . $file->getClientOriginalExtension());

        $filename_dir = trim($path, "/") . "/" . $file_name;

        if ($use_client_file_name) {
            while (Storage::disk($this->disk)->exists($filename_dir)) {
                $file_name = pathinfo($this->getFileName($file), PATHINFO_FILENAME) . rand((auth()->id ?? 1), ((auth()->id ?? 1) * 1024)) . '.' . $file->getClientOriginalExtension();
                $filename_dir = trim($path, "/") . "/" . $file_name;
            }
        }

        Storage::disk($this->disk)->putFileAs('', $file, $filename_dir);

        return $filename_dir;
    }

    /*
     * Upload base64 file
     */
    public function uploadBase64File($base64string, $upload_path = null, $delete_path = null)
    {
        // Delete old file
        if ($delete_path) {
            $this->delete($delete_path);
        }
        // Upload new file
        return $this->uploadBase64($base64string, $upload_path);
    }

    public function uploadBase64($base64string, $path = 'others', $set_file_name = '')
    {
        try {
            $extension = explode('/', explode(':', substr($base64string, 0, strpos($base64string, ';')))[1])[1]; // .jpg .png .pdf
            $replace   = substr($base64string, 0, strpos($base64string, ',') + 1);
            $image     = str_replace($replace, '', $base64string);
            $image     = str_replace(' ', '+', $image);
            $fileName = Str::slug($set_file_name) . time() . rand(1111, 9999) . '.' . $extension;

            Storage::disk($this->disk)->put($path . '/' . $fileName, base64_decode($image));

            return $fileName ?? '';
        } catch (\Exception $ex) {
            log_error($ex);
            return '';
        }
    }

    /*
     * Delete file
     */
    public function delete($path = '')
    {
        try {
            if (Storage::disk($this->disk)->exists($path)){
                Storage::disk($this->disk)->delete($path);
            }
        } catch (\Exception $e) {
            log_error($e);
            return null;
        }
    }

    /*
     * Private function
     */

    private function getFileSize($file)
    {
        return $file->getSize();
    }

    private function getFileName($file)
    {
        return $file->getClientOriginalName();
    }
}
