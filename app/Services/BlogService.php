<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/18
 * Time: 23:02
 */

namespace App\Services;


use Illuminate\Http\UploadedFile;

class BlogService{

    protected $dir;
    protected $filename;

    public function __construct()
    {
        $this->dir = '/uploads/file/'.date('Ymd');
        $this->filename = uniqid();
    }

    public function upload(UploadedFile $file) {
        if (! is_dir(public_path($this->dir))) {
            mkdir(public_path($this->dir), 0777, true);
        }
        $file->move(public_path($this->dir), $this->filename .'.' . $file->getClientOriginalExtension());
        return $this->dir . DIRECTORY_SEPARATOR . $this->filename . '.' .$file->getClientOriginalExtension();
    }
}