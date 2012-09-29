<?php
/**
 * @brief Filter iterator for finding test files
 */
	class AllTestsFilterIterator extends FilterIterator {
		public function accept() {
			return strstr($this->current(), 'Test.php');
		}
	}

/**
 * @brief Get all the current test groups
 */
	class AllTestGroupsFilterIterator extends FilterIterator {
		public function accept() {
			return strstr($this->current(), '/All') && strstr($this->current(), 'Test.php');
		}
	}

/**
 * @brief Filter iterator for finding files that can be tested
 */
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

/**
 * @brief Task for finding missing tests
 */
class InfinitasMissingTestsTask extends AppShell {
/**
 * @brief setup a list of plugins
 *
 * @param type $stdout
 * @param type $stderr
 * @param type $stdin
 */
	public function __construct($stdout = null, $stderr = null, $stdin = null) {
		parent::__construct($stdout, $stderr, $stdin);
		$this->_pluginPaths = array();
		foreach(InfinitasPlugin::listPlugins('all') as $plugin) {
			$this->_pluginPaths[$plugin] = InfinitasPlugin::path($plugin);
		}
	}

/**
 * @brief get the details of all testable files
 *
 * @return array
 */
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

/**
 * @brief figure out what kind of file it is (model, behavior etc)
 *
 * @param string $path
 *
 * @return string
 */
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

/**
 * @brief get the plugin name
 *
 * @param string $path
 *
 * @return string
 */
	protected function _pluginName($path) {
		foreach($this->_pluginPaths as $plugin => $pluginPath) {
			if(strstr($path, $pluginPath) !== false) {
				return $plugin;
			}
		}

		return 'APP';
	}

/**
 * @brief get what tests there are currently in the app
 *
 * @return array
 */
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

/**
 * @brief get the details of the missing tests
 *
 * @return array
 */
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

	protected function _missingGroups() {
		$it = new AllTestGroupsFilterIterator(
				new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator(APP)));

		$plugins = array_flip(array_keys($this->_pluginPaths));
		for ($it->rewind(); $it->valid(); $it->next()) {
			unset($plugins[substr(substr($it->current()->getFilename(), 3), 0, -13)]);
			unset($plugins[substr(substr($it->current()->getFilename(), 3), 0, -8)]);
		}

		return array_flip($plugins);
	}

/**
 * @brief Generate the report on the missing tests
 */
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

		$this->h2('Missing Tests Groups');
		foreach($this->_missingGroups() as $plugin) {
			$this->out(sprintf('%s: %s', str_pad($plugin, 25, ' '), sprintf('All%sTestsTest.php', $plugin)));
		}
		$this->pause();
	}
}
