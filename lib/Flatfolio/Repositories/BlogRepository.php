<?php

namespace Flatfolio\Repositories;

use Flatfolio\Models\Blog;
use Flatfolio\Models\Post;

/**
 * A repository for accessing {@link Blog} instances.
 *
 * @package Repositories
 */
class BlogRepository
{
    /**
     * Returns true if the directory at the given path contains a metadata file.
     *
     * @param string $dir   the directory path to check
     * @return bool
     */
    private static function hasMetadata($dir) {
        $contents = scandir($dir);
        foreach ($contents as $item) {
            if ($item == '_metadata.yaml') {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the metadata for the directory at the given path.
     *
     * @param string $dir   the directory path to check
     * @return array
     */
    private static function loadMetadata($dir) {
       return \Spyc::YAMLLoad($dir . '/_metadata.yaml');
    }

    /**
     * Gets the name of the content file associated with the file with the specified name.
     *
     * @param string $file  the filename to derive the content file name from
     * @return string
     */
    private static function getContentFileName($file) {
        return pathinfo($file, PATHINFO_FILENAME) . '.md';
    }

    /**
     * Returns true if the specified file has an associated content file present in the given array.
     *
     * @param string[] $files   the array of all file names
     * @param string $file      the file to check
     * @return bool
     */
    private static function hasContent($files, $file) {
        foreach ($files as $item) {
            if ($item == self::getContentFileName($file)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Loads all blog posts from the specified directory and returns them.
     *
     * @param string $dir   the directory path to load from.
     * @return Post[]
     */
    private static function loadPosts($dir) {
        $posts = [];
        $files = scandir($dir); // Iterate over files in directory.
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == 'yml' // Must be a YAML file.
                && self::hasContent($files, $file)) { // Must have an associated content file.
                $data = \Spyc::YAMLLoad($dir . '/' . $file); // Load metadata into new post instance.
                $post = new Post();
                $post->setCover($data['cover'])
                    ->setDate(date_create_from_format('j-M-Y', $data['date']))
                    ->setSlug($data['slug'])
                    ->setTags($data['tags'])
                    ->setTitle($data['title'])
                    ->setAuthor($data['author'])
                    ->setContent(file_get_contents($dir . '/' . self::getContentFileName($file))); // Load content file.
                $posts[] = $post;
            }
        }
        return $posts;
    }

    /**
     * Returns the directory at the given path as a {@link Blog} instance.
     *
     * @param string $dir   the directory path to load
     * @return Blog|null
     */
    public static function open($dir) {
        if (self::hasMetadata($dir)) { // If directory contains metadata file.
            $metadata = self::loadMetadata($dir); // Load metadata.
            $blog = new Blog(); // Initialize new blog instance.
            $blog->setName($metadata['name'])
                ->setSlogan($metadata['tagline'])
                ->setCover($metadata['cover'])
                ->setPosts(self::loadPosts($dir)); // Load posts too.
            return $blog;
        }
        return null; // No metadata, loading blog failed.
    }
}
