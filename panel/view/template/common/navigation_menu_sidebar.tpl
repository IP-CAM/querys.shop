<?php
		// echo '<pre style="background-color: #FFFFCB; color: #135092; margin:0px">'; 
		// 	print_r($menus); 
		// echo '</pre>'; 
		//die();
?>

		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="extra_search.html" method="POST">
						<div class="form-container">
							<div class="input-box">
								<a href="javascript:;" class="remove"></a>
								<input type="text" placeholder="Buscar..."/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<?php foreach ($menus as $key => $menu) { ?>
				<li class="<?php echo $menu['class'];?> ">
					<a href="<?php echo $menu['href'];?>">
						<i class="fa <?php echo $menu['icon'];?>"></i>
						<span class="title"><?php echo $menu['title'];?></span>
						<?php if(isset($menu['lvl2'])) : ?> <span class="arrow"></span> <?php endif; ?>
						<?php if($menu['class'] == 'active'): ?> <span class="selected"></span> <?php endif; ?>
					</a>
					<?php if( isset($menu['lvl2']) ) : ?>
					<ul class="sub-menu">
						<?php foreach ($menu['lvl2'] as $key2 => $menu_lvl2) { ?>
						<li>
							<a href="<?php echo $menu_lvl2['href'];?>">
								<i class="fa <?php echo $menu_lvl2['icon'];?>"></i><span class="title"><?php echo $menu_lvl2['title'];?> </span>
								<?php if( isset($menu_lvl2['lvl3']) ) : ?>
									<span class="arrow"></span>
								<?php endif; ?>
								<?php if(isset($menu_lvl2['info']) && $menu_lvl2['info']['num']): ?>
									<span class="badge badge-<?php echo $menu_lvl2['info']['type'];?>"><?php echo $menu_lvl2['info']['num'];?></span>
								<?php endif; ?>
								<!-- <span class="badge badge-roundless badge-warning">new</span> -->
							</a>
							<?php if( isset($menu_lvl2['lvl3']) ) : ?>
							<ul class="sub-menu">
								<?php foreach ($menu_lvl2['lvl3'] as $key3 => $menu_lvl3) { ?>
								<li>
									<a href="<?php echo $menu_lvl3['href'];?>">
									<i class="fa <?php echo $menu_lvl3['icon'];?>"></i><span class="title"><?php echo $menu_lvl3['title'];?> </span>
									<?php if(isset($menu_lvl3['lvl4'])): ?>
										<span class="arrow"></span>
									<?php endif; ?>
									<?php if(isset($menu_lvl3['info']) && $menu_lvl3['info']['num']): ?>
										<span class="badge badge-<?php echo $menu_lvl3['info']['type'];?>"><?php echo $menu_lvl3['info']['num'];?></span>
									<?php endif; ?>
									</a>
									<?php if( isset($menu_lvl3['lvl4']) ) : ?>
									<ul class="sub-menu">
										<?php foreach ($menu_lvl3['lvl4'] as $key4 => $menu_lvl4) { ?>
										<li>
											<a href="<?php echo $menu_lvl4['href'];?>">
											<i class="fa <?php echo $menu_lvl4['icon'];?>"></i><span class="title"><?php echo $menu_lvl4['title'];?> </span>
											</a>
										</li>
										<?php } ?>
									</ul>
									<?php endif; ?>
								</li>
								<?php } ?>
							</ul>
							<?php endif; ?>
						</li>
						<?php } ?>
					</ul>
					<?php endif; ?>
				</li>
				<?php } ?>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	