<?php
	$devIcons = array(
		array(
			'name' => 'Xhprof',
			'description' => 'Profile requests and see where things can be improved',
			'icon' => '/xhprof/img/icon.png',
			'author' => 'Infinitas',
			'dashboard' => array('plugin' => 'xhprof', 'controller' => 'xhprofs', 'action' => 'index'),
		),
		array(
			'name' => 'Dummy Data',
			'description' => 'Generate random test data that makes sence',
			'icon' => '/dummy/img/icon.png',
			'author' => 'Infinitas',
			'dashboard' => array('plugin' => 'dummy', 'controller' => 'dummy_tables', 'action' => 'index'),
		),
		array(
			'name' => 'PhpInfo',
			'description' => 'See all the information related to the current Php installation',
			'icon' => '/dev/img/php.png',
			'author' => 'Infinitas',
			'dashboard' => array('plugin' => 'dev', 'controller' => 'infos', 'action' => 'phpinfo'),
		),
		array(
			'name' => 'MySQL',
			'description' => 'Information regarding the MySQL server currently running',
			'icon' => '/dev/img/mysql.png',
			'author' => 'Infinitas',
			'dashboard' => array('plugin' => 'dev', 'controller' => 'infos', 'action' => 'mysql_vars'),
		)
	);
?>
<div class="dashboard grid_16">
	<h1><?php echo __('Developer Tools', true); ?></h1>
	<ul class="icons"><li><?php echo implode('</li><li>', current((array)$this->Menu->builDashboardLinks($devIcons, 'dev_icons'))); ?></li></ul>
</div>