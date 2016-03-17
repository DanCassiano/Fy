<?php
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	use Doctrine\DBAL\Schema\Table;

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
if (!$schema->tablesExist('paginas')) {
    $users = new Table('users');
    var_dump( $users);
	die("asdasdads");
    // $users->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
    // $users->setPrimaryKey(array('id'));
    // $users->addColumn('username', 'string', array('length' => 32));
    // $users->addUniqueIndex(array('username'));
    // $users->addColumn('password', 'string', array('length' => 255));
    // $users->addColumn('roles', 'string', array('length' => 255));

    // $schema->createTable($users);

    // $app['db']->insert('users', array(
    //   'username' => 'fabien',
    //   'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
    //   'roles' => 'ROLE_USER'
    // ));

    // $app['db']->insert('users', array(
    //   'username' => 'admin',
    //   'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
    //   'roles' => 'ROLE_ADMIN'
    // ));
}


	$app['debug'] = true;
	$app['dir'] = dirname(__DIR__);

	Request::enableHttpMethodParameterOverride();
	$app->mount('/', new Core\Controller());

	$app->error(function (\Exception $e, $code) {
		switch ($code) {
				case 404:
					$message = ' <center>
										<h1>Ops, nada aqui!</h1>
								</center>';
				break;
			default:
				$message = $e->getMessage() . $code;
		}
		return new Response($message);
	});
	$app->run();