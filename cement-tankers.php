<!DOCTYPE html>
<html>

<head>
	<title>Cement Tankers - BrownEquipment - Brown Equipment llc</title>
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
							echo '<p class="tableTitle">Aluminum</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Tanker" AND Subtype="Aluminum" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Aluminum/Air-Ride</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Tanker" AND Subtype="Aluminum/Air-Ride" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Steel</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Tanker" AND Subtype="Steel" AND item.Location=locations.ID');
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
