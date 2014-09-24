<?php

require_once 'init.php';

use Repositories\GalleryRepository;

$repo = new GalleryRepository(__DIR__ . '/media');

echo $twig->render('index.html.twig', array('galleries' => $repo->findAll()));
