<?php
	class AllTestsFilterIterator extends FilterIterator {
		public function accept() {
			return strstr($this->current(), 'Test.php');
		}
	}

	class AllTestableFilterIterator extends FilterIterator {
		public function accept() {
			$testable = $this->current()->getExtension() == 'php' &&
				!strstr($this->current(), 'Test') &&
				!strstr($this->current(), 'Fixture.php') &&
				!strstr($this->current(), 'Config') &&
				!strstr($this->current(), 'webroot') &&
				!strstr($this->current()->getPath(), 'Vendor') &&
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
				unset($missing['plugin']);
				$return[$plugin][] = $missing;
			}

			return $return;
		}

		public function report() {
			$this->h1(sprintf('Missing Tests :: %s', date('Y-m-d H:i:s')));

			$total = 0;
			$allTests = array();
			foreach($this->_getDetails() as $plugin => $missings) {
				$this->h2(sprintf('%s (%d)', $plugin, count($missings)));
				foreach($missings as $missing) {
					$this->out(sprintf(
						"%s \t%s",
						str_pad($missing['class'], 30, ' '),
						str_replace(APP, 'APP/', $missing['path'])
					));
				}

				$total += count($missings);
			}
			$this->out('Total: ' . $total);
			$this->pause();
		}
	}
