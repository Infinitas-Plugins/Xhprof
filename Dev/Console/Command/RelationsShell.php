<?php
	class RelationsShell extends Shell {
		public $tasks = array(
			'Infinitas'
		);

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
			'Filemanager' => array(
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
				'Shop', 'Dummy', 'Newsletter', 'Google', 'ApiGenerator', 'Facebook', 'Twitter', 'Documents', 'Installer', 'Gallery'
			),
			'graphViz' => '/usr/share/php/Image/GraphViz.php'
		);

		/**
		 * @brief cache of models
		 *
		 * In the format array('plugin' => array(model1, model2, ...))
		 *
		 * @var array
		 * @access private
		 */
		private $__modelCache = array();

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

			require_once CAKE_CORE_INCLUDE_PATH . DS . 'cake' . DS . 'libs' . DS . 'model' . DS . 'model.php';
			require_once APP . 'app_model.php';

			if(isset($dispatch->params['graphViz']) && is_file($dispatch->params['graphViz'])) {
				$this->__params['graphViz'] = $dispatch->params['graphViz'];
			}
			$this->__loadGraphViz();

			if(isset($dispatch->params['hide'])) {
				$this->__params['hide'] = explode(',', $dispatch->params['hide']);
			}

			$this->__params['plugins'] = App::objects('plugin');
			if(isset($dispatch->params['plugins'])) {
				$plugins = array();
				foreach(explode(',', $dispatch->params['plugins']) as $plugin) {
					$plugins[] = Inflector::camelize($plugin);
				}
				
				$this->__params['plugins'] = $plugins;
			}

			if(isset($dispatch->params['ignore'])) {
				$this->__params['ignore'] = explode(',', $dispatch->params['ignore']);
			}

			$this->__params['output'] = App::pluginPath('Dev') . 'webroot' . DS . 'img' . DS . 'docs';
			if(isset($dispatch->params['output'])) {
				$this->__params['output'] = $dispatch->params['output'];
			}

			parent::__construct($dispatch);

			foreach((array)App::objects('plugins') as $plugin) {
				if(isset($this->__options[$plugin])) {
					continue;
				}

				$this->__options[$plugin] = array();
			}

			$this->__checkPaths();
		}

		/**
		 * @brief check that all the need paths are available, create them if needed
		 *
		 * @access private
		 */
		private function __checkPaths() {
			if(!is_dir($this->__params['output'])) {
				echo $this->__params['output'] . ' does not exist';
				exit;
			}

			$mode = 0777;

			if(!is_dir($this->__params['output'] . DS . 'plugins')) {
				$Folder = new Folder($this->__params['output'] . DS . 'plugins', true, $mode);
				if(!is_dir($this->__params['output'] . DS . 'plugins')) {
					echo $this->__params['output'] . DS . 'plugins does not exist';
					exit;
				}
			}

			if(!is_dir($this->__params['output'] . DS . 'models')) {
				$Folder = new Folder($this->__params['output'] . DS . 'models', true, $mode);
				if(!is_dir($this->__params['output'] . DS . 'models')) {
					echo $this->__params['output'] . DS . 'models does not exist';
					exit;
				}
			}

			if(!is_dir($this->__params['output'] . DS . 'fixtures')) {
				$Folder = new Folder($this->__params['output'] . DS . 'fixtures', true, $mode);
				if(!is_dir($this->__params['output'] . DS . 'fixtures')) {
					echo $this->__params['output'] . DS . 'fixtures does not exist';
					exit;
				}
			}
		}

		/**
		 * @brief load up the GraphViz dependencies
		 *
		 * @access private
		 *
		 * @return void
		 */
		private function __loadGraphViz() {
			if(!class_exists('Image_GraphViz')) {
				require $this->__params['graphViz'];
			}
			
			$this->GraphViz = new Image_GraphViz();
		}

		public function main() {
			$this->Infinitas->h1('Relational Diagram');
			$this->Infinitas->out('GraphViz: ' . $this->__params['graphViz']);
			$this->Infinitas->out('Output:   ' . $this->__params['output']);

			$totalPlugins = count(App::objects('plugin'));
			
			$plugins = count($this->__params['plugins']) < $totalPlugins ? implode(', ', $this->__params['plugins']) : '';
			$this->Infinitas->out('Plugins:  (' . count($this->__params['plugins']) . ') ' . $plugins);

			$skipping = '(' . count($this->__params['ignore']) . ') ';
			if(count($this->__params['plugins']) == $totalPlugins) {
				$skipping = $skipping . implode(', ', $this->__params['ignore']);
			}
			else{
				$skipping = '(' . ($totalPlugins - count($this->__params['plugins'])) . ') ';
			}

			$this->Infinitas->out('Skipping: ' . $skipping);
			$this->Infinitas->out('Hidden:   ' . implode(', ', $this->__params['hide']));
			$this->Infinitas->br();


			$this->Infinitas->out('[E]verything');
			$this->Infinitas->out('[A]pp Models only');
			$this->Infinitas->out('[P]lugins only');
			$this->Infinitas->out('[M]models');
			$this->Infinitas->out('[F]ixtures');
			$this->Infinitas->out('[Q]Quit');

			$option = strtoupper($this->in(__('What would you like to generate?'), array('E', 'A', 'P', 'M', 'F', 'Q')));
			switch ($option) {
				case 'E':
					$this->everything();
					break;

				case 'A':
					$this->app();
					break;

				case 'P':
					$this->plugins();
					break;

				case 'M':
					$this->models();
					break;

				case 'F':
					$this->fixtures();
					break;

				case 'Q':
					exit(0);
					break;

				default:
					$this->out(__('You have made an invalid selection. Please choose an option from above.'));
			}

			$this->Infinitas->br();
			$this->Infinitas->br();
			$this->Infinitas->out('All done :)');

			$this->main();
		}

		/**
		 * @brief generate the docs for the app model files
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function app() {
			$this->Infinitas->p('');
			$this->Infinitas->p('Generating for App...');
			$this->buildDiagram('App');

			$this->__writeFile($this->__params['output'] . DS . 'App');
		}

		/**
		 * @brief generate the relations for eveything in the app
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function everything() {
			$this->Infinitas->p('');
			$this->Infinitas->p('Generating for Everything...');
			$this->app();

			foreach($this->__params['plugins'] as $plugin) {
				echo $plugin . '... ';
				$this->buildDiagram($plugin);
			}

			$this->__writeFile($this->__params['output'] . DS . 'Everything');

			$this->plugins();
			$this->models();
		}

		/**
		 * @brief generate the relations for the plugins, seperatly
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function plugins() {
			$this->Infinitas->p('');
			$this->Infinitas->p('Generating for Plugins seperatly...');

			$path = $this->__params['output'];

			foreach($this->__params['plugins'] as $plugin) {
				$this->__loadGraphViz();

				echo $plugin . '... ';
				$this->buildDiagram($plugin);

				$this->__writeFile($this->__params['output'] . DS . 'plugins' . DS . $plugin);

				$this->__params['output'] = $path;
			}
		}

		/**
		 * @brief generate the relations for a specific plugins models, seperatly
		 *
		 * @access public
		 *
		 * @return void
		 */
		public function models() {
			$this->Infinitas->p('');
			$this->Infinitas->p('Generating for Models seperatly...');

			$hide = $this->__params['hide'];
			$this->__params['hide'][] = 'pluginNames';

			foreach($this->__params['plugins'] as $plugin) {
				$this->__getModels($plugin);
				
				foreach($this->__modelCache[$plugin] as $model) {
					$this->__loadGraphViz();
					$this->buildDiagram($plugin, array($model));
					echo sprintf('%s...', $model);
					$this->__writeFile($this->__params['output'] . DS . 'models' . DS . sprintf('%s', $model));
				}
			}

			$this->__params['hide'] = $hide;
		}

		public function addNode($Model, $relationType, $plugin) {
			if(empty($relationType)) {
				return false;
			}

			foreach($Model->{$relationType} as $name => $relatedModel) {
				$options = array('title' => $relationType);
				if(isset($this->__options[$plugin])) {
					$options = array_merge(
						$options,
						(array)$this->__options[$plugin]
					);
				}

				if(!is_array($relatedModel)) {
					$relatedModel = array('className' => $relatedModel);
				}
				list($_plugin, $_model) =pluginSplit($relatedModel['className']);
				
				$this->GraphViz->addNode(
					$_model,
					$options,
					$Model->alias
				);

				switch($relationType) {
					case 'hasOne':
					case 'belongsTo':
						$color = '#ff9900';
						break;

					case 'hasMany':
						$color = '#3bad0e';
						break;

					case 'hasAndBelongsToMany':
						$color = '#ff0000';
						break;
				}

				$this->GraphViz->addEdge(
					array($Model->alias => $_model),
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
		public function buildDiagram($plugin, $models = array()) {
			if(in_array($plugin, $this->__params['ignore'])) {
				return false;
			}

			if(empty($models)) {
				$models = $this->__getModels($plugin);
			}

			if(empty($models)) {
				return false;
			}

			$this->__recordPluginData($plugin);

			foreach($models as $model) {
				list($plugin, $model) = pluginSplit($model);
				$Model = (object)get_class_vars($model);
				if(!isset($Model->alias)) {
					if(isset($Model->name)) {
						$Model->alias = $Model->name;
					}
					else{
						$Model->alias = $model;
					}
				}
				
				if(!isset($Model->name)) {
					$Model->name = $Model->alias;
				}

				if(!isset($Model->plugin)) {
					$Model->plugin = Inflector::underscore($plugin);
				}

				if(!isset($Model->alias)) {
					continue;
				}

				$this->__recordPluginData($plugin, $Model);

				$this->GraphViz->addNode(
					$Model->alias,
					array('title' => $Model->alias),
					$plugin
				);

				$this->addMethodNodes($Model, $plugin);

				foreach($this->relations as $relationType) {
					if(!isset($Model->{$relationType})) {
						continue;
					}

					$this->addNode($Model, $relationType, $plugin);
				}
			}
		}

		private function __recordPluginData($plugin, $Model = null) {
			if(in_array('pluginNames', $this->__params['hide'])) {
				return false;
			}

			$options = array('shape' => 'box');
			if(isset($this->__options[$plugin])) {
				$options = array_merge(
					$options,
					(array)$this->__options[$plugin]
				);
			}

			$this->GraphViz->addNode(
				$plugin . ' Plugin',
				$options,
				$plugin
			);

			if($Model) {
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
		public function addMethodNodes($Model, $plugin) {
			$this->__getTableFields($Model, $plugin);
			$this->__getClassVariables($Model, $plugin);
			$this->__getClassMethods($Model, $plugin);

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
		private function __getModels($plugin) {
			if(isset($this->__modelCache[$plugin])) {
				return $this->__modelCache[$plugin];
			}

			$path = APP . 'models';
			if($plugin != 'App') {
				$path = App::pluginPath($plugin) . 'models';
				$pluginAppModel = App::pluginPath($plugin) . Inflector::underscore($plugin) . '_app_model.php';
				if(is_file($pluginAppModel)) {
					include_once $pluginAppModel;
				}
			}

			$Folder = new Folder($path);
			$files = $Folder->read();
			foreach($files[1] as $k => $_file) {
				$files[1][$k] = $path . DS . $_file;
			}
			
			foreach($files[0] as $folder) {
				if($folder == 'behaviors' || $folder == 'datasources') {
					continue;
				}

				$Folder = new Folder($path . DS . $folder);
				$dirFiles = $Folder->read();
				foreach($dirFiles[1] as $k => $_file) {
					$dirFiles[1][$k] = $path . DS . $folder . DS . $_file;
				}
				
				$files[1] = array_merge($files[1], $dirFiles[1]);
			}

			$this->__modelCache[$plugin] = array();
			foreach($files[1] as $file) {
				if(basename($file) == 'empty') {
					continue;
				}

				$modelName = implode('.', array($plugin, Inflector::camelize(basename($file, '.php'))));
				if(!class_exists($modelName)) {
					include_once $file;
				}
				
				$this->__modelCache[$plugin][] = $modelName;
			}

			unset($path, $Folder, $files, $file);

			return $this->__modelCache[$plugin];
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
		private function __getClassVariables($Model) {
			if(in_array('variables', $this->__params['hide'])) {
				return false;
			}

			$variables = array_keys((array)$Model);
			$parentVariables = array_keys(get_class_vars('Model'));

			foreach($variables as $k => $variable) {
				if(in_array($variable, $parentVariables) || substr($variable, 0,1) == '__') {
					unset($variables[$k]);
					continue;
				}

				$variables[$k] = '$' . $variables[$k];
			}

			unset($parentVariables, $k, $variable);

			$data = $Model->alias . " variables \n" . trim(implode("\n", $variables));

			$this->GraphViz->addNode(
				$data,
				array(
					'title' => sprintf('Variables for %s', $Model->alias),
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addNode(
				$Model->alias . 'Extra',
				array(
					'title' => 'Extra Info',
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addEdge(
				array($Model->alias => $Model->alias . 'Extra'),
				array('style' => 'dashed')
			);

			$this->GraphViz->addEdge(
				array($Model->alias . 'Extra' => $data),
				array('style' => 'dotted', 'fontsize' => 8)
			);

			return true;
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
		private function __getClassMethods($Model) {
			if(in_array('methods', $this->__params['hide'])) {
				return false;
			}
			if(!isset($Model->name)) {
				pr($Model);
				exit;
			}

			$methods = get_class_methods($Model->name);
			$parentMethods = get_class_methods('Model');

			foreach($methods as $k => $method) {
				if(in_array($method, $parentMethods) || substr($method, 0,1) == '__') {
					unset($methods[$k]);
					continue;
				}

				$methods[$k] = '=> ' . $methods[$k];
			}

			unset($parentMethods, $k, $method);

			$data = $Model->alias . " methods\n" . trim(implode("\n", (array)$methods));

			$this->GraphViz->addNode(
				$data,
				array(
					'title' => sprintf('Methods for %s', $Model->alias),
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addNode(
				$Model->alias . 'Extra',
				array(
					'title' => 'Extra Info',
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addEdge(
				array($Model->alias => $Model->alias . 'Extra'),
				array('style' => 'dashed')
			);

			$this->GraphViz->addEdge(
				array($Model->alias . 'Extra' => $data),
				array('style' => 'dotted', 'fontsize' => 8)
			);

			return true;
		}

		/**
		 * @brief get a list of model fields for the model in question
		 *
		 * @access public
		 *
		 * @param object $Model the model being worked with
		 *
		 * @return bool
		 */
		private function __getTableFields($Model) {
			if(in_array('fields', $this->__params['hide'])) {
				return false;
			}
			pr($Model);
			exit;

			$data = $Model->alias . " fields\n" . trim(implode("\n", array_keys($Model->schema())));

			if(empty($data)) {
				return false;
			}

			$this->GraphViz->addNode(
				 $data,
				array(
					'title' => sprintf('Fields for %s', $Model->alias),
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addNode(
				$Model->alias . 'Extra',
				array(
					'title' => 'Extra Info',
					'fontsize' => '8',
					'shape' => 'box'
				),
				$Model->plugin
			);

			$this->GraphViz->addEdge(
				array($Model->alias => $Model->alias . 'Extra'),
				array('style' => 'dashed')
			);

			$this->GraphViz->addEdge(
				array($Model->alias . 'Extra' => $data),
				array('style' => 'dotted', 'fontsize' => 8)
			);

			return true;
		}

		/**
		 * @brief write the file to disk in various formats
		 *
		 * @access private
		 */
		private function __writeFile($path = null) {
			$this->Infinitas->br();
			$this->Infinitas->br();
			$this->Infinitas->out('Writing files:');

			if(!$path) {
				$path = $this->__params['output'];
			}

			if(isset($this->__params['hide']['direction']) && $this->__params['hide']['direction']) {
				$this->GraphViz->setDirected(false);
			}

			echo 'DOT file... ';

			$this->GraphViz->saveParsedGraph($path . '.dot');

			echo 'SVG file... ';
			$this->GraphViz->renderDotFile(
				$path . '.dot',
				$path . '.svg',
				'svg' ,
				'dot'
			);

			echo 'PNG file... ';
			$File = new File($path . '.png');
			$File->write($this->GraphViz->fetch('png'));

			echo 'HTML file... ';
			ob_start();
			$html = '<html><head></head><body>';
			$this->GraphViz->image();
			$html .= ob_get_contents();
			$html .= '</body></html>';
			ob_end_clean();

			$File = new File($path . '.html');
			$File->write($html);
		}
	}