<?php
	class viewModels{
		protected function get_model_view($view){
			$Whitelist=["dashboard","manage_user","manage_presentation","manage_laboratory","manage_category","manage_product","manage_provider","manage_lote","profile","manage_purchases","sales_list",
			"register_sale","sales_reports","purchases_reports","manage_clients","manage_company","manage_voucher",
			"product_catalog","about","consult_purchases","consult_sales"]; 
			if(in_array($view, $Whitelist)){
				if(is_file("./Views/contend/".$view."-view.php")){ 
					$contend="./Views/contend/".$view."-view.php";
				}else{
					$contend="login";
				}
			}elseif($view=="index"){
				$contend="login";
			}elseif($view=="login"){
				$contend="login";
			}else{
				$contend="404"; 
			}
			return $contend;
		}  
	}  