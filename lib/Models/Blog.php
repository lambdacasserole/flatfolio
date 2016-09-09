<?php

namespace Models;

/**
 * Represents an instance of a blog.
 *
 * @package Models
 */
class Blog
{
    /**
     * The name of the blog.
     *
     * @var string
     */
    private $name;

    /**
     * The path of the image to use as the blog cover image.
     *
     * @var string
     */
    private $cover;

    /**
     * The blog slogan.
     *
     * @var string
     */
    private $slogan;

    /**
     * The collection of posts on the blog.
     *
     * @var Post[]
     */
    private $posts;

    /**
     * Gets the name of the blog.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the blog.
     *
     * @param string $name  the new name of the blog
     * @return Blog
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the path of the image to use as the blog cover image.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Sets the path of the image to use as the blog cover image.
     *
     * @param string $cover the new path of the blog cover image
     * @return Blog
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Gets the blog slogan.
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Sets the blog slogan.
     *
     * @param string $slogan    the new slogan to associate with the blog
     * @return Blog
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
        return $this;
    }

    /**
     * Gets the collection of posts on the blog.
     *
     * @return Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Sets the collection of posts on the blog.
     *
     * @param Post[] $posts the new collection of posts for the blog
     * @return Blog
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * Gets a specific post from this blog by its slug.
     *
     * @param string $slug  the slug of the post to get
     * @return Post|null
     */
    public function getPostBySlug($slug)
    {
        foreach ($this->posts as $post) {
            if ($post->getSlug() == $slug) {
                return $post;
            }
        }
        return null;
    }
}