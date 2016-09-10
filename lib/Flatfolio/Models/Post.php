<?php

namespace Flatfolio\Models;

use DateTime;

/**
 * Represents an instance of a blog post.
 *
 * @package Models
 */
class Post
{
    /**
     * The title of the blog post.
     *
     * @var string
     */
    private $title;

    /**
     * The path of the image to use as the blog post cover image.
     *
     * @var string
     */
    private $cover;

    /**
     * The collection of tags on the blog post.
     *
     * @var string[]
     */
    private $tags;

    /**
     * The URL slug for the blog post.
     *
     * @var string
     */
    private $slug;

    /**
     * The date the blog post was created.
     *
     * @var DateTime
     */
    private $date;

    /**
     * The content of the blog post.
     *
     * @var string
     */
    private $content;

    /**
     * The name of the author of the blog post.
     *
     * @var string
     */
    private $author;

    /**
     * Gets the title of the blog post.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title of the blog post.
     *
     * @param string $title  the new title of the blog post
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets the path of the image to use as the blog post cover image.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Sets the path of the image to use as the blog post cover image.
     *
     * @param string $cover the new path of the blog post cover image
     * @return Post
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Gets the collection of tags on the blog post.
     *
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Sets the collection of tags on the blog post.
     *
     * @param string[] $tags    the new collection of tags on the blog post
     * @return Post
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Gets the URL slug for the blog post.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the URL slug for the blog post.
     *
     * @param string $slug  the new URL slug for the blog post
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Gets the date the blog post was created.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date the blog post was created.
     *
     * @param mixed $date   the new date to set as the blog post creation date
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Gets the content of the blog post.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content of the blog post.
     *
     * @param string $content   the new content of the blog post
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Gets the name of the author of the blog post.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the name of the author of the blog post.
     *
     * @param mixed $author the new name of the author of the blog post.
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
}
