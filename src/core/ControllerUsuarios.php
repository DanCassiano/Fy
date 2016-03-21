<?php 

	namespace Core;

	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Core\Temp;
	/**
	* ControllerMenu
	*/
	class ControllerUsuarios  {

		function action( Application $app, $modulo ){

			$pag =$app['request']->get('pg');

			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');

			if( $status == "")
				$status = 1;

			$usuarios = $app['db']->fetchAll('SELECT id, nome, email FROM usuario WHERE ativo = ?',array($status));

			$baseURL = $app['request']->getSchemeAndHttpHost();
			$temp = new Temp();
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy",
							"action"=> "usuario",
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $app['dir'],
							"status"=>$status,
							"pg"=> $pag,
							'usuarios'=>$usuarios ));

			$temp->js("<script src='{$baseURL}/plugins/iCheck/icheck.min.js'></script>");
			$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/iCheck/all.css\">");
			$temp->js("<script src='{$baseURL}/js/usuario/user.js'></script>");

			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		function operacao( Application $app, $modulo, $operacao ){

			$baseURL = $app['request']->getSchemeAndHttpHost();
			$temp = new Temp();
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy",
							"action"=> "usuario",
							"modulo"=> $modulo,
							"operacao"=> $operacao,
							"dir"=> $app['dir'],
							"db"=>$app['db'],
							"id"=> $app['request']->get("id"),
							));
			
			$temp->js("<script src='{$baseURL}/plugins/iCheck/icheck.min.js'></script>");
			$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/iCheck/all.css\">");
			$temp->js("<script src='{$baseURL}/js/usuario/user.js'></script>");
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		public function postUsuario( Application $app, Request $request, $operacao ){
			$class = new \Core\Usuarios( $app['db'] );
			parse_str($request->getContent(), $r);
			if( $operacao == 'novo'){
				$class->novo($r);
			}
			if( $operacao == 'edit'){

				
			}
			return $app->redirect('/usuario/users');
		}
	}