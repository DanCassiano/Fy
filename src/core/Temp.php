<?php 

	namespace Core;
	use Core\FaleConosco;
	/**
	* Temp
	*/
	class Temp
	{
		private $temp;

		private $vars;

		private $js;

		private $css;

		private $app;

		function __construct( $app ){
			$this->app = $app;
			$this->js = "";
		}

		public function css( $asset ){
			$this->css .= $asset;
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

		public function globais( ){
			$fale = new FaleConosco( $this->app['db'] );
			$this->vars["qtdFaleConosco"] = $fale->temMensagens();
			$this->vars["mensagens"]= $fale->getMensagens();
			$this->vars["baseURL"] = $this->app['request']->getSchemeAndHttpHost() . "/admin/";
			$this->vars["dir"] = $this->app['dir'];

			$user = $this->app['session']->get('user');
			$this->vars["userImagem"]= $user['imagem'];
			$this->vars["userNome"]= $user['nome'];
		}

		public function init( ){
			$this->globais( );
			$this->vars['js'] = $this->js;
			$this->vars['css'] = $this->css;
			ob_start();
				extract($this->vars);
				require $this->temp;
				$pag = ob_get_contents();
			ob_end_clean();
			
			return str_replace(array("\n","\r","\t"),'',$pag);
		}

	}