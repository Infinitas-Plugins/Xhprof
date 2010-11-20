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

	class InfosController extends DevAppController{
		public $name = 'Infos';

		public $uses = array();
		
		public function admin_index(){
			
		}

		public function admin_phpinfo(){
			
		}

		public function admin_mysql_vars(){
			$User = ClassRegistry::init('Users.User');
			$globalVars = $User->query('show global variables');
			$globalVars = array_combine(
				Set::extract('/VARIABLES/Variable_name', $globalVars),
				Set::extract('/VARIABLES/Value', $globalVars)
			);

			$localVars = $User->query('show variables');
			$localVars = array_combine(
				Set::extract('/VARIABLES/Variable_name', $localVars),
				Set::extract('/VARIABLES/Value', $localVars)
			);

			$localVars = Set::diff($localVars, $globalVars);

			$this->set(compact('globalVars', 'localVars'));
		}

		public function admin_symlink(){
			App::import('libs', 'developer.dev');
			$this->DevLib = new DevLib();

			if(!is_writable(getcwd())){
				$this->notice(
					__('The webroot directory is not writable', true),
					array(
						'redirect' => true
					)
				);
			}

			if(isset($this->params['named']['remove']) && $this->params['named']['remove']){
				$this->__removeSymlinks();
			}

			else{
				$this->__createSymlinks();
			}
		}

		private function __createSymlinks(){
			$links = $this->DevLib->autoAssetLinks();

			if($links && (int)$links > 0){
				$this->notice(
					sprintf(__('%d symlinks created', true), $links),
					array(
						'redirect' => true
					)
				);
			}

			$this->notice(
				sprintf(__('No symlinks were created', true), $links),
				array(
					'redirect' => true
				)
			);
		}

		private function __removeSymlinks(){
			$links = $this->DevLib->autoAssetLinks(true);
		}
	}