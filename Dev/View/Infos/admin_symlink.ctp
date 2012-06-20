<div class="dashboard">
	<h1><?php echo sprintf(__('Symlinks <small>%d links found</small>'), count($links)); ?></h1>
	<?php
		if(!empty($links)) {
			foreach($links as $k => $link) {
				$links[$k] = str_replace(getcwd() . DS, 'WEBROOT/', $link);
			}
			
			echo $this->Design->arrayToList($links);
		}
		
		else{
			echo sprintf(
				__('No symlinks available %s'),
				$this->Html->link(
					__('create some now'),
					array('action' => 'symlink')
				)
			);
		}
	?>
</div>