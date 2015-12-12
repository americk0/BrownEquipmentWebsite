<!DOCTYPE html>
<html>

<head>
	<title>Cement Storage - BrownEquipment - Brown Equipment llc</title>
	<?php
			require("header.php");
		?>
</head>

<?php //connect to database
				require('admin/connection.php');
			?>

	<?php
				require('nav.php');
			?>

		<div class="content-wrap">
			<div class="container">
				<div class="main-wrap">
					<div id='wsite-content' class='wsite-elements wsite-not-footer'>

						<?php //display thumbnails
							require('thumbnails.php');
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Subtype="Cement Storage" AND item.Location=locations.ID');
						?>

					</div>
				</div>
			</div>
			<!-- end container -->
		</div>
		<!-- end main-wrap -->

		<?php
			require('footer.php');
		?>

</html>
