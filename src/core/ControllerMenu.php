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
	class ControllerMenu  {

		function action( Application $app, $modulo ){

			$pag =$app['request']->get('pg');

			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');

			if( $status == "")
				$status = 1;

			$paginas = $app['db']->fetchAll('SELECT * FROM paginas WHERE publicado = ?',array($status));

			$baseURL = $app['request']->getSchemeAndHttpHost();
			$temp = new Temp();
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy",
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $app['dir'],
							"status"=>$status,
							"pg"=> $pag,
							'paginas'=>$paginas ));

			$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
			$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");

			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		function operacao( Application $app, $modulo, $operacao ){

			$temp = new Temp();
			$temp->vars(array(
							"baseURL"=> $app['request']->getSchemeAndHttpHost(),
							"titulo"=> "Fy",
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=> $operacao,
							"dir"=> $app['dir'],
							"db"=>$app['db'],
							"id"=> $app['request']->get("id"),
							));
			$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
			$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");
			$temp->css("<link rel='stylesheet' href='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>");

			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		public function postMenu( Application $app, Request $request, $operacao ){
			$class = new \Core\Menu( $app['db'] );
			parse_str($request->getContent(), $r);
			if( $operacao == 'novo'){
				$idPagina = $class->novo( $r );
				if( $r['conteudo'] )
					$class->addConteudo( $idPagina, $r['conteudo'] );
			}
			if( $operacao == 'edit'){

				$idPagina = $class->edit( $r );
				if( $r['conteudo'] && $r['id'] && empty( $r['idConteudo'] ))
					$class->addConteudo( $r['id'], $r['conteudo'] );
				else {
					$class->updateConteudo( $r['idConteudo'] , $r['conteudo']);
				}
			}
			return $app->redirect('/site/menu');
		}
	}