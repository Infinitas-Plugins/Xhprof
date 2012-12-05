<?php
/**
 * XhprofEvents
 *
 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
 * @link http://www.infinitas-cms.org
 * @package Xhprof.Lib
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.6a
 *
 * @author Carl Sutton <dogmatic69@gmail.com>
 */

class XhprofEvents extends AppEvents{
	public function onRequireLibs(Event $Event) {
		App::uses('Xhprof', 'Xhprof.Lib');

		if(class_exists('Xhprof')) {
			Xhprof::start();
		}
	}

	public function onRequestDone(Event $Event) {
		if(class_exists('Xhprof')) {
			$Request = new CakeRequest();
			if (strstr($Request->here, '.json') === false) {
				Xhprof::runs();
			}
		}
	}

	public function onAdminMenu(Event $Event) {
		$menu['main']['Dashboard'] = array('plugin' => 'dev', 'controller' => 'infos');
		return $menu;
	}

	public function onRequireCssToLoad(Event $Event) {
		if($Event->Handler->params['plugin'] == 'xhprof' && isset($Event->Handler->params['admin']) && $Event->Handler->params['admin']) {
			return array(
				'Xhprof.xhprof',
				'Xhprof.autocomplete'
			);
		}
	}

	public function onRequireJavascriptToLoad(Event $Event) {
		if($Event->Handler->params['plugin'] == 'xhprof' && isset($Event->Handler->params['admin']) && $Event->Handler->params['admin']) {
			return array(
				//'Xhprof.xhprof_report',
				'Xhprof.autocomplete'
			);
		}
	}

}