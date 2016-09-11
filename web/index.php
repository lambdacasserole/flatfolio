<?php
// web/index.php
require_once 'init.php';

$config = Spyc::YAMLLoad(__DIR__ . '/../config/config.yml'); // Load config.

$app = new Silex\Application();

// Uncomment the line below while debugging your app.
$app['debug'] = true;

// Twig initialization.
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader, array(
    'cache' => TEMPLATE_CACHING_ENABLED ? __DIR__ . '/../cache' : false,
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
    $repo = new \Flatfolio\Repositories\PortfolioRepository();
    $portfolio = $repo->open(__DIR__ . '/../content/portfolio'); // Load portfolio.
    $vars = array_merge($config, array(
        'portfolio' => $portfolio // Pass entire portfolio into page.
    ));
    return $twig->render('portfolio.html.twig', $vars);
});

$app->get('/portfolio/{slug}', function ($slug) use ($twig, $config) {
    $repo = new \Flatfolio\Repositories\PortfolioRepository();
    $portfolio = $repo->open(__DIR__ . '/../content/portfolio'); // Load portfolio.
    $project = $portfolio->getProjectBySlug($slug); // Load relevant project.
    $related = $portfolio->getProjectsByCategories($project->getCategories(), $project); // Load related projects;
    $vars = array_merge($config, array(
        'project' => $project,
        'related' => $related
    ));
    return $twig->render('portfolio-project.html.twig', $vars);
});

$app->get('/blog', function () use ($twig, $config) {
    $repo = new \Flatfolio\Repositories\BlogRepository();
    $blog = $repo->open(__DIR__ . '/../content/blog'); // Load blog.
    $vars = array_merge($config, array(
        'blog' => $blog // Pass entire blog into page.
    ));
    return $twig->render('blog.html.twig', $vars);
});

$app->get('/blog/{slug}', function ($slug) use ($twig, $config) {
    $repo = new \Flatfolio\Repositories\BlogRepository();
    $blog = $repo->open(__DIR__ . '/../content/blog'); // Load blog.
    $vars = array_merge($config, array(
        'post' => $blog->getPostBySlug($slug) // Pass relevant post in to page.
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
    if (!\Flatfolio\Auth::isAuthenticated()) {
        die();
    }
    return $twig->render('admin-overview.html.twig', $config);
});

$app->post('/login', function () use ($twig, $config) {
    // If we're already logged in, go to deploy.
    if (\Flatfolio\Auth::isAuthenticated())
    {
        header('Location: /admin');
        die();
    }
    // If the login form is submitted.
    $status = 0;
    if (\Flatfolio\Request::isLoginFormSubmitted())
    {
        if (\Flatfolio\Auth::authenticate(\Flatfolio\Request::getLoginEmail(), \Flatfolio\Request::getLoginPassword()))
        {
            header('Location: /admin');
            die();
        }
        else
        {
            $status = 1; // Bad credentials.
        }
    }
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