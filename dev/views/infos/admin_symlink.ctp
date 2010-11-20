<div class="dashboard">
	<h1><?php echo sprintf(__('Symlinks <small>%d links found</small>', true), count($links)); ?></h1>
	<?php
		if(!empty($links)){
			foreach($links as $k => $link){
				$links[$k] = str_replace(getcwd() . DS, 'WEBROOT/', $link);
			}
			
			echo $this->Design->arrayToList($links);
		}
		
		else{
			echo sprintf(
				__('No symlinks available %s', true),
				$this->Html->link(
					__('create some now', true),
					array('action' => 'symlink')
				)
			);
		}
	?>
</div>