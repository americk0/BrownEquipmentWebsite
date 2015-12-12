<!DOCTYPE html>
<html>

<head>
	<title>Mixer Trucks - BrownEquipment - Brown Equipment llc</title>
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
							echo '<p class="tableTitle">6x6</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Mixer" AND Subtype="6x6" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Boost-a-load</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Mixer" AND Subtype="Boost-a-load" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Front Discharge</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Mixer" AND Subtype="Rear Discharge" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Rear Discharge</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Mixer" AND Subtype="Front Discharge" AND item.Location=locations.ID');
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
