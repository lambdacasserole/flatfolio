<?php

require_once 'init.php';

use Flatfolio\Auth;
use Flatfolio\Repositories\BlogRepository;
use Flatfolio\Repositories\PortfolioRepository;
use Flatfolio\Request;

// Load config.
$config = Spyc::YAMLLoad(CONFIG_FILE_PATH);

$app = new Silex\Application();

// Uncomment the line below while debugging your app.
$app['debug'] = true;

// Twig initialization.
$loader = new Twig_Loader_Filesystem(SITE_TEMPLATE_DIR);
$twig = new Twig_Environment($loader, array(
    'cache' => TEMPLATE_CACHING_ENABLED ? SITE_CACHE_DIR : false,
));

/*
 * Route actions.
 */

$app->get('/', function () use ($twig, $config) {
    return $twig->render('index.html.twig', $config);
});

$app->get('/about', function () use ($twig, $config) {
    return $twig->render('about.html.twig', $config);
});

$app->get('/portfolio', function () use ($twig, $config) {
    // Load portfolio from repository.
    $repo = new PortfolioRepository();
    $portfolio = $repo->open(SITE_PORTFOLIO_DIR);

    // Pass entire portfolio into page.
    $vars = array_merge($config, array(
        'portfolio' => $portfolio
    ));
    return $twig->render('portfolio.html.twig', $vars);
});

$app->get('/portfolio/{slug}', function ($slug) use ($twig, $config) {
    // Load portfolio from repository.
    $repo = new PortfolioRepository();
    $portfolio = $repo->open(SITE_PORTFOLIO_DIR);

    // Find relevant project by its slug.
    $project = $portfolio->getProjectBySlug($slug);

    // Load related projects based on category.
    $related = $portfolio->getProjectsByCategories($project->getCategories(), $project);

    // Pass relevant project and related projects into page.
    $vars = array_merge($config, array(
        'project' => $project,
        'related' => $related
    ));
    return $twig->render('portfolio-project.html.twig', $vars);
});

$app->get('/blog', function () use ($twig, $config) {
    // Load blog from repository.
    $repo = new BlogRepository();
    $blog = $repo->open(SITE_BLOG_DIR);

    // Pass entire portfolio into page.
    $vars = array_merge($config, array(
        'blog' => $blog // Pass entire blog into page.
    ));
    return $twig->render('blog.html.twig', $vars);
});

$app->get('/blog/{slug}', function ($slug) use ($twig, $config) {
    // Load blog from repository.
    $repo = new BlogRepository();
    $blog = $repo->open(SITE_BLOG_DIR);

    // Pass relevant post in to page.
    $vars = array_merge($config, array(
        'post' => $blog->getPostBySlug($slug)
    ));
    return $twig->render('blog-post.html.twig', $vars);
});

$app->get('/contact', function () use ($twig, $config) {
    return $twig->render('contact.html.twig', $config);
});

$app->post('/contact', function () use ($twig, $config) {
    // Collect form fields.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate form.
    $errors = [];
    if (strlen($name) < 2) {
        $errors[] = 'The name you provide needs to 2 or more characters in length.';
    }
    if (strlen($message) < 30) {
        $errors[] = 'The message you submit needs to be 30 or more characters in length.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'The email address you provided is invalid.';
    }

    // Send message if no errors.
    if (sizeof($errors) == 0) {
        mail($config['contact_form_target'], 'Website contact', "Name: $name\r\nEmail: $email\r\nMessage: $message");
    }

    // Render contact page with success/error message.
    $vars = array_merge($config, array(
        'success' => sizeof($errors) == 0,
        'errors' => $errors,
        'post' => $_POST
    ));
    return $twig->render('contact.html.twig', $vars);
});

$app->get('/login', function () use ($twig, $config) {
    return $twig->render('login.html.twig', $config);
});

$app->get('/admin', function () use ($twig, $config) {
    // Redirect to login page if not authenticated.
    if (!Auth::isAuthenticated()) {
        redirectToLoginPage();
    }

    return $twig->render('admin-overview.html.twig', $config);
});

$app->post('/login', function () use ($twig, $config) {
    // If we're already logged in, go to admin page.
    if (Auth::isAuthenticated()) {
        redirectToAdminPage();
    }

    // If the login form is submitted.
    $status = 0;
    if (Request::isLoginFormSubmitted()) {
        if (Auth::authenticate(Request::getLoginEmail(), Request::getLoginPassword())) {
            redirectToAdminPage(); // Login success.
        }
        else {
            $status = 1; // Bad credentials.
        }
    }

    // Pass status in to login page.
    $vars = array_merge($config, array(
        'status' => $status,
    ));
    return $twig->render('login.html.twig', $vars);
});

$app->get('/linkedin', function () use ($twig, $config) {
    header('Location: ' . $config['linkedin_url']);
    die();
});

$app->get('/twitter', function () use ($twig, $config) {
    header('Location: ' . $config['twitter_url']);
    die();
});

$app->get('/github', function () use ($twig, $config) {
    header('Location: ' . $config['github_url']);
    die();
});

$app->run();