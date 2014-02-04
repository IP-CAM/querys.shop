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
								<input type="text" placeholder="Search..."/>
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
							</a>
							<?php if( isset($menu_lvl2['lvl3']) ) : ?>
							<ul class="sub-menu">
								<?php foreach ($menu_lvl2['lvl3'] as $key3 => $menu_lvl3) { ?>
								<li>
									<a href="<?php echo $menu_lvl3['href'];?>">
									<i class="fa <?php echo $menu_lvl3['icon'];?>"></i><span class="title"><?php echo $menu_lvl3['title'];?> </span>
									<span class="arrow"></span>
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
				<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							4 Level Menu
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
							<i class="fa fa-cogs"></i> Item 1
							<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="fa fa-user"></i>
									Sample Link 1
									<span class="arrow">
									</span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#"><i class="fa fa-remove"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pencil"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-edit"></i> Sample Link 1</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 2</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 3</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-globe"></i> Item 2
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 1</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-folder-open"></i>
							Item 3 </a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-user"></i>
					<span class="title">
						Login Options
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="login.html">
							Login Form 1</a>
						</li>
						<li>
							<a href="login_soft.html">
							Login Form 2</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-th"></i>
					<span class="title">
						Data Tables
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="table_basic.html">
							Basic Datatables</a>
						</li>
						<li>
							<a href="table_responsive.html">
							Responsive Datatables</a>
						</li>
						<li>
							<a href="table_managed.html">
							Managed Datatables</a>
						</li>
						<li>
							<a href="table_editable.html">
							Editable Datatables</a>
						</li>
						<li>
							<a href="table_advanced.html">
							Advanced Datatables</a>
						</li>
						<li>
							<a href="table_ajax.html">
							Ajax Datatables</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Portlets
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="portlet_general.html">
							General Portlets</a>
						</li>
						<li>
							<a href="portlet_draggable.html">
							Draggable Portlets</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-map-marker"></i>
					<span class="title">
						Maps
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="maps_google.html">
							Google Maps</a>
						</li>
						<li>
							<a href="maps_vector.html">
							Vector Maps</a>
						</li>
					</ul>
				</li>
				<li class="last ">
					<a href="charts.html">
					<i class="fa fa-bar-chart-o"></i>
					<span class="title">
						Visual Charts
					</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	