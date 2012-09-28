<?php
	class InfinitasTodoShell extends AppShell {
		public $tasks = array(
			'Dev.InfinitasMissingTests'
		);

		private $__options = array(
			'E' => 'everything',
			'M' => 'missing_tests',
			'S' => 'standards',
			'C' => 'cyclomatic_complexity',
			'T' => 'todo',
			'Q' => 'quit'
		);

		public function  __construct($stdout = null, $stderr = null, $stdin = null) {
			parent::__construct($stdout, $stderr, $stdin);
			Configure::write('debug', 2);

			$this->__params['plugins'] = App::objects('plugin');
			if(isset($dispatch->params['plugins'])) {
				$plugins = array();
				foreach(explode(',', $dispatch->params['plugins']) as $plugin) {
					$plugins[] = Inflector::camelize($plugin);
				}

				$this->__params['plugins'] = $plugins;
			}

			$this->__params['format'] = 'text';
		}

		public function main() {
			$this->h1('Dev Roadmap thingy');

			$this->out('[E]verything');
			$this->out('[M]issing Tests');
			$this->out('[S]tandards');
			$this->out('[C]yclomatic complexity');
			$this->out('[T]odo\'s');
			$this->out('[Q]Quit');

			$method = strtoupper($this->in(__('What would you like to generate?'), array_keys($this->__options)));

			$method = $this->__options[$method];
			if(!is_callable(array($this, $method))) {
				$this->out(__('You have made an invalid selection. Please choose an option from above.'));
			}
			else{
				$this->{$method}();
			}

			$this->main();
		}

		public function everything() {
			echo 'everything';
		}

		public function standards() {
			echo 'standards';
		}

		public function missing_tests() {
			$this->InfinitasMissingTests->report($this->__params['plugins'], $this->__params['format']);
		}

		public function cyclomatic_complexity() {
			echo 'cyclomatic_complexity';
		}

		public function todo() {
			echo 'todo';
		}

		public function quit() {
			exit;
		}
	}