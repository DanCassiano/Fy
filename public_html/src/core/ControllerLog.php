<?php 

	namespace Core;

	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Core\Temp;
	/**
	* ControllerLog
	*/
	class ControllerLog  {

		function action( Application $app, $modulo ){

			$user = $app['session']->get('user');
		
			if( empty($user))
			return $app->redirect('/admin/login');

			$pag =$app['request']->get('pg');

			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');

			if( $status == "")
				$status = 1;


			$baseURL = $app['request']->getSchemeAndHttpHost() . "/admin/";
			$temp = new Temp();
			$vars = array(	"baseURL"=> $baseURL,
							"titulo"=> "Fy - Log de Atividades",
							"action"=> "log",
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $app['dir'],
							"status"=>$status,
							"pg"=> $pag,
							"userImagem"=> $user['userImagem'],
							"userNome"=> $user['userNome'],
							"logs"=>$logs );
			$temp->vars($vars);
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

	}