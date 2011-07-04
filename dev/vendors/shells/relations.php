<?php
	class RelationsShell extends Shell {
		public $relations = array(
			'hasOne',
			'hasMany',
			'belongsTo',
			'hasAndBelongsToMany'
		);

		private $__options = array(
			/**
			 * Core Plugins
			 */
			'Assets' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/assets'
			),
			'Categories' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/categories'
			),
			'Charts' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/charts'
			),
			'Comments' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/comments'
			),
			'Configs' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/configs'
			),
			'Contact' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/contact'
			),
			'Contents' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/contents'
			),
			'Crons' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/crons'
			),
			'Data' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/data'
			),
			'Emails' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/emails'
			),
			'Events' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/events'
			),
			'Feed' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/feed'
			),
			'filemanager' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/Filemanager'
			),
			'Filter' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/filter'
			),
			'GeoLocation' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/geo_location'
			),
			'Google' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/google'
			),
			'Installer' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/installer'
			),
			'Libs' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/libs'
			),
			'Locks' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/locks'
			),
			'Management' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/management'
			),
			'MeioUpload' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/meio_upload'
			),
			'Menus' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/menus'
			),
			'Migrations' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/migrations'
			),
			'Modules' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/modules'
			),
			'Newsletter' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/newsletter'
			),
			'Routes' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/routes'
			),
			'Security' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/security'
			),
			'ServerStatus' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/server_status'
			),
			'ShortUrls' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/short_urls'
			),
			'Tags' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/tags'
			),
			'Themes' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/themes'
			),
			'Trash' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/trash'
			),
			'Users' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/users'
			),
			'webmaster' => array(
				'URL' => 'https://github.com/infinitas/infinitas/tree/beta/core/webmaster'
			),

			/**
			 * Supported Plugins
			 */
			'Backlinks' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/backlinks'
			),
			'Blog' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/blog'
			),
			'Cms' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/cms'
			),
			'Facebook' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/facebook',
				'fontcolor' => '#2600ff',
				'color' => '#2600ff'
			),
			'Gallery' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/gallery'
			),
			'Geshi' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/geshi'
			),
			'Shop' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/shop'
			),
			'Thickbox' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/thickbox'
			),
			'Twitter' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/twitter'
			),
			'ViewCounter' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/view_counter'
			),
			'WysiwygCkEditor' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/wysiwyg_ck_editor'
			),
			'WysiwygTinyMce' => array(
				'URL' => 'https://github.com/Infinitas-Plugins/wysiwyg_tiny_mce'
			)
		);

		/**
		 * @brief the path to the GraphViz.php file
		 *
		 * options to use, each one is -<name> comma,seperated,list
		 *  - hide
		 *    - methods (do not show class methods)
		 *    - variables (do not show class variables)
		 *    - direction (do not show the direction of the relations)
		 *    - pluginNames (do not show the 'plugin' models are associated with)
		 *  - format
		 *    - svg (output in svg)
		 *    - gif,png,bmp,jpg,tiff,ico,wbmp,pdf,mif,vrml pick a format
		 *    - plain
		 *    - raw (output raw for direct rendering / writing to file)
		 *
		 * @var array
		 */

		private $__params = array(
			'hide' => array(),
			'format' => array(),
			'plugins' => array(),
			'ignore' => array(
				'Shop', 'Dummy', 'Newsletter', 'Google', 'ApiGenerator'
			),
			'graphViz' => '/usr/share/php/Image/GraphViz.php'
		);

		/**
		 * @brief load up the required libs and call parent::__construct
		 *
		 * @access public
		 *
		 * @param object $dispatch see Cakes Shell::__construct
		 *
		 * @return void
		 */
		public function __construct($dispatch) {
			Configure::write('debug', 2);
			App::import('Core', 'Router');

			if(isset($dispatch->params['graphViz']) && is_file($dispatch->params['graphViz'])){
				$this->__params['graphViz'] = $dispatch->params['graphViz'];
			}
			$this->__loadGraphViz();

			if(isset($dispatch->params['hide'])){
				$this->__params['hide'] = explode(',', $dispatch->params['hide']);
			}

			$this->__params['plugins'] = App::objects('plugin');
			if(isset($dispatch->params['plugins'])){
				$this->__params['plugins'] = explode(',', $dispatch->params['plugins']);
			}

			if(isset($dispatch->params['ignore'])){
				$this->__params['ignore'] = explode(',', $dispatch->params['ignore']);
			}

			$this->__params['output'] = App::pluginPath('Dev') . 'webroot' . DS . 'img' . DS . 'docs' . DS  . 'relations';
			if(isset($dispatch->params['output'])){
				$this->__params['output'] = $dispatch->params['output'];
			}

			foreach(App::objects('plugin') as $plugin){
				if(isset($this->__options[$plugin])){
					continue;
				}
				
				$this->__options[$plugin] = array();
			}

			parent::__construct($dispatch);
		}

		/**
		 * @brief load up the GraphViz dependencies
		 *
		 * @access private
		 *
		 * @return void
		 */
		private function __loadGraphViz(){
			require $this->__params['graphViz'];
			$this->GraphViz = new Image_GraphViz();
		}

		public function app() {
			$this->buildDiagram('App');

			$this->__writeFile();
		}

		public function main() {
			foreach($this->__params['plugins'] as $plugin){
				$this->buildDiagram($plugin);
			}

			$this->__writeFile();
		}

		public function addNode($Model, $relationType, $plugin){
			if(empty($relationType)){
				return false;
			}

			foreach($Model->{$relationType} as $name => $relatedModel){
				$options = array_merge(
					array('title' => $relationType),
					$this->__options[$plugin]
				);

				unset($options[$plugin]['URL']);
				
				$this->GraphViz->addNode(
					$relatedModel['className'],
					$options,
					$Model->alias
				);

				switch($relationType){
					case 'hasOne':
					case 'belongsTo':
						$color = '#ff9900';
						break;

					case 'hasMany':
					case 'hasAndBelongsToMany':
						$color = '#3bad0e';
						break;
				}

				$this->GraphViz->addEdge(
					array($Model->alias => $relatedModel['className']),
					array(
						'label' => $relationType,
						'fontsize' => '8',
						'fontcolor' => $color,
						'color' => $color
					)
				);
			}
		}

		/**
		 * @brief loop through the plugins passed/found and build the diagram
		 *
		 * @access public
		 *
		 * @param string $plugin
		 *
		 * @return void
		 */
		public function buildDiagram($plugin){
			if(in_array($plugin, $this->__params['ignore'])){
				return false;
			}

			$models = $this->__getModels($plugin);
			if(empty($models)){
				return false;
			}

			$this->__recordPluginData($plugin);

			foreach($models as $model){
				$Model = ClassRegistry::init($model);

				if(!isset($Model->alias)){
					continue;
				}

				$this->__recordPluginData($plugin, $Model);

				$this->GraphViz->addNode(
					$Model->alias,
					array('title' => $Model->alias),
					$plugin
				);

				$this->addMethodNodes($Model, $plugin);

				foreach($this->relations as $relationType){
					if(!isset($Model->{$relationType})){
						continue;
					}

					$this->addNode($Model, $relationType, $plugin);
				}
			}
		}

		private function __recordPluginData($plugin, $Model = null){
			if(isset($this->__params['hide']['pluginNames']) && $this->__params['hide']['pluginNames']){
				return false;
			}
			$options = array_merge(
				array('shape' => 'box'),
				$this->__options[$plugin]
			);

			$this->GraphViz->addNode(
				$plugin . ' Plugin',
				$options,
				$plugin
			);

			if($Model){
				$this->GraphViz->addEdge(
					array($plugin . ' Plugin' => $Model->alias),
					array('style' => 'dashed')
				);
			}
		}

		/**
		 * @brief add the methods and variables of the model
		 *
		 * @access public
		 *
		 * @param object $Model the model currently being used
		 * @param string $plugin the name of the plugin the model belongs to
		 *
		 * @return mixed, false if nothing to add. true when adding
		 */
		public function addMethodNodes($Model, $plugin){
			$data = implode(
				"\n",
				$this->__getClassVariables($Model)) . "\n" . implode("\n", $this->__getClassMethods($Model)
			);

			$data = trim($data);

			if(empty($data)){
				return false;
			}

			$this->GraphViz->addNode(
				$data,
				array(
					'title' => $data,
					'fontsize' => '8',
					'shape' => 'box'
				),
				$plugin
			);

			$this->GraphViz->addEdge(
				array($Model->alias => $data),
				array('style' => 'dashed')
			);

			return true;
		}

		/**
		 * @brief find all the models for the plugin passed in
		 *
		 * Works based on the cakephp convention of Plugin.ModelName which is
		 * returned in an array that can later be used for building the diagrams
		 *
		 * This will recurse the dir to find models within sub directories of the
		 * specified model dir, skipping the behaviors and datasource folders
		 *
		 * @access private
		 *
		 * @param string $plugin the name of the plugin where models should be looked up
		 *
		 * @return array of models that were found
		 */
		private function __getModels($plugin){
			$path = APP . 'models';

			if($plugin != 'App'){
				$path = App::pluginPath($plugin) . 'models';
			}

			$Folder = new Folder($path);
			$files = $Folder->read();
			foreach($files[0] as $folder){
				if($folder == 'behaviors' || $folder == 'datasources'){
					continue;
				}

				$Folder = new Folder($path . DS . $folder);
				$dirFiles = $Folder->read();
				$files[1] = array_merge($files[1], $dirFiles[1]);
			}

			$return = array();
			foreach($files[1] as $file){
				if(basename($file) == 'empty'){
					continue;
				}

				$return[] = implode('.', array($plugin, Inflector::camelize(basename($file, '.php'))));
			}

			unset($path, $Folder, $files);

			return $return;
		}

		/**
		 * @brief get a list of class variables without stuff from Model
		 *
		 * @access private
		 *
		 * @param object $Model the model to get the class variables from.
		 *
		 * @return array of variables in the class
		 */
		private function __getClassVariables($Model){
			if(in_array('variables', $this->__params['hide'])){
				return array();
			}

			$variables = array_keys(get_class_vars(get_class($Model)));
			$parentVariables = array_keys(get_class_vars('Model'));

			foreach($variables as $k => $variable){
				if(in_array($variable, $parentVariables) || substr($variable, 0,1) == '__'){
					unset($variables[$k]);
					continue;
				}

				$variables[$k] = '$' . $variables[$k];
			}

			unset($parentVariables, $k, $variable);

			return $variables;
		}

		/**
		 * @brief get a list of class methods without stuff from Model
		 *
		 * @access private
		 *
		 * @param object $Model the model to get the methods from
		 *
		 * @return array the methods from the class
		 */
		private function __getClassMethods($Model){
			if(in_array('methods', $this->__params['hide'])){
				return array();
			}

			$methods = get_class_methods(get_class($Model));
			$parentMethods = get_class_methods('Model');

			foreach($methods as $k => $method){
				if(in_array($method, $parentMethods) || substr($method, 0,1) == '__'){
					unset($methods[$k]);
					continue;
				}

				$methods[$k] = '=> ' . $methods[$k];
			}

			unset($parentMethods, $k, $method);

			return $methods;
		}

		/**
		 * @brief write the file to disk in various formats
		 *
		 * @access private
		 */
		private function __writeFile(){
			if(isset($this->__params['hide']['direction']) && $this->__params['hide']['direction']){
				$this->GraphViz->setDirected(false);
			}

			$this->GraphViz->saveParsedGraph($this->__params['output'] . '.dot');
			$this->GraphViz->renderDotFile(
				$this->__params['output'] . '.dot',
				$this->__params['output'] . '.svg',
				'svg' ,
				'dot'
			);

			$File = new File($this->__params['output'] . '.png');
			$File->write($this->GraphViz->fetch('png'));

			ob_start();
			$html = '<html><head></head><body>';
			$this->GraphViz->image();
			$html .= ob_get_contents();
			$html .= '</body></html>';
			ob_end_clean();

			$File = new File($this->__params['output'] . '.html');
			$File->write($html);
		}
	}