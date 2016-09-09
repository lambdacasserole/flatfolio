<?php

/**
 * Removes the dot folder names '.' and '..' from an array.
 *
 * @param array $arr    The array to remove elements from.
 * @return array
 */
function removeDotFolders($arr)
{
    $targets = ['.', '..'];
    foreach ($targets as $target) {
        if (($key = array_search($target, $arr)) !== false) {
            unset($arr[$key]);
        }
    }
    return $arr;
}