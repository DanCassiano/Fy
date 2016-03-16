<?php
namespace Core;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller implements ControllerProviderInterface {

	private $dir;
	private $vars;
	private $action;
	
	public function connect(Application $app) {

		$factory=$app['controllers_factory'];

		$user = $app['session']->get('user');

		// if( empty($user))
			// $app->redirect('login');

		$this->dir = $app['dir'];
		$factory->get('/','Core\Controller::home');
		$factory->get('{action}/{modulo}','Core\Controller::action');
		$factory->get('{action}/{modulo}/{operacao}','Core\Controller::actionModulo');


		$factory->get('login','Core\Controller::login');

		return $factory;
	}

	public function home( Application $app ){		

		$this->dir = $app['dir'];
		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - HOME");
		return $this->init();
	}

	public function action( Application $app, $action, $modulo ){
		$this->dir = $app['dir'];
		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - " . $modulo,
							"action"=> $action,
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $this->dir);
		return $this->init();
	}
	public function actionModulo( Application $app, $action, $modulo, $operacao ){
		$this->dir = $app['dir'];
		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy - " . $modulo,
							"action"=> $action,
							"modulo"=> $modulo,
							"operacao"=>$operacao,
							"dir"=> $this->dir);
		return $this->init();
	}

	private function modulo( $action, $modulo ){
		require $this->dir . "/" . $action . "/" . $modulo . ".php";
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