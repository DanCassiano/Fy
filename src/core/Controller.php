<?php
namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;

class Controller implements ControllerProviderInterface {

	private $dir;
	private $vars;
	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$this->dir = $app['dir'];
		$factory->get('/','Core\Controller::home');
		return $factory;
	}

	public function home( Application $app ){
		$this->dir = $app['dir'];
		$this->vars = array("baseURL"=> $app['request']->getSchemeAndHttpHost());
		return $this->init();
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