<?php

use Flatfolio\Security;

/**
 * Removes the dot folder names '.' and '..' from an array.
 *
 * @param string[] $arr the array to remove elements from
 * @return string[]
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

/**
 * Gets the security configuration class for the application.
 *
 * @return Security
 */
function getSecurity()
{
    return Security::get();
}

/**
 * Redirects the user to a URL.
 *
 * @param string $url   the URL to redirect the user to
 */
function redirect($url)
{
    header("Location: $url");
    die();
}

/**
 * Redirects the user to the login page.
 */
function redirectToLoginPage()
{
    redirect('/login');
}

/**
 * Redirects the user to the admin page.
 */
function redirectToAdminPage()
{
    redirect('/admin');
}
