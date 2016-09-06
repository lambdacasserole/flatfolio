<?php

namespace Repositories;
use Models\Blog;

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
     * Returns the directory at the given path as a {@link Blog} instance.
     *
     * @param string $dir   the directory path to load
     * @return Blog|null
     */
    public static function open($dir) {
        $contents = scandir($dir);
        if (self::hasMetadata($dir)) {
            $metadata = self::loadMetadata($dir);
            $blog = new Blog();
            $blog->setName($metadata['name'])
                ->setTagline($metadata['tagline'])
                ->setCover($metadata['cover'])
                ->setItems(null);
            return $blog;
        }
        return null;
    }
}
