<?php 
	namespace Core;

	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\HttpException;
	use Core\Usuarios;
	use Core\Temp;

	/**
	* 	ControllerAdmin
	*/
	class ControllerAdmin implements ControllerProviderInterface 
	{
		public function connect(Application $app) {

			$factory=$app['controllers_factory'];
			$this->dir = $app['dir'];

			//Home
				$factory->get('/','Core\ControllerAdmin::home');
		
			// site
				$factory->get('site/{modulo}/','Core\ControllerMenu::action');
				$factory->get('site/{modulo}/{operacao}','Core\ControllerMenu::operacao');
				$factory->post('site/menu/{operacao}','Core\ControllerMenu::postMenu');

		
			// Usuario
				$factory->get('usuario/{modulo}/','Core\ControllerUsuarios::action');
				$factory->get('usuario/{modulo}/{operacao}','Core\ControllerUsuarios::operacao');
				$factory->post('usuario/users/{operacao}','Core\ControllerUsuarios::postUsuario');


			// Login
				$factory->get('login','Core\ControllerAdmin::login');
				$factory->get('logout','Core\ControllerAdmin::logout');
				$factory->post('login','Core\ControllerAdmin::postLogin');

			// upload
				$factory->post('uploads/{destino}','Core\ControllerUpload::upload');

			return $factory;
		}

		public function home( Application $app ){
			
			$user = $app['session']->get('user');
			if( empty($user))
				return $app->redirect('login');

			$temp = new Temp();
			$temp->vars( array('titulo'=> "Lite - Dashboard",
								'baseURL'=> $app['request']->getSchemeAndHttpHost() . "/admin/",
								"userImagem"=>"",
								"userNome"=>"",
								"action"=>"",
								"modulo"=>"",
								"userImagem"=> $user['imagem'], 
								"userNome"=> $user['nome']));
			$temp->setDirTemp( $app['dir'] . "view/index.php");
			return $temp->init();
		}

		public function login(Application $app ){
		
			$user = $app['session']->get('user');
		
			if( !empty($user))
				return $app->redirect('/admin');

			$this->dir = $app['dir'];
			$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost() . "/admin/",
								"titulo"=> "Lite - Login",
								"dir"=> $this->dir);
			return $this->loginView();
		}

		public function logout( Application $app ){
			$app['session']->remove('user' );
			return $app->redirect("/admin");
		}

		public function postLogin( Application $app, Request $request ){

			$r = "";
			parse_str($request->getContent(), $r);

			$user = new Usuarios( $app['db']);
			$usuario = $user->login( $r['email'], md5(md5($r['senha'] )));

			if( !empty($usuario)){
				$app['session']->set('user', $usuario[0]);
			}
			return  $app->redirect('/admin');
		}

		private function loginView(){
			ob_start();
			extract($this->vars);
			require $this->dir . "/view/login.php";
			$pag = ob_get_contents();
			ob_end_clean();
			return $pag;
		}
		
	}