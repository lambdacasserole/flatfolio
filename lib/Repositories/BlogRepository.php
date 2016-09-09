<?php

namespace Repositories;

use Models\Blog;
use Models\Post;

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
     * @param $file
     * @return string
     */
    private static function getContentFileName($file) {
        $info = pathinfo($file);
        return $info['filename'] . '.md';
    }

    private static function hasContent($files, $file) {
        foreach ($files as $item) {
            if ($item == self::getContentFileName($file)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $dir
     * @return array
     */
    private static function loadPosts($dir) {
        $files = scandir($dir);
        $posts = [];
        foreach ($files as $file) {
            $info = pathinfo($file);
            if ($info['extension'] == 'yml' && self::hasContent($files, $file)) {
                $data = \Spyc::YAMLLoad($dir . '/' . $file);
                $post = new Post();
                $post->setCover($data['cover'])
                    ->setDate(date_create_from_format('j-M-Y', $data['date']))
                    ->setSlug($data['slug'])
                    ->setTags($data['tags'])
                    ->setTitle($data['title'])
                    ->setAuthor($data['author'])
                    ->setContent(file_get_contents($dir . '/' . self::getContentFileName($file)));
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
                ->setTagline($metadata['tagline'])
                ->setCover($metadata['cover'])
                ->setPosts(self::loadPosts($dir)); // Load posts too.
            return $blog;
        }
        return null; // No metadata, loading blog failed.
    }
}
