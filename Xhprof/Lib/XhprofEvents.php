<?php
	/* 
	 * Short Description / title.
	 * 
	 * Overview of what the file does. About a paragraph or two
	 * 
	 * Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * 
	 * @filesource
	 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * @link http://www.infinitas-cms.org
	 * @package {see_below}
	 * @subpackage {see_below}
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since {check_current_milestone_in_lighthouse}
	 * 
	 * @author {your_name}
	 * 
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */
	class XhprofEvents extends AppEvents{
		public function onRequireLibs(){
			Configure::load('Xhprof.config');

			if(
				App::import('Lib', 'xhprof.xhprof/xhprof_lib.php') &&
				App::import('Lib', 'xhprof.xhprof/xhprof_runs.php') &&
				App::import('Libs', 'Xhprof.Xhprof')
			){
				Xhprof::start();
			}
		}
		
		public function onRequestDone(){
			if(class_exists('Xhprof')){
				Xhprof::runs();
			}
		}
		 
		public function onSetupCache(){
			
		}		

		public function onAdminMenu($event){
			$menu['main']['Dashboard'] = array('plugin' => 'dev', 'controller' => 'infos');
			return $menu;
		}

		public function onRequireCssToLoad($event) {
			if($event->Handler->params['plugin'] == 'xhprof' && isset($event->Handler->params['admin']) && $event->Handler->params['admin']){
				return array(
					'Xhprof.xhprof',
					'Xhprof.autocomplete'
				);
			}
		}

		public function onRequireJavascriptToLoad($event) {
			if($event->Handler->params['plugin'] == 'xhprof' && isset($event->Handler->params['admin']) && $event->Handler->params['admin']){
				return array(
					//'Xhprof.xhprof_report',
					'Xhprof.autocomplete'
				);
			}
		}
	 }