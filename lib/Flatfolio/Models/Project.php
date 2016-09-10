<?php

namespace Flatfolio\Models;

use DateTime;

/**
 * Represents an instance of a project.
 *
 * @package Models
 */
class Project
{
    /**
     * The title of the project.
     *
     * @var string
     */
    private $title;

    /**
     * The path of the image to use as the project cover image.
     *
     * @var string
     */
    private $cover;

    /**
     * The path of the image to use as the tile for the project.
     *
     * @var string
     */
    private $tile;

    /**
     * The collection of categories the project belongs to.
     *
     * @var string[]
     */
    private $categories;

    /**
     * The URL slug for the project.
     *
     * @var string
     */
    private $slug;

    /**
     * The date the project was created.
     *
     * @var DateTime
     */
    private $date;

    /**
     * The content of the project.
     *
     * @var string
     */
    private $content;

    /**
     * The name of the author of the project.
     *
     * @var string
     */
    private $author;

    /**
     * The name of the client the project was undertaken for.
     *
     * @var string
     */
    private $client;

    /**
     * The website URL of the client the project was undertaken for.
     *
     * @var string
     */
    private $website;

    /**
     * Gets the title of the project.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title of the project.
     *
     * @param string $title  the new title of the project
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets the path of the image to use as the project cover image.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Sets the path of the image to use as the project cover image.
     *
     * @param string $cover the new path of the project cover image
     * @return Project
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Gets the path of the image to use as the tile for the project.
     *
     * @return string
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * Sets path of the image to use as the tile for the project.
     *
     * @param string $tile  the new path of the project tile image
     * @return Project
     */
    public function setTile($tile)
    {
        $this->tile = $tile;
        return $this;
    }

    /**
     * Gets the collection of categories the project belongs to.
     *
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Sets the collection of categories the project belongs to.
     *
     * @param string[] $categories    the new collection of categories the project belongs to
     * @return Project
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * Gets the URL slug for the project.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the URL slug for the project.
     *
     * @param string $slug  the new URL slug for the project
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Gets the date the project was created.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date the project was created.
     *
     * @param mixed $date   the new date to set as the project creation date
     * @return Project
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Gets the content of the project.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content of the project.
     *
     * @param string $content   the new content of the project
     * @return Project
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Gets the name of the author of the project.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the name of the author of the project.
     *
     * @param mixed $author the new name of the author of the project.
     * @return Project
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Gets the name of the client the project was undertaken for.
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the name of the client the project was undertaken for.
     *
     * @param string $client    the name of the client the project was undertaken for
     * @return Project
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Gets the website URL of the client the project was undertaken for.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website URL of the client the project was undertaken for.
     *
     * @param string $website   the website URL of the client the project was undertaken for
     * @return Project
     */
    public function setWebsite($website)
    {
        $this->website = $website;
        return $this;
    }
}
