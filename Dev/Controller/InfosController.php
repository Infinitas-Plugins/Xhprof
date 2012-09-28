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

	class InfosController extends DevAppController {
		public $uses = false;

		public function __construct($request = null, $response = null) {
			parent::__construct($request, $response);

			unset($this->components['Filter.Filter']);
		}

		public function admin_index() {

		}

		public function admin_symlink() {
			App::uses('DevLib', 'Dev.Lib');
			$this->DevLib = new DevLib();

			if(!is_writable(getcwd())) {
				$this->notice(
					__('The webroot directory is not writable'),
					array(
						'redirect' => true
					)
				);
			}

			if(isset($this->request->params['named']['remove']) && $this->request->params['named']['remove']) {
				$this->__removeSymlinks();
			}

			else if(isset($this->request->params['named']['show']) && $this->request->params['named']['show']) {
				$this->set('links', $this->DevLib->listSymlinks());
			}

			else{
				$this->__createSymlinks();
			}
		}

		private function __createSymlinks() {
			$links = $this->DevLib->autoAssetLinks();

			if($links && (int)$links > 0) {
				$this->notice(
					sprintf(__('%d symlinks created'), $links),
					array(
						'redirect' => true
					)
				);
			}

			$this->notice(
				sprintf(__('No symlinks were created'), $links),
				array(
					'redirect' => true
				)
			);
		}

		private function __removeSymlinks() {
			$links = $this->DevLib->autoAssetLinks(true);

			if($links && (int)$links > 0) {
				$this->notice(
					sprintf(__('%d symlinks removed'), $links),
					array(
						'redirect' => true
					)
				);
			}

			$this->notice(
				sprintf(__('No symlinks were removed'), $links),
				array(
					'redirect' => true
				)
			);
		}
	}