<?php
	/**
	 * A bunch of methods that can be used to aid the development and release of
	 * an Application
	 * 
	 * Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * 
	 * @filesource
	 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * @link http://www.infinitas-cms.org
	 * @package Developer
	 * @subpackage Developer.dev.libs.dev_lib
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since 0.1
	 * 
	 * @author dogmatic69
	 * 
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */
	class DevLib {
		/**
		 * look through the webroot dir and find any symlinks. Also looks through
		 * the webroot/theme dir for any links.
		 *
		 * @return array a list of smylink folders
		 */
		public function listSymlinks() {
			$themeAssets = getcwd() . DS . 'Theme' . DS;
			$links = array();

			if(is_dir($themeAssets)) {
				$Folder = new Folder($themeAssets);
				$folders = $Folder->read();
				$folders = $folders[0];

				foreach($folders as $folder) {
					if(is_link($themeAssets . $folder)) {
						$links[] = $themeAssets . $folder;
					}
				}
			}

			$plugins = CakePlugin::loaded();
			foreach($plugins as $plugin) {
				$file = getcwd() . DS . Inflector::underscore($plugin);
				if(is_link($file)) {
					$links[] = $file;
				}
			}

			return $links;
		}

		/**
		 * create and delete links to asset files for your app, this will help
		 * speed the site up by making plugin assets not serve through php.
		 *
		 * Sites with many plugins can have 50 or more requests through php for
		 * each page load. Having symlinks to all the plugin assets will reduce
		 * this to just one.
		 *
		 * creating the links will first remove any existing links and then recreate
		 * all of them
		 *
		 * @param bool $remove pass true to remove them
		 * @return int the number of links that were added / removed.
		 */
		public function autoAssetLinks($remove = false) {
			if($remove === true) {
				return $this->__removeAssetSymlinks();
			}
			
			else{
				$this->__removeAssetSymlinks();
				return $this->__createAssetSymlinks();
			}
		}

		/**
		 * create symlinks to asset files in the app. Will find all themes and
		 * plugins with asset files (css / js) and create symlinks to the files
		 * in the webroot dir
		 *
		 * @return int the number of links that were created
		 */
		private function __createAssetSymlinks() {
			$Folder = new Folder(APP . 'View' . DS . 'Themed' . DS);
			$folders = $Folder->read();
			$folders = $folders[0];
			if(!is_dir(getcwd() . DS . 'Theme')) {
				$Folder->create(getcwd() . DS . 'Theme', 0755);
			}
			
			$createdLinks = 0;
			foreach((array)$folders as $folder) {
				$themeWebroot = APP . 'View' . DS . 'Themed' . DS . $folder . DS . 'webroot';
				$targetSymlink = getcwd() . DS . 'Theme' . DS . $folder . DS;
				if(is_dir($themeWebroot) && !is_dir($targetSymlink)) {
					symlink($themeWebroot, $targetSymlink);
					++$createdLinks;
				}
			}
			unset($Folder);

			$plugins = CakePlugin::loaded();
			foreach($plugins as $plugin) {
				if(is_dir(App::pluginPath($plugin) . 'webroot' . DS) && !is_dir(getcwd() . DS . $plugin)) {
					symlink(
						App::pluginPath($plugin) . 'webroot' . DS,
						Inflector::underscore($plugin)
					);
					++$createdLinks;
				}
			}

			return $createdLinks;
		}

		/**
		 * Remove symlinks to asset files
		 *
		 * @return int the number of links that were removed
		 */
		private function __removeAssetSymlinks() {
			$links = $this->listSymlinks();
			$removedLinks = 0;

			foreach($links as $link) {
				if(unlink($link)) {
					++$removedLinks;
				}
			}

			return $removedLinks;
		}
	}