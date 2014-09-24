<?php

namespace Repositories;

use Models\Gallery;

class GalleryRepository
{
    private $dir;

    public function __construct($dir) {
        $this->dir = $dir;
    }

    public function findAll() {
        $dir = scandir($this->dir);
        $galleries = [];
        foreach ($dir as $file) {
            if ($file != '.' && $file != '..') {
                $gallery = new Gallery();
                $galleries[] = $gallery->setName($file);
            }
        }
        return $galleries;
    }
}