<?php

namespace Models;

/**
 * Represents a picture gallery, which may have many pictures.
 *
 * @package Models
 */
class Gallery
{
    /**
     * The name of the gallery.
     *
     * @var string
     */
    private $name;

    /**
     * The name of the gallery directory.
     *
     * @var string
     */
    private $directory;

    /**
     * The filename of the image to use as the gallery cover.
     *
     * @var string
     */
    private $cover;

    /**
     * A list of files in the directory.
     *
     * @var array
     */
    private $files;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Gallery
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param mixed $directory
     * @return Gallery
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     * @return Gallery
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }
}
