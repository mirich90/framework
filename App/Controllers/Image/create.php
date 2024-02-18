<?php

namespace App\Controllers\Image;

use App\Core\Controller;
use App\Db;
use App\Functions\FUser;

class create extends Controller
{
  protected function construct()
  {
    if ($this->check_response(['submit'])) {
      $this->create();
      die;
    }

    $this->view->display('Image/create');
  }

  private function create()
  {
    $Image = new \App\Models\Image();
    $Image->load($_POST);

    try {
      $base64 = $_POST["file"];
      $type = $this->getTypeFile($base64);
      $link = $Image->attributes["link"];

      $isLoad = $this->saveImgInHost($link, $type, $base64);

      if ($isLoad) {
        $Image->addAttribute("filetype", $type);
        $Image->addAttribute("src", "$link.$type");

        $Image->validate($_POST);
        echo $Image->save(['link', 'id']);
      }
    } catch (\Throwable $th) {
      header('HTTP/1.0 500');
      echo $Image->sendResponse($th->getMessage(), [], 500);
      die;
    }
  }


  protected function saveImgInHost($name, $type_file, $base64)
  {
    $is_local = env('is_local');

    $public_dir = ($is_local) ? 'public' : 'public_html';
    $image_file = $this->decodeImgFromBase64($base64);
    $uploaddir = __DIR__ . "/../../../$public_dir/img/load/";
    $uploadpath = $uploaddir . "original/$name.$type_file";

    $status = file_put_contents($uploadpath, $image_file, LOCK_EX);
    if ($status === false) return false;

    $this->saveImgInWebp($image_file, $uploadpath, $uploaddir, $name);

    return true;
  }

  private function decodeImgFromBase64($base64)
  {
    $data = explode(',', $base64)[1];
    $img = base64_decode($data);
    return $img;
  }
  private function getTypeFile($base64)
  {
    $type_file = explode(';', $base64)[0];
    $type_file = explode('/', $type_file)[1];
    return $type_file;
  }

  private function saveImgInWebp($image_file, $uploadpath, $uploaddir, $name)
  {
    $uploadpath_webp =  $uploaddir . "webp/$name.webp";

    $image_str = imagecreatefromstring($image_file);
    $image_str = $this->setOrientation($image_str, $uploadpath);
    imageWebp($image_str, $uploadpath_webp, 100);
    $this->resizeImg($uploaddir, "$name.webp", 'webp');
    imagedestroy($image_str);
  }


  protected function setOrientation($image_str, $uploadpath)
  {
    $exif = @exif_read_data($uploadpath, 'EXIF');
    if (!empty($exif['Orientation'])) {
      switch ($exif['Orientation']) {
        case 8:
          $image_str = imagerotate($image_str, 90, 0);
          break;
        case 3:
          $image_str = imagerotate($image_str, 180, 0);
          break;
        case 6:
          $image_str = imagerotate($image_str, -90, 0);
          break;
      }
    }
    return $image_str;
  }

  protected function resizeImg($uploaddir, $name, $type)
  {
    header("Content-Type: image/$type");
    $filename = $uploaddir . "webp/$name";
    $filename_new = $uploaddir . "min/$name";

    list($width, $height) = getimagesize($filename);
    $needWidth = ($width > $height) ? 240 : 400;
    $percent = round($needWidth / $height, 2);

    $new_width = $width * $percent;
    $new_height = $height * $percent;

    $image_p = imagecreatetruecolor($new_width, $new_height);

    if ($type == "png") {
      $img = imageCreateFromPng($filename);
    } else if ($type == "jpg" || $type == "pjpeg" || $type == "jpeg" || $type == "plain") {
      $img = imageCreateFromJpeg($filename);
    } else if ('webp') {
      $img = imageCreatefromWebp($filename);
    }

    imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imageWebp($image_p, $filename_new, 100);
    imagedestroy($img);
    imagedestroy($image_p);
  }

  protected function title()
  {
    return "Создание заметки";
  }

  protected function description()
  {
    return "Создание заметки";
  }

  protected function keywords()
  {
    return "заметка, журнал";
  }

  protected function author()
  {
    return "Username";
  }
}
