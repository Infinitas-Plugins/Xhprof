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
			'pluginName' => array(
				'color' => 'foo'
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
		 * @var string
		 */
		private $__graphVizLib = '/usr/share/php/Image/GraphViz.php';

		private $__params = array(
			'hide' => array(),
			'format' => array(),
			'plugins' => array(),
			'ignore' => array(
				'Shop', 'Dummy', 'Newsletter', 'Google'
			),
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
		public function  __construct($dispatch) {
			Configure::write('debug', 2);
			App::import('Core', 'Router');

			if(!is_file($this->__graphVizLib)){
				user_error('The GraphViz libs are required', E_USER_ERROR);
			}

			require $this->__graphVizLib;
			$this->GraphViz = new Image_GraphViz();

			parent::__construct($dispatch);
			
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
		}

		public function main() {
			foreach($this->__params['plugins'] as $plugin){
				if(!in_array($plugin, $this->__params['ignore'])){
					$this->buildDiagram($plugin);
				}
			}

			$this->__writeFile();
		}

		public function addNode($Model, $relationType, $plugin){
			if(empty($relationType)){
				return false;
			}

			foreach($Model->{$relationType} as $name => $relatedModel){
				$this->GraphViz->addNode(
					$relatedModel['className'],
					array(
						'title' => $relationType,
						'fontcolor' => $pluginColor,
						'color' => $pluginColor
					),
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

			$this->GraphViz->addNode(
				$plugin . ' Plugin',
				array('shape' => 'box', 'backgroundcolor' => '#00ffd5'),
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
		 * @brief write the file to disk in various formats
		 *
		 * @access private
		 */
		private function __writeFile(){
			if(isset($this->__params['hide']['direction']) && $this->__params['hide']['direction']){
				$this->GraphViz->setDirected(false);
			}

			$file = App::pluginPath('Dev') . 'webroot' . DS . 'img' . DS . 'docs' . DS  . 'relations';

			$this->GraphViz->saveParsedGraph($file . '.dot');
			$this->GraphViz->renderDotFile($file . '.dot', $file . '.svg', 'svg' , 'dot');

			$File = new File($file . '.png');
			$File->write($this->GraphViz->fetch('png'));
			$this->GraphViz->image();
		}
		
		/**
		 * @brief find all the models for the plugin passed in
		 *
		 * Works based on the cakephp convention of Plugin.ModelName which is
		 * returned in an array that can later be used for building the diagrams
		 *
		 * @access private
		 *
		 * @param string $plugin the name of the plugin where models should be looked up
		 *
		 * @return array of models that were found
		 */
		private function __getModels($plugin){
			$path = App::pluginPath($plugin) . 'models';
			$Folder = new Folder($path);
			$files = $Folder->read();

			$return = array();
			foreach($files[1] as $file){
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
	}