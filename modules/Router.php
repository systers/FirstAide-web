<?php
	class Router {
		const INDEX = 'index';
		const HOME = 'home';

		const COUNTRY_LIST_FILE = '/javascripts/country_list.json';
		const LOGIN_SUCCESS_URL = HOST.'?query='.self::HOME;
		
		public static function getPage($page) {
			global $APPLICATION_DIR;

			$out = array(
				'found' => true
			);
			switch($page) {
				case self::HOME:
					$out['type'] = self::HOME;
					$out['title'] = "Home";
					$out['template'] = "dashboard.html";
					break;
				case self::INDEX:
					$out['type'] = self::INDEX;
					$out['title'] = "Home";
					$out['template'] = "index.html";
					break;
				default:
					$out['type'] = self::INDEX;
					$out['title'] = "Home";
					$out['template'] = "index.html";
					$out['found'] = false;
			}
			if (file_exists($APPLICATION_DIR.self::COUNTRY_LIST_FILE)) {
				$countries = file_get_contents($APPLICATION_DIR.self::COUNTRY_LIST_FILE);
				$out['country_list'] = json_decode($countries, true);
			}
			return $out;
		}
	}
?>