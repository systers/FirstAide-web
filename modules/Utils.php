<?php
	class Utils {
		const PROPERTY_MENU = 'menu';
		
		public function getTwig($twigFile, $data = array()) {
			$twigLoader = new Twig_Loader_Filesystem('template');
			$Twig = new Twig_Environment($twigLoader, array(
				'cache' => 'cache',
				)
			);
			$template = $Twig->loadTemplate($twigFile);

			return $template->render($data);
		}

		public static function getPageProperty($page, $property) {
			$propertyMenuArray = array(
				Router::DASHBOARD
			);
			if ($property == self::PROPERTY_MENU && in_array($page, $propertyMenuArray)) {
				return true;
			}
			return false;
		}
	}
?>