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

	private $js;

	private $css;
		
	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$this->dir = $app['dir'];

		//Home
			$factory
				->get('/{action}','Core\Controller::pagina')
				->value('action', 'home');

		// upload
			$factory->post('uploads/{destino}','Core\ControllerUpload::upload');
		// fale consco
			$factory->post('contato/site/faleconosco','Core\Controller::faleConosco');

		return $factory;
	}

	public function pagina( Application $app, $action ){
		
		$this->dir = $app['dir'];
		$baseURL = $app['request']->getSchemeAndHttpHost() . "/site/";
		$link = ( $action == "home" ? "" : $action  );
		$pagina = $app['db']->fetchAll('SELECT conteudo, tipo FROM paginas LEFT JOIN conteudo ON conteudo.id_pagina =  paginas.id WHERE link= ?',array( $link ));
		$menu = new Menu( $app['db']);

		$var = array("titulo"=> $action, 
					"baseURL" => $baseURL,
					'menus'=> $menu->listaMenus(),
					"action"=>$action, 
					"conteudo"=> $pagina[0]['conteudo'] );

		if( !file_exists( $app['dir'] . "/" .$pagina[0]['tipo'] . ".php" ))
			$var['action'] = "404";
	
		$this->vars( $var);
		$this->setDirTemp( $app['dir'] . "index.php" );
		return $this->init();
	}

	public function faleConosco(Application $app, Request $request  ){

			$fale = new FaleConosco( $app['db']);
			parse_str($request->getContent(), $r);
			$fale->add(array( "asunto"=> $r['asunto'],
								'email'=> $r['email'],
								'msg' => $r['name'] . " <br/>" . $r['msg'],
								'data_criacao' => date("Y-m-d H:m:s"),
								'id_departamento' => 1));
			return 1 ;
		}

	public function js( $asset ){
		$this->js .= $asset;
	}

	public function vars( array $vars ){
		$this->vars = $vars;
	}

	public function setDirTemp( $dir ){
		$this->temp = $dir;
	}

	public function init( ){
		$this->vars['js'] = $this->js;
		$this->vars['css'] = $this->css;
		$this->vars['dir'] = $this->dir;
			ob_start();
				extract($this->vars);
				require $this->temp;
				$pag = ob_get_contents();
			ob_end_clean();
		return str_replace(array("\n","\r","\t"),'',$pag);
	}
}