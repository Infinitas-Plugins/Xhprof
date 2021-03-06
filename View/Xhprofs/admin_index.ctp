<?php
	/**
	 * Blog Comments admin index
	 *
	 * this is the page for admins to view all the posts on the site.
	 *
	 * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 *
	 * Licensed under The MIT License
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @filesource
	 * @copyright	 Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 * @link		  http://infinitas-cms.org
	 * @package	   blog
	 * @subpackage	blog.views.posts.admin_index
	 * @license	   http://www.opensource.org/licenses/mit-license.php The MIT License
	 */
	echo $this->Form->create('Xhprof', array('url' => array('action' => 'mass')));
	echo $this->Infinitas->adminIndexHead($filterOptions);
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			__d('xhprof', 'Session'),
			__d('xhprof', 'Run time'),
			__d('xhprof', 'Action')
		));

		foreach($xhprofData as $data) {
			if(!strstr($data['Xhprof']['session'], env('HTTP_HOST'))) {
				continue;
			} ?>
			<tr>
				<td>
					<?php
						echo $this->Html->link($data['Xhprof']['session'], array(
							'Xhprof.xhprof_session' => $data['Xhprof']['session']
						));
					?>&nbsp;
				</td>
				<td>
					<?php
						$date = explode('_', $data['Xhprof']['time']);
						echo date('j M, H:m:s', str_replace('_', '.', $date[0])), '.', $date[1];
					?>&nbsp;
				</td>
				<td>
					<?php
						echo $this->Html->link(__d('xhprof', 'view'), array(
							'action' => 'view',
							$data['Xhprof']['time'].'.'.$data['Xhprof']['session']
						));
					?>&nbsp;
				</td>
			</tr> <?php
		}
	?>
</table>
<?php
	echo $this->Form->end();