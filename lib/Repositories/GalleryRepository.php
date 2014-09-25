<?php

namespace Repositories;

use \Spyc;
use Models\Gallery;

/**
 * A repository for {@link Gallery} objects.
 *
 * @package Repositories
 */
class GalleryRepository
{
    private $dir;

    /**
     * Initialises a new instance of repository for {@link Gallery} objects.
     *
     * @param string $dir   The directory from which to load gallery folders.
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * @param $dir
     * @return Gallery
     */
    private function createGalleryFromDirectory($dir)
    {
        $gallery = new Gallery();

        // Load default data.
        $gallery
            ->setDirectory(basename($dir))
            ->setName(basename($dir));
        $files = removeDotFolders(scandir($dir));
        if (count($files) > 0) {
            $gallery->setCover(reset($files));
        }
        foreach ($files as $file) {

        }

        // Defaults can be overridden in the metadata file.
        $config = $dir . '/_metadata.yaml';
        if (file_exists($config)) {
            $metadata = Spyc::YAMLLoad($config)['gallery'];
            foreach ($metadata as $key => $value) {
                $name = 'set' . ucfirst($key);
                $gallery->$name($metadata[$key]);
            }
        }

        return $gallery;
    }

    /**
     * Gets an array of all galleries on the filesystem.
     *
     * @return array
     */
    public function findAll()
    {
        $dir = removeDotFolders(scandir($this->dir));
        $galleries = [];
        removeDotFolders($galleries);
        foreach ($dir as $gallery) {
            $galleries[] = $this->createGalleryFromDirectory($this->dir . '/' . $gallery);
        }
        return $galleries;
    }
}