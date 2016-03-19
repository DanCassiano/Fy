<?php 

	namespace Core;

	/**
	* Temp
	*/
	class Temp
	{
		private $temp;

		private $vars;

		private $js;

		private $css;

		function __construct(){
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

		public function init(){
			
			$this->vars['js'] = $this->js;
			$this->vars['css'] = $this->css;
			ob_start();
				extract($this->vars);
				require $this->temp;
				$pag = ob_get_contents();
			ob_end_clean();
			
			return $pag;
		}

	}