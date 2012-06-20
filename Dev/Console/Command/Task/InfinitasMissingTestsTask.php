<?php
	class InfinitasMissingTestsTask extends Shell {
		public $tasks = array(
			'Infinitas'
		);
		
		public function __construct(&$dispatch) {
			parent::__construct($dispatch);

			$this->Folder = new Folder(APP);
		}

		public function report($plugins, $format = null) {
			$this->Infinitas->h1(sprintf('Missing Tests :: %s', date('Y-m-d H:i:s')));
			
			$missing = $this->getMissingTests($plugins);

			$allFiles = $missing['files'];
			$missing = $missing['missing'];

			$grandTotalCount = $grandTotalCountOf = 0;

			$allTests = array();
			foreach($missing as $plugin => $types) {
				$this->Infinitas->h2($plugin);

				$count = $countOf = 0;
				foreach($types as $type => $files) {
					$allTests = array_merge($allTests, (array)$files);

					$count = count($files);
					$grandTotalCount += $count;

					$countOf = count($allFiles[$plugin][$type]);
					$grandTotalCountOf += $countOf;

					if($count) {
						echo sprintf(
							"%s: %s %s\n",
							str_pad(Inflector::humanize($type), 15, ' '),
							$this->Infinitas->color(sprintf('(%d of %d)', $count, $countOf), 'red'),
							implode(' ', (array)$files)
						);
					}
					else{
						echo str_pad(Inflector::humanize($type), 15, ' ') . ': ' . 
						$this->Infinitas->color(
							sprintf("all %d tests created\n", $countOf),
							'green'
						);
					}
				}
			}

			$this->Infinitas->h2('Overall');
			$this->Infinitas->out(sprintf("%d of possible %d tests are missing", $grandTotalCount, $grandTotalCountOf));
			$this->Infinitas->out(sprintf("%d test(s) have been created", $grandTotalCountOf - $grandTotalCount));
			$this->Infinitas->out();
		}

		public function getMissingTests($plugins) {			
			$files = array();
			foreach($plugins as $plugin) {
				$files[$plugin] = array_filter($this->__getFilesThatCouldHaveTests($plugin));
			}

			return array(
				'files' => $files,
				'missing' => $this->__missingTests($files)
			);
		}

		private function __missingTests($applicationFiles) {
			$missing = array();
			foreach($applicationFiles as $plugin => $types) {
				foreach($types as $type => $files) {
					$testFiles = $this->__getFiles($plugin, $type, array(), false, true);

					if(!$testFiles) {
						$missing[$plugin][$type] = $files;
						continue;
					}

					foreach((array)$files as $k => $file) {
						$testFile = str_replace('.php', '.test.php', $file);
						if(in_array($testFile, $testFiles)) {
							unset($files[$k]);
						}

						if(empty($files)) {
							$files = null;
						}
					}

					$missing[$plugin][$type] = $files;
				}
			}

			return $missing;
		}

		private function __getFilesThatCouldHaveTests($plugin) {
			return array(
				'controllers' => $this->__getFiles($plugin, 'controllers', array('components')),
				'components' => $this->__getFiles($plugin, 'components'),
				'models' => $this->__getFiles($plugin, 'models', array('behaviors', 'datasources')),
				'behaviors' => $this->__getFiles($plugin, 'behaviors'),
				'datasources' => $this->__getFiles($plugin, 'datasources'),
				'libs' => $this->__getFiles($plugin, 'libs'),
				'vendors' => $this->__getFiles($plugin, 'vendors'),
				//'views' => $this->__getFiles($plugin, 'views', array('elements', 'helpers'), true),
				'helpers' => $this->__getFiles($plugin, 'helpers'),
				'misc' => $this->__getFiles($plugin, 'misc', array('controllers', 'models', 'views', 'libs', 'vendors'), true)
			);
		}

		private function __getFiles($plugin, $type, $skip = array(), $keepPath = false, $tests = false) {
			$path = $this->__getPath($plugin, $type, $tests);
			if(!$path) {
				return false;
			}

			$this->Folder->cd($path);

			$files = $this->__getFilesRecursive($skip, $keepPath);

			switch($type) {
				case 'controllers':
					foreach($files as $k => $file) {
						if(!strstr($file, 'controller.php')) {
							unset($files[$k]);
						}
					}
					break;

				case 'misc':
					foreach($files as $k => $file) {
						if(!strstr($file, '.php')) {
							unset($files[$k]);
						}
					}
					break;

				case 'components':
				case 'behaviors':
				case 'helpers':
				case 'datasources':
				case 'views':
				case 'libs':
				case 'vendors':
					break;

			}

			return $files;
		}

		private function __getPath($plugin, $type, $tests = false) {
			$pluginPath = App::pluginPath($plugin);
			if($tests) {
				$pluginPath .= 'tests' . DS . 'cases' . DS;
			}
			
			$path = null;
			
			switch($type) {
				case 'misc':
					$path = $pluginPath;
					break;

				case 'controllers':
				case 'models':
				case 'views':
				case 'libs':
				case 'vendors':

				case 'components' && $tests:
				case 'behaviors' && $tests:
				case 'datasources' && $tests:
				case 'helpers' && $tests:
					$path = $pluginPath . $type;
					break;

				case 'components' && !$tests:
					$path = $pluginPath . 'controllers' . DS . $type;
					break;

				case 'behaviors' && !$tests:
				case 'datasources' && !$tests:
					$path = $pluginPath . 'models' . DS . $type;
					break;

				case 'helpers' && !$tests:
					$path = $pluginPath . 'views' . DS . $type;
					break;
			}

			if(!is_dir($path)) {
				return false;
			}

			return $path;
		}

		/**
		 * @brief get files recursively
		 *
		 * @access private
		 * 
		 * @param array $skip list of folders to skip
		 *
		 * @return array the list of files found
		 */
		private function __getFilesRecursive($skip = array(), $savePath = false) {
			$skip = array_merge(
				array('.git'),
				(array)$skip
			);

			$path = $this->Folder->path;
			$data = $this->Folder->read();
			$files = $data[1];
			if(!empty($data[0])) {
				foreach($data[0] as $folder) {
					if(in_array($folder, $skip)) {
						continue;
					}
					
					if($this->Folder->cd($path . DS . $folder)) {
						$tmp = $this->Folder->read();
						if($savePath) {
							foreach($tmp[1] as $k => $file) {
								$tmp[1][$k] = $folder . DS . $file;
							}
						}
						
						$files = array_merge($files, $tmp[1]);
					}
				}
			}

			return $files;
		}
	}
