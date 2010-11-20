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
	class DevLib{
		public function autoAssetLinks($remove = false){
			if($remove){
				$this->__linuxRemoveAssetSymlinks();
			}
			else{
				$this->__linuxCreateAssetSymlinks();
			}
		}

		private function __linuxCreateAssetSymlinks(){
			$Folder = new Folder(APP . 'views' . DS . 'themed' . DS);
			$folders = $Folder->read();
			$folders = $folders[0];
			if(!is_dir(getcwd() . DS . 'theme')){
				$Folder->create(getcwd() . DS . 'theme', 0755);
			}
			
			$createdLinks = 0;
			foreach((array)$folders as $folder){
				if(is_dir(APP . 'views' . DS . 'themed' . DS . $folder . DS . 'webroot' . DS) && !is_dir(getcwd() . DS . 'theme' . DS . $folder . DS)){
					symlink(
						APP . 'views' . DS . 'themed' . DS . $folder . DS . 'webroot' . DS,
						'theme' . DS . $folder
					);
					++$createdLinks;
				}
			}
			unset($Folder);

			$plugins = App::objects('plugin');
			foreach($plugins as $plugin){
				if(is_dir(App::pluginPath($plugin) . 'webroot' . DS) && !is_dir(getcwd() . DS . Inflector::underscore($plugin))){
					symlink(
						App::pluginPath($plugin) . 'webroot' . DS,
						Inflector::underscore($plugin)
					);
					++$createdLinks;
				}
			}

			return $createdLinks;
		}

		private function __linuxRemoveAssetSymlinks(){
			$themeAssets = getcwd() . DS . 'theme' . DS;
			
			if(is_dir($themeAssets)){
				$Folder = new Folder($themeAssets);
				$folders = $Folder->read();
				$folders = $folders[0];

				foreach($folders as $folder){					
					if(is_link($themeAssets . $folder)){
						pr($themeAssets . $folder);
					}
				}
			}
			
			$plugins = App::objects('plugin');
			foreach($plugins as $plugin){
				if(is_link(getcwd() . DS . Inflector::underscore($plugin))){
					pr(getcwd() . DS . Inflector::underscore($plugin));
				}
			}

			exit;
		}
	}
