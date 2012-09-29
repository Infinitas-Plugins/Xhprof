<?php
	class AllTestsFilterIterator extends FilterIterator {
		public function accept() {
			return strstr($this->current(), 'Test.php');
		}
	}

	class AllTestableFilterIterator extends FilterIterator {
		public function accept() {
			$skip = array(
				'Test/',
				'Fixture.php',
				'Config/',
				'config/',
				'webroot/',
				'tmp/'
			);
			foreach($skip as $s) {
				if(strstr($this->current(), $s) !== false) {
					return false;
				}
			}

			$testable = $this->current()->getExtension() == 'php' &&
				!strstr($this->current()->getPath(), 'Vendor') &&
				!strstr($this->current()->getFilename(), 'App') &&
				substr($this->current()->getFilename(), 0, 2) != '00';

			return $testable;
		}
	}

	class InfinitasMissingTestsTask extends AppShell {
		public function __construct($stdout = null, $stderr = null, $stdin = null) {
			parent::__construct($stdout, $stderr, $stdin);
			$this->_pluginPaths = array();
			foreach(InfinitasPlugin::listPlugins('all') as $plugin) {
				$this->_pluginPaths[$plugin] = InfinitasPlugin::path($plugin);
			}
		}

		protected function _currentFiles() {
			$it = new AllTestableFilterIterator(
                  new RecursiveIteratorIterator(
                      new RecursiveDirectoryIterator(APP)));

			$return = array();
			for ($it->rewind(); $it->valid(); $it->next()) {
				$return[$it->current()->getBasename('.php') . 'Test.php'] = array(
					'file' => $it->current()->getFilename(),
					'path' => $it->current()->getPathname(),
					'class' => $it->current()->getBasename('.php'),
					'plugin' => $this->_pluginName($it->current()->getPathname())
				);
			}

			return $return;
		}

		protected function _fileType($path) {
			$types = array(
				'Console/Command' => 'Shell',
				'Console' => 'Console',

				'Model/Behavior' => 'Behavior',
				'Model/Datasource' => 'Datasource',
				'Model' => 'Model',

				'Controller/Component' => 'Component',
				'Controller' => 'Controller',

				'View/Helper' => 'Helper',
				'View' => 'View',

				'Routes/Routing' => 'Routing',

				'Lib' => 'Lib'
			);

			foreach($types as $match => $type) {
				if(strstr($path, $match) != false) {
					return $type;
				}
			}

			return 'Other';
		}

		protected function _pluginName($path) {
			foreach($this->_pluginPaths as $plugin => $pluginPath) {
				if(strstr($path, $pluginPath) !== false) {
					return $plugin;
				}
			}

			return 'APP';
		}

		protected function _currentTests() {
			$it = new AllTestsFilterIterator(
                  new RecursiveIteratorIterator(
                      new RecursiveDirectoryIterator(APP)));

			$return = array();
			for ($it->rewind(); $it->valid(); $it->next()) {
				$return[] = $it->current()->getFilename();
			}

			return $return;
		}

		protected function _getDetails() {
			$currentFiles = $this->_currentFiles();
			$currentTests = $this->_currentTests();

			foreach($currentTests as $test) {
				unset($currentFiles[$test]);
			}

			$return = array();

			foreach(array_values($currentFiles) as $missing) {
				$plugin = $missing['plugin'];
				$type = $this->_fileType($missing['path']);
				unset($missing['plugin']);
				$return[$plugin][$type][] = $missing;
			}

			return $return;
		}

		public function report() {
			$this->h1(sprintf('Missing Tests :: %s', date('Y-m-d H:i:s')));

			$total = 0;
			$allTests = array();
			foreach($this->_getDetails() as $plugin => $missings) {
				$this->h2($plugin);
				ksort($missings);
				foreach($missings as $type => $missing) {
					$this->out(sprintf("    <info>%s</info>", $type));
					foreach($missing as $file) {
						$this->out(sprintf(
							"\t%s \t%s",
							str_pad($file['class'], 30, ' '),
							str_replace(APP, 'APP/', $file['path'])
						));
					}

					$total += count($missing);
				}
			}
			$this->out('Total: ' . $total);
			$this->pause();
		}
	}
