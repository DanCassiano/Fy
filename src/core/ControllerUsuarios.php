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
			$user = $app['session']->get('user');
		
			if( empty($user))
				return $app->redirect('/admin/login');

			$pag =$app['request']->get('pg');
			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');
			if( $status == "")
				$status = 1;

			$usuarios = $app['db']->fetchAll('SELECT id, nome, email, imagem FROM usuario WHERE ativo = ?',array($status));

			$baseURL = $app['request']->getSchemeAndHttpHost()  . "/admin/"; 
			$temp = new Temp( $app );
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy - " .$modulo,
							"action"=> "usuario",
							"modulo"=> $modulo,
							"operacao"=>"",
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

			$user = $app['session']->get('user');
		
			if( empty($user))
				return $app->redirect('/admin/login');
			$baseURL = $app['request']->getSchemeAndHttpHost()  . "/admin/" ;
			$temp = new Temp( $app );
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy - " .$modulo,
							"action"=> "usuario",
							"modulo"=> $modulo,
							"operacao"=> $operacao,
							"db"=>$app['db'],
							"id"=> $app['request']->get("id"),
							"usuario"=> $app['db']->fetchAll('SELECT id, nome, email, imagem FROM usuario WHERE id = ?',array($app['request']->get("id")))));
			
			$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/iCheck/all.css\">");
			$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/jquery-upload/uploadfile.css\">");

			$temp->js("<script src='{$baseURL}/plugins/iCheck/icheck.min.js'></script>");
			$temp->js("<script src='{$baseURL}/plugins/jquery-upload/jquery.uploadfile.min.js'></script>");
			$temp->js("<script src='{$baseURL}/js/usuario/user.js'></script>");
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		public function postUsuario( Application $app, Request $request, $operacao ){
			$usuario = new \Core\Usuarios( $app['db'] );
			parse_str($request->getContent(), $r);
			if( $operacao == 'novo'){
				$usuario->novo($r);
			}
			elseif( $operacao == 'edit'){

				
			}
			elseif( $operacao == 'imagem'){
				$usuario->setImagem($r['id'],$r['imagem']);
			}
			return $app->redirect('/admin/usuario/users');
		}
	}