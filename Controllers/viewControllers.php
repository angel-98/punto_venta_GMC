<?php
	require_once "./Models/viewModels.php";
	class viewControllers extends viewModels{

		public function get_controller_view(){
			return require_once "./Views/template.php";
		}

		public function get_controller_views(){
			if(isset($_GET['views'])){
				$route=explode("/", $_GET['views']);
				$reply=viewModels::get_model_view($route[0]);
			}else{
				$reply="login";
			}
			return $reply; 
		}
	}