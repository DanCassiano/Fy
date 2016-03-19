<?php
namespace Core;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

// use Core\Menu;

class Controller implements ControllerProviderInterface {

	private $dir;
	private $vars;
	private $action;
	
	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$this->dir = $app['dir'];

		//Home
			$factory->get('/','Core\Controller::home');
		
		// site
			$factory->get('site/{modulo}/','Core\ControllerMenu::action');
			$factory->get('site/{modulo}/{operacao}','Core\ControllerMenu::operacao');
			$factory->post('site/menu/{operacao}','Core\ControllerMenu::postMenu');
		
		// Usuario
			$factory->get('usuario/{modulo}/','Core\ControllerUsuarios::action');
			$factory->get('usuario/{modulo}/{operacao}','Core\ControllerUsuarios::operacao');
			$factory->post('usuario/users/{operacao}','Core\ControllerUsuarios::postUsuario');

		// Login
			$factory->get('login','Core\Controller::login');
			$factory->post('login','Core\Controller::postLogin');

		return $factory;
	}

	public function home( Application $app ){

		$user = $app['session']->get('user');
		
		if( empty($user))
			return $app->redirect('login');

		$this->dir = $app['dir'];
		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - HOME",
							"userImagem"=>'dist/img/user2-160x160.jpg',
							"userNome"=> "Jordan");
		return $this->init();
	}

	public function action( Application $app, $action, $modulo ){
		$this->dir = $app['dir'];

		$status = $app['request']->get('status');

		if( $status == "")
			$status = 1;

		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - " . $modulo,
							"action"=> $action,
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $this->dir,
							"db"=>$app['db'],
							"status"=>$status,
							"pg"=>$app['request']->get('pg'));
		return $this->init();
	}
	public function actionModulo( Application $app, $action, $modulo, $operacao ){
		$this->dir = $app['dir'];

		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - " . $modulo,
							"action"=> $action,
							"modulo"=> $modulo,
							"operacao"=>$operacao,
							"dir"=> $this->dir,
							"db"=>$app['db'],
							"id"=> $app['request']->get('id'));
		return $this->init();
	}

	private function modulo( $action, $modulo ){
		require $this->dir . "/" . $action . "/" . $modulo . ".php";
	}

	public function login(Application $app ){
		
		$user = $app['session']->get('user');
		
		if( !empty($user))
			return $app->redirect('/');

		$this->dir = $app['dir'];

		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - Login",
							"dir"=> $this->dir);
		return $this->loginView();
	}

	public function postLogin( Application $app, Request $request ){

		$r = "";
		parse_str($request->getContent(), $r);
		$app['session']->set('user', $r );

		return $app->redirect('/');
	}

	private function loginView(){
		ob_start();
		extract($this->vars);
		require $this->dir . "/view/login.php";
		$pag = ob_get_contents();
		ob_end_clean();

		return $pag;
	}

	private function init(){
		ob_start();
		extract($this->vars);
		require $this->dir . "/view/index.php";
		$pag = ob_get_contents();
		ob_end_clean();

		return $pag;
	}
}