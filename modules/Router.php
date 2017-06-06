<?php
	class Router {
		const HOME = 'home';
		const DASHBOARD = 'dashboard';
		
		public static function getPage($page) {
			$out = array(
				'found' => true
			);
			switch($page) {
				case self::DASHBOARD:
					$out['type'] = self::DASHBOARD;
					$out['title'] = "Home";
					$out['template'] = "dashboard.html";
					break;
				case self::HOME:
					$out['type'] = self::HOME;
					$out['title'] = "Home";
					$out['template'] = "index.html";
					break;
				default:
					$out['type'] = self::HOME;
					$out['title'] = "Home";
					$out['template'] = "index.html";
					$out['found'] = false;
			}
			return $out;
		}
	}
?>