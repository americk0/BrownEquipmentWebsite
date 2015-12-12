<body class="no-header-page  wsite-page-locations wsite-theme-light">
	<input type="checkbox" id="navTrigger" />

	<div class="wrapper">
		<div class="cento-header">
			<div class="container">
				<div class="logo">
					<span class="wsite-logo">

						<a href="../index.php">
							<?php
								$filename = trim(file_get_contents('../files/content_logo_name.txt'), '\t\n\0\r ');
								echo '<img src="' . '../uploads/logos/' . $filename . '" style="margin-top:14px;" />';
							?>
						</a>
					</span>
				</div>
				<label for="navTrigger" class="hamburger">
					<span></span>
				</label>
			</div>
			<div class="nav-wrap">
				<div class="container">
					<div class="nav desktop-nav">
						<ul class="wsite-menu-default">
							<?
								echo '<li id="' . (((basename($_SERVER['PHP_SELF']) == 'index.php') || (basename($_SERVER['PHP_SELF']) == 'add-record.php'))? 'active' : 'pg212330434891730316') . '" class="wsite-menu-item-wrap">';
							?>
								<a href="index.php" class="wsite-menu-item">
									Records
								</a>
								<div class="wsite-menu-wrap" style="display:none">
									<ul class="wsite-menu">
										<li id="wsite-nav-468234220756254937" class="wsite-menu-subitem-wrap ">
											<a href="add-record.php" class="wsite-menu-subitem">
												<span class="wsite-menu-title">
													Add Record
												</span>
											</a>

										</li>

									</ul>
								</div>

							</li>
							<?
							echo '<li id="' . (((basename($_SERVER['PHP_SELF']) == 'makes.php') || (basename($_SERVER['PHP_SELF']) == 'add-make.php'))? 'active' : 'pg212330434891730316') . '" class="wsite-menu-item-wrap">';
							?>
								<a href="makes.php" class="wsite-menu-item">
									Makes
								</a>
								<div class="wsite-menu-wrap" style="display:none">
									<ul class="wsite-menu">
										<li id="wsite-nav-171636732488750266" class="wsite-menu-subitem-wrap ">
											<a href="add-make.php" class="wsite-menu-subitem">
												<span class="wsite-menu-title">
													Add Make
												</span>
											</a>

										</li>

									</ul>
								</div>

							</li>
							<?
							echo '<li id="' . (((basename($_SERVER['PHP_SELF']) == 'sellers.php') || (basename($_SERVER['PHP_SELF']) == 'add-seller.php'))? 'active' : 'pg212330434891730316') . '" class="wsite-menu-item-wrap">';
							?>
								<a href="sellers.php" class="wsite-menu-item">
									Sellers
								</a>
								<div class="wsite-menu-wrap" style="display:none">
									<ul class="wsite-menu">
										<li id="wsite-nav-401769591700682753" class="wsite-menu-subitem-wrap ">
											<a href="add-seller.php" class="wsite-menu-subitem">
												<span class="wsite-menu-title">
													Add Seller
												</span>
											</a>

										</li>

									</ul>
								</div>

							</li>
							<?
							echo '<li id="' . (((basename($_SERVER['PHP_SELF']) == 'locations.php') || (basename($_SERVER['PHP_SELF']) == 'add-location.php'))? 'active' : 'pg212330434891730316') . '" class="wsite-menu-item-wrap">';
							?>
								<a href="locations.php" class="wsite-menu-item">
									Locations
								</a>
								<div class="wsite-menu-wrap" style="display:none">
									<ul class="wsite-menu">
										<li id="wsite-nav-737250372560363219" class="wsite-menu-subitem-wrap ">
											<a href="add-location.php" class="wsite-menu-subitem">
												<span class="wsite-menu-title">
													Add Location
												</span>
											</a>

										</li>

									</ul>
								</div>

							</li>
							<?
								echo '<li id="' . ((basename($_SERVER['PHP_SELF']) == 'content.php')? 'active' : 'pg212330434891730316') . '" class="wsite-menu-item-wrap">';
							?>
								<a href="content.php" class="wsite-menu-item">
									Content
								</a>
								<div class="wsite-menu-wrap" style="display:none">
								</div>

							</li>

						</ul>
					</div>
				</div>
				<!-- end .container -->
			</div>
			<!-- end .nav-wrap -->
		</div>
		<!-- end .header -->
