<?php
	/*
	 * Controller to view profiles by xhprof
	 *
	 * Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 *
	 * @filesource
	 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
	 * @link http://www.infinitas-cms.org
	 * @package developer
	 * @subpackage developer.xhprof
	 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since o.1
	 *
	 * @author dogmatic69
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 */

	class XhprofHtmlController extends XhprofAppController {
		public $name = 'XhprofHtml';

		public $uses = array();

		public function admin_index(){
			$this->set($this->params['named']);
		}

		public function admin_callgraph(){
			$this->layout = 'xhprof.image';
		}

		public function admin_typeahead(){

		}
	}
