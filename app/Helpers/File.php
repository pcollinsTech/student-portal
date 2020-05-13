<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;

class File
{
  public $name;
  public $extension;
  public $type;
  public $data;
  public $path;
  public $user_id;
  public $created_at;

  public function  __construct($data)
  {
    $this->name = $data['name'];
    $this->extension = $data['extension'];
    $this->type = $data['contentType'];
    $this->data = $data['data'];
    $this->path = null;
  }

  public function save($path = '/', $disk = 'local', $thumb = false, $index = null)
  {

    if (strlen($this->data) > 0) {
      // Normalize data from the G4 bit string to be decoded
      list(, $this->data) = explode(';', $this->data);
      list(, $this->data) = explode(',', $this->data);
      $this->data = base64_decode($this->data);

      // Create Directory
      Storage::disk($disk)->makeDirectory($path);
      // Set File Path
      $server_path = $path . '/' . $this->name;
      // Save the file 64 Bit String into the disk
      Storage::disk($disk)->put($server_path, $this->data);


      // Set Thubnail if image an $thumb is active
      if ($thumb && ($this->extension == "jpg" || $this->extension == "png" || $this->extension == "jpeg"))
        $this->resizeImage($path, $index, $disk);

      // Set the Data To null as now the file is on the disk
      $this->data = null;
      // Set the path property with the path for the file
      $this->path = $server_path;



      // Return the file
      return $this;
    }
  }

  public function resizeImage($path, $index = 0, $disk)
  {
    //create image from 64 bi string
    $image = imagecreatefromstring($this->data);

    //set the size for the image
    $width = 375;
    $height = 175 + (175 / 2);

    //create a new tru color image container 
    $thumb = imagecreatetruecolor($width, $height);


    //resize the image
    imagecopyresampled(
      $thumb,
      $image,
      0,
      0,
      0,
      0,
      $width,
      $height,
      imagesx($image),
      imagesy($image)
    );
    //need to create the directory for the localpath in order to save
    if (!file_exists($path))
      FileFacade::makeDirectory($path, $mode = 0777, true, true);

    // //save into png to the localpath parameter
    // imagepng($thumb, Storage::disk($disk)->getAdapter()->getPathPrefix() . $path . '/thumb_' . $this->name);
  }
}
