<?php

namespace Models;

/**
 * Represents a picture gallery, which may have many pictures.
 *
 * @package Models
 */
class Gallery
{
    private $name;

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
}
