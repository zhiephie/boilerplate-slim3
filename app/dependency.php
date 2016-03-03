<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Register component on container
$container['view'] = function ($c) {
    $settings = $c->get('settings')['view'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        'debug' => $settings['debug'],
        'cache' => $settings['cache_path']
    ]);
	// Add extensions
    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));
    $view->addExtension(new Twig_Extension_Debug());
	
    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['facebook'] = function ($c) {
	$settings = $c->get('settings')['facebook'];
	$fb= new Facebook\Facebook([
	  'app_id' => $settings['app_id'],
	  'app_secret' => $settings['app_secret'],
	  'default_graph_version' => $settings['default_graph_version'],
	]);
	return $fb;
};

// error handle
$container['errorHandler'] = function ($c) {
  return function ($request, $response, $exception) use ($c) {
    $data = [
      'code' => $exception->getCode(),
      'message' => $exception->getMessage(),
      'file' => $exception->getFile(),
      'line' => $exception->getLine(),
      'trace' => explode("\n", $exception->getTraceAsString()),
    ];

    return $c->get('response')->withStatus(500)
             ->withHeader('Content-Type', 'application/json')
             ->write(json_encode($data));
  };
};

// Generate Activation Code
$container['activation'] = function ($c) {
	return new \Cartalyst\Sentinel\Activations\IlluminateActivationRepository;
};

# -----------------------------------------------------------------------------
# Action factories Controllers
# -----------------------------------------------------------------------------

$container['App\Controllers\HomeController'] = function ($c) {
    return new App\Controllers\HomeController(
		$c->get('view'), 
		$c->get('logger'),
		$c->get('App\Repositories\HomeRepository')
    );
};

$container['App\Controllers\UserController'] = function ($c) {
    return new App\Controllers\UserController(
		$c->get('view'), 
		$c->get('logger'),
		$c->get('App\Repositories\UserRepository')
    );
};
# -----------------------------------------------------------------------------
# Factories Models
# -----------------------------------------------------------------------------

$container['Model\User'] = function ($c) {
    return new App\Models\User;
};

# -----------------------------------------------------------------------------
# Factories Repositories
# -----------------------------------------------------------------------------

$container['App\Repositories\HomeRepository'] = function ($c) {
	return new App\Repositories\HomeRepository(
        $c->get('Model\User')
	);
};

$container['App\Repositories\UserRepository'] = function ($c) {
	return new App\Repositories\UserRepository(
        $c->get('Model\User')
	);
};

# -----------------------------------------------------------------------------
# Factories Services
# -----------------------------------------------------------------------------

$container['Mailer'] = function ($c) {
    return new App\Service\Mailer(
        $c->get('view')
    );
};