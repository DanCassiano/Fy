<?php 

	namespace Core;

	use Silex\Application;
	use Silex\ControllerProviderInterface;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\HttpException;
	
	/**
	* ControllerUpload
	*/
	class ControllerUpload
	{
		
		function __construct(){}

		public function upload( Application $app, Request $request, $destino){
			return $this->_upload($app, $request, $destino);
		}

		private function normalize( $filename ){
			$filename_raw = $filename;
			$special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
			$filename = str_replace($special_chars, '', $filename);
			$filename = preg_replace('/[\s-]+/', '-', $filename);
			$filename = trim($filename, '.-_');
			return str_replace( $special_chars, "", $filename );
		}

		private function _upload(Application $app, Request $request, $destino ){
			
			$message = array(1,"Sucesso");
			$files = $request->files->get('uploadFile');
			$path = $app['dir'] . "/public/upload/";
			if( !file_exists( $path )){
				mkdir($path);
			}
			
			$path .= $destino;
			if(!file_exists( $path )){
				mkdir($path);
			}
			try{
				$filename = $this->normalize($files->getClientOriginalName());
				$files->move($path,$filename);
				array_push( $message, $filename );
			}
			 catch (Exception $e) {
				$message = array(0,$e->getMessage());
			}
			
			return $app->json($message);
		}
	}