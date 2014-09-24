<?php

require_once 'init.php';

$dir = scandir(__DIR__ . '/media');
$galleries = [];
foreach ($dir as $file) {
    if ($file != '.' && $file != '..') {
        $galleries[] = $file;
    }
}

echo $twig->render('index.html.twig', array('galleries' => $galleries));
