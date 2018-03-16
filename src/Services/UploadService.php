<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/3/7
 */

namespace App\Lib\Services;


use Illuminate\Support\Facades\Storage;

abstract class UploadService
{
    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    protected $disk;

    protected $mimeDetect;


    public function __construct()
    {
        $this->disk = Storage::disk();
    }

}