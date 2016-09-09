<?php

namespace Models;

/**
 * Represents an instance of a blog.
 *
 * @package Models
 */
class Blog
{
    private $name;

    private $cover;

    private $tagline;

    private $posts;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param $cover
     * @return $this
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @param $tagline
     * @return $this
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param $posts
     * @return $this
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        return $this;
    }

    /**
     * @param $slug
     * @return null
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