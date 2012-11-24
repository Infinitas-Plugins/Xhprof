<?php
/**
 * XhprofHtmlController
 *
 * @package Xhprof.Controller
 */

/**
 * XhprofHtmlController
 *
 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
 * @link http://www.infinitas-cms.org
 * @package Xhprof.Controller
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.6a
 *
 * @author Carl Sutton <dogmatic69@infinitas-cms.org>
 */

class XhprofHtmlController extends XhprofAppController {
	public $uses = false;

	public function admin_index() {
		$this->set($this->request->params['named']);
	}

	public function admin_callgraph() {
		$this->layout = 'Xhprof.image';
	}

	public function admin_typeahead() {

	}

}