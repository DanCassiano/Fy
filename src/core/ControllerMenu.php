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

			$menu = new Menu( $app['db']);

			$user = $app['session']->get('user');
			if( empty($user))
				return $app->redirect('/admin/login');

			$pag =$app['request']->get('pg');
			if( $pag == "")
				$pag = 1;

			$status = $app['request']->get('status');
			if( $status == "")
				$status = 1;
			$baseURL = $app['request']->getSchemeAndHttpHost() . "/admin/";
			$temp = new Temp( $app );
			$vars = array(	"titulo"=> "Fy - " .$modulo,
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=>"",
							"status"=>$status,
							"pg"=> $pag);

			if( $modulo == "menu") {
				$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
				$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");
				$vars['paginas'] = $menu;
			}
			elseif( $modulo == "galeria") {

				$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/jquery-upload/uploadfile.css\">");
				$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}/plugins/select2/select2.min.css\">");
				$temp->js("<script src='{$baseURL}/plugins/jquery-upload/jquery.uploadfile.min.js'></script>");
				$temp->js("<script src='{$baseURL}/plugins/select2/select2.full.min.js'></script>");
				$temp->js("<script src='{$baseURL}/plugins/jQueryUI/jquery-ui.min.js'></script>");
				$temp->js("<script src='{$baseURL}/js/menu/galeria.js'></script>");
				$vars['paginas'] = $menu->listaMenus( $status );
			}
			elseif( $modulo == "departamentos") {
				
				if( $status == 1){
					$status = 'N';
				}
				$temp->css("<link rel=\"stylesheet\" href=\"{$baseURL}plugins/datatables/dataTables.bootstrap.css\">");
				$temp->js("<script src='{$baseURL}plugins/datatables/dataTables.bootstrap.min.js'></script>");
				$temp->js("<script src='{$baseURL}/js/menu/departamentos.js'></script>");
				$vars['departamentos'] = $app['db']->fetchAll('SELECT * FROM departamentos WHERE bloqueado = ? ',array($status));
			}
			elseif( $modulo == "faleconosco") {
				$fale = new FaleConosco( $app['db']);
				$vars['faleconosco'] = $fale->getMensagens(!$status );
				$temp->js("<script src='{$baseURL}/js/site/faleconosco.js'></script>");
			}
			elseif( $modulo == "publicidade") {
				$perfil = new Perfil( $app['db']);
				$publ = new Publicidade($app['db']);
				$vars['perfis'] = $perfil->listPerfilt();
				$vars['publicidades'] = $publ->listPublicidades();
			}
			
			$temp->vars( $vars);
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init( );
		}

		public function operacao( Application $app, $modulo, $operacao ){

			$user = $app['session']->get('user');
			if( empty($user))
				return $app->redirect('/login');
			
			$id = $app['request']->get('id');
			$temp = new Temp( $app );
			$baseURL = $app['request']->getSchemeAndHttpHost() . "/admin/";
			$vars = array(
							
							"titulo"=> "Fy",
							"action"=> "site",
							"modulo"=> $modulo,
							"operacao"=> $operacao,
							"dir"=> $app['dir'],
							"db"=>$app['db'],
							"id"=> $app['request']->get("id"),
							"userImagem"=>$user['imagem'],
							"userNome"=> $user['nome'],
							"db"=> $app['db']);
			
			if( $modulo == "departamentos") {

				if( $operacao == 'edit' ){
					$temp->js("<script src='{$baseURL}/js/menu/departamentos.js'></script>");
					$vars['departamento'] = $app['db']->fetchAll('SELECT * FROM departamentos WHERE id = ?',array($id));
				}
				elseif( $operacao == 'contatos'){

					$idDep = $app['request']->get('idDep');
					$vars['departamento'] = $app['db']->fetchAll('SELECT departamento FROM departamentos WHERE id = ?',array($idDep));
					$vars['departamento'] = $vars['departamento'][0]['departamento'];
					
					$sql = "SELECT contatos.`id`, contatos.`contato`, contatos.`nome`
							FROM contatos
							LEFT JOIN contatos_departamento cp ON cp.`id_contato` = contatos.`id`
							WHERE cp.`id_departamento` = ?";
					$vars['contatos'] = $app['db']->fetchAll($sql,array($idDep));
					$vars['idDep']= $idDep;
					$temp->js("<script src='{$baseURL}/js/menu/contatos.js'></script>");
				}
			}
			elseif( $modulo == "faleconosco") {


				if( $operacao == "view" ){
					$fale = new FaleConosco( $app['db']);
					$vars['contato'] = $fale->getMensagem( $id );
				}
			}


			$temp->js("<script src='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'></script>");
			$temp->js("<script src='{$baseURL}/js/menu/menu.js'></script>");
			$temp->css("<link rel='stylesheet' href='{$baseURL}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>");
			$temp->vars( $vars);
			$temp->setDirTemp( $app['dir'] . "/view/index.php" );
			return $temp->init( $app );
		}

		public function postMenu( Application $app, Request $request, $operacao ){

			$menu = new \Core\Menu( $app['db'] );
			parse_str($request->getContent(), $r);
			if( $operacao == 'novo') {
				$idPagina = $menu->novo( $r );
				if( $r['conteudo'] )
					$menu->addConteudo( $idPagina, $r['conteudo'] );
				return $app->redirect('/admin/site/menu');
			}
			elseif( $operacao == 'edit') {
				$idPagina = $menu->edit( $r );
				if( $r['conteudo'] && $r['id'] && empty( $r['idConteudo'] ))
					$menu->addConteudo( $r['id'], $r['conteudo'] );
				else {
					$menu->updateConteudo( $r['idConteudo'] , $r['conteudo']);
				}
				return $app->redirect('/admin/site/menu');
			}
			elseif($operacao == "imagem") {
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
			elseif($operacao == "bloquear") {
				return $app->json( array("status"=>$menu->despublicar( $r['idMenu'] )));
			}
			elseif($operacao == "desbloquear") {
				return $app->json( array("status"=>$menu->publicar( $r['idMenu'] )));
			}
			elseif($operacao == "remover") {
				return $app->json( array("status"=>$menu->del( $r['idMenu'] )));
			}
			elseif($operacao == "subir") {
				return $app->json( array('status'=> $menu->subir( $r['idMenu']) ));
			}
			elseif($operacao == "descer") {
				return $app->json( array('status'=> $menu->descer( $r['idMenu']) ));
			}
		}

		public function postDepartamento( Application $app, Request $request, $operacao  ){

			$dep = new Departamento( $app['db'] );
			parse_str($request->getContent(), $r);
			if( $operacao == 'novo') {
				$id = $dep->add( array('departamento'=> $r['departamento'], 'bloqueado'=> $r['bloqueado']));
				return $app->redirect('/admin/site/departamentos');
			}
			elseif( $operacao == 'edit') {
				$dep->edit( array(
									'id'=> $r['id'],
									'departamento'=> $r['departamento'], 
									'bloqueado'=> $r['bloqueado'] ) 
						);
				return $app->redirect('/admin/site/departamentos');
			}
			elseif( $operacao == 'del') {
			}
			return "" ;
		}

		public function postContato( Application $app, Request $request, $operacao  ){
			$cont = new Contato($app['db']);

			if( $operacao == 'salvar') {

				parse_str($request->getContent(), $r);
				if( empty($r['id'])){
					$dep = new Departamento($app['db']);
					$idContato = $cont->add( array('nome'=> $r['nome'], 'contato'=> $r['email'] ) );
					$dep->vincularContato( $r['idDep'], $idContato );
					$resposta = array("status"=> 1);
				}
				else{
					$re = $cont->edit( array('id'=> $r['id'], 'nome'=> $r['nome'], 'contato'=> $r['email'] ) );
					$resposta = array("status"=> $re);
				}

				return $app->json( $resposta );
			}

			return "" ;
		}

		public function postFaleConosco( Application $app, Request $request, $operacao  ){
			parse_str($request->getContent(), $r);
			$fale = new FaleConosco( $app['db']);
			if( $operacao == "lida"){
				return $app->json( array("status" => $fale->marcar( $r['id'], 1 )));
			}
			elseif( $operacao == "naolida" ){
				return $app->json( array("status" => $fale->marcar( $r['id'], 0 )));
			}

		}

	}