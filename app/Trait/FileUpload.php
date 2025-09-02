<?php

namespace App\Trait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait FileUpload
{
    public function uploadFile($request, $inputName, $path, $customName = null)
    {
        if ($request->hasFile($inputName)) {

            $file = $request->file($inputName);

            // $fileName = time() . '_' . rand() . '.' . $file->extension();
            $fileName = $customName != null ? $customName . '.' . $file->extension() : (time() . '_' . rand() . '.' . $file->extension());

            $file->move(public_path($path), $fileName);

            return "{$path}{$fileName}";
        }
        return null;
    }
    public function updateFile($request, $inputName, $path, $oldFile, $customName = null)
    {
        if ($request->hasFile($inputName)) {

            $this->deleteFile($oldFile);

            $file = $request->file($inputName);

            // $fileName = time() . '_' . rand() . '.' . $file->extension();
            $fileName = $customName != null ? $customName . '.' . $file->extension() : (time() . '_' . rand() . '.' . $file->extension());

            $file->move(public_path($path), $fileName);

            return "{$path}{$fileName}";
        }
        return "{$oldFile}";
    }
    public function deleteFile($oldFile)
    {
        if (File::exists(public_path($oldFile))) {

            File::delete(public_path($oldFile));
        }
    }
    public function imageInterventionUploadFile($request, $inputName, $path, $width, $height, $customName = null)
    {
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);

            $directory = public_path($path);

            if (!is_dir($directory)) {

                mkdir($directory, 0777, true);
            }

            // $fileName = time() . '_' . rand() . '.' . $file->extension();
            $fileName = $customName != null ? $customName . '.' . $file->extension() : (time() . '_' . rand() . '.' . $file->extension());

            $file = Image::make($file)->resize($width, $height);

            $file->save("{$directory}{$fileName}");


            return "{$path}{$fileName}";
        }
    }
    public function imageInterventionUpdateFile($request, $inputName, $path, $width, $height, $oldFile, $customName = null)
    {
        if ($request->hasFile($inputName)) {
            $this->deleteFile($oldFile);

            $file = $request->file($inputName);

            $directory = public_path($path);

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            // $fileName = time() . '_' . rand() . '.' . $file->extension();
            $fileName = $customName != null ? $customName . '.' . $file->extension() : (time() . '_' . rand() . '.' . $file->extension());

            $file = Image::make($file)->resize($width, $height);

            $file->save("{$directory}{$fileName}");

            return "{$path}{$fileName}";
        }
        return "{$oldFile}";
    }
    public function uploadMultipleImage(Request $request, $inputName, $path)
    {
        $uploadedFileName = [];
        if ($request->hasFile($inputName)) {

            $files = $request->file($inputName);

            foreach ($files as $file) {

                $fileName = time() . '_' . rand() . '.' . $file->extension();

                $file->move(public_path($path), $fileName);

                array_push($uploadedFileName, "{$path}{$fileName}");
            }


            return $uploadedFileName;
        }
    }
    public function imageInterventionUploadMultipleFile(Request $request, $inputName, $path, $width, $height)
    {
        $uploadedFileNames = [];

        if ($request->hasFile($inputName)) {
            $files = $request->file($inputName);

            foreach ($files as $file) {
                $directory = public_path($path);

                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                $fileName = time() . '_' . rand() . '.' . $file->extension();

                $file = Image::make($file)->resize($width, $height);

                $file->save("{$directory}{$fileName}");

                array_push($uploadedFileNames, "{$path}{$fileName}");
            }

            return $uploadedFileNames;
        }
    }
}
