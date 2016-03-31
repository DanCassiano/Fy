<?php
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\RedirectResponse;

	require_once '../vendor/autoload.php';
	
	$app = new Silex\Application();
	$app->register(new Silex\Provider\SessionServiceProvider());
	$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
			'db.options' => array(
					'driver'    => 'pdo_mysql',
					'host'      => "localhost",
					'dbname'    => "gumball",
					'user'      => "root",
					'password'  => "root",
					'charset'   => 'utf8mb4',
				),
		));

	$schema = $app['db']->getSchemaManager();
	require "../src/schema.php";

	$app['debug'] = true;
	$app['dir'] = dirname(__DIR__) . "/admin/";
	

	Request::enableHttpMethodParameterOverride();

	
	$app->mount('/', new Core\ControllerAdmin());

	$app->before(function (Request $request) use ( $app ) {
			$user = $app['session']->get('user');
			$pagina = $request->getRequestUri();
			if( empty($user) && end(explode("/", $pagina)) !=  "login" )
        	return new RedirectResponse('/admin/login');
		
	});

	$app->error(function (\Exception $e, $code) {
		switch ($code) {
				case 404:
					$message = ' <center>
										<h1>Ops, nada aqui!</h1>
								</center>'.$e->getMessage();
				break;
			default:
				$message = $e->getMessage() . $code;
		}
		return new Response($message);
	});
	$app->run();