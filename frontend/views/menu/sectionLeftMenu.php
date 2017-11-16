<ul class="left-menu-block">
	<?php
		$openItem = false; 
		$menuHeader = '';
		foreach ($menuItems AS $key => $val) :?>
			<?php if (!empty($section) && (($val['id'] == $section->id && $section->level == 0) || ($val['id'] == $section->pid && $section->level == 1))) :
					$openItem = true;
					$menuHeader = $val['name'];?>
				<li class="active">
					<a href="<?php echo $this->createCPUUrl('/menu/'.$val['id'].'/');?>"><?php echo $val['name']?></a>
					<ul class="submenu">
			<?php else :?>
				<?php if ($openItem && $val['level'] == 0) :
					$openItem = false;?>
					</ul>
				</li>
				<?php endif;?>
				<li><a href="<?php echo $this->createCPUUrl('/menu/'.$val['id'].'/');?>"><?php echo $val['name']?></a></li>
			<?php endif;?>
	<?php endforeach;?>
	<?php if ($openItem) :
		$openItem = false;?>
		</ul>
	</li>
	<?php endif;?>
</ul>