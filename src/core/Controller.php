<?php
namespace Core;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Core\Usuarios;

// use Core\Menu;

class Controller implements ControllerProviderInterface {

	private $dir;
	
	private $vars;
	
	private $action;

	private $rotas;
		
	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$this->dir = $app['dir'];

		//Home
			$factory->get('/','Core\Controller::pagina');
			$factory->get('/{action}','Core\Controller::pagina');

		// upload
			$factory->post('uploads/{destino}','Core\ControllerUpload::upload');

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
							"userNome"=>  $user['nome'],
							"css"=>"",
							"js"=>"",
							"action"=>"" );
		return "";// $this->init();
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
	

	public function pagina( Application $app, $action = "" ){
			$temp = new Temp();
			$var = array("titulo"=> "HOME",
						"dir"=> $app['dir'], 
						'baseURL' => $app['request']->getSchemeAndHttpHost() );

		$menu = $app['db']->fetchAll('SELECT conteudo, tipo FROM paginas LEFT JOIN conteudo ON conteudo.id_pagina =  paginas.id WHERE link= ?',array($action));
		
		if( $action == "" || file_exists( $app['dir'] . "/" .$menu[0]['tipo'] . ".php" )) {
			$paginas = $app['db']->fetchAll('SELECT paginas.id, pagina, link, conteudo, tipo FROM paginas LEFT JOIN conteudo ON conteudo.id_pagina =  paginas.id WHERE publicado =1',array(1));
			$var["paginas"]=$paginas;
			$var["pagina"]=$menu[0];
			$var['action'] = $menu[0]['tipo'];
		}
		else
			$var['action'] = "404";
		if( $action == "contato")
		{
			$temp->js("<script src='{$baseURL}/assets/js/ap.js'></script>");
		}
		$temp->js("<script src='{$baseURL}/assets/js/ap.js'></script>");

		$temp->vars( $var);
		$temp->setDirTemp( $app['dir'] . "index.php" );
		return $temp->init();
	}
}