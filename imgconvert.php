<?php

$path = 'img/';  //Директория, откуда берем картинки

$convert = new Convert($path);
$convert -> toJpgAll();

// $convert -> toJpgCurrent('2754.png'); Конвертит конкретную картинку из директории. Передаем имя картинки с расширением




class Convert {

public $path;

public function __construct($dir) {

    $this->path = $dir;

}


public function toJpgAll() {

    $path = $this->path;
    $imgsArray = scandir($path);
    $count = count($imgsArray);

    for ($i = 0; $i < $count; $i++) {

         if (!preg_match('/.*\.jpg/', $imgsArray[$i])) {

            $newName = preg_replace('/(?<=\.).*/', 'jpg', $imgsArray[$i]);
            rename($path.$imgsArray[$i], $path.$newName);

         }
    }
}


public function toJpgCurrent($image) {

    $path = $this->path;

    if (!preg_match('/.*\.jpg/', $image)) {

        $newName = preg_replace('/(?<=\.).*/', 'jpg', $image);
        rename($path.$image, $path.$newName);

    }
}
}

?>