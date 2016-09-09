<?php

namespace Models;

/**
 * Represents a portfolio, a collection of artwork or projects.
 *
 * @package Models
 */
class Portfolio
{
    /**
     * The name of the portfolio.
     *
     * @var string
     */
    private $name;

    /**
     * The path of the image to use as the portfolio cover image.
     *
     * @var string
     */
    private $cover;

    /**
     * The portfolio slogan.
     *
     * @var string
     */
    private $slogan;

    /**
     * The collection of projects in the portfolio.
     *
     * @var Project[]
     */
    private $projects;

    /**
     * Gets the name of the portfolio.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the portfolio.
     *
     * @param string $name  the new name of the portfolio
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the path of the image to use as the portfolio cover image.
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Sets the path of the image to use as the portfolio cover image.
     *
     * @param string $cover the new path of the portfolio cover image
     * @return $this
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Gets the portfolio slogan.
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Sets the portfolio slogan.
     *
     * @param string $slogan    the new slogan to associate with the portfolio
     * @return $this
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
        return $this;
    }

    /**
     * Gets the collection of projects in the portfolio.
     *
     * @return Project[]
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Sets the collection of projects on the portfolio.
     *
     * @param Project[] $projects the new collection of projects for the portfolio
     * @return $this
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;
        return $this;
    }

    /**
     * Gets a specific project from this portfolio by its slug.
     *
     * @param string $slug  the slug of the project to get
     * @return Project|null
     */
    public function getProjectBySlug($slug)
    {
        foreach ($this->projects as $project) {
            if ($project->getSlug() == $slug) {
                return $project;
            }
        }
        return null;
    }
}
