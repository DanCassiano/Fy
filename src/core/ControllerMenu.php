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

			$user = $app['session']->get('user');
		
		if( empty($user))
			return $app->redirect('/login');

			$pag =$app['request']->get('pg');

			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');

			if( $status == "")
				$status = 1;


			$baseURL = $app['request']->getSchemeAndHttpHost();
			$temp = new Temp();
			$vars = array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy",
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=>"",
							"dir"=> $app['dir'],
							"status"=>$status,
							"pg"=> $pag,
							"userImagem"=>'dist/img/user2-160x160.jpg',
							"userNome"=> "Jordan" );

			if( $modulo == "menu") {
				$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
				$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");
				
				$vars['paginas'] = $app['db']->fetchAll('SELECT id, pagina, publicado, date_format( data_criacao, "%d-%m-%Y %H:%m:%s")as data_criacao FROM paginas WHERE publicado = ?',array($status));
			}

			if( $modulo == "galeria") {

				$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/jquery-upload/uploadfile.css\">");
				$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/select2/select2.min.css\">");
				
				$temp->js("<script src='{$baseURL}/plugins/jquery-upload/jquery.uploadfile.min.js'></script>");
				$temp->js("<script src='{$baseURL}/plugins/select2/select2.full.min.js'></script>");
				$temp->js("<script src='{$baseURL}/plugins/jQueryUI/jquery-ui.min.js'></script>");
				$temp->js("<script src='{$baseURL}/js/menu/galeria.js'></script>");

				$vars['paginas'] = $app['db']->fetchAll('SELECT * FROM paginas WHERE publicado = ?',array($status));
			}
			
			$temp->vars( $vars);
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		function operacao( Application $app, $modulo, $operacao ){

			$user = $app['session']->get('user');
		
			if( empty($user))
				return $app->redirect('/login');

			$baseURL = $app['request']->getSchemeAndHttpHost();
			$temp = new Temp();
			$temp->vars(array(
							"baseURL"=> $baseURL,
							"titulo"=> "Fy",
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=> $operacao,
							"dir"=> $app['dir'],
							"db"=>$app['db'],
							"id"=> $app['request']->get("id"),
							"userImagem"=>'dist/img/user2-160x160.jpg',
							"userNome"=> "Jordan"
							));
			$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
			$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");
			$temp->css("<link rel='stylesheet' href='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>");

			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init();
		}

		public function postMenu( Application $app, Request $request, $operacao ){

			$menu = new \Core\Menu( $app['db'] );
			if( $operacao == 'novo') {
				parse_str($request->getContent(), $r);
				$idPagina = $menu->novo( $r );
				if( $r['conteudo'] )
					$menu->addConteudo( $idPagina, $r['conteudo'] );
				return $app->redirect('/site/menu');
			}
			elseif( $operacao == 'edit') {
				parse_str($request->getContent(), $r);
				$idPagina = $menu->edit( $r );
				if( $r['conteudo'] && $r['id'] && empty( $r['idConteudo'] ))
					$menu->addConteudo( $r['id'], $r['conteudo'] );
				else {
					$menu->updateConteudo( $r['idConteudo'] , $r['conteudo']);
				}
				return $app->redirect('/site/menu');
			}
			elseif($operacao == "imagem") {
				parse_str($request->getContent(), $r);
				if( $r['oper'] == "add"){
					$img = new Imagem($app['db']);
					$idImagem = $img->add($r['imagem'], $r['dir']);
					return $menu->registraImagemMenu($idImagem, $r['idMenu'], $r['local']);
				}
				elseif(  $r['oper'] == "todas"){
					parse_str($request->getContent(), $r);

					return $app->json( $menu->listaImagensMenu( $r['idMenu'], $r['local'] ) );
				}
			}
		}
	}