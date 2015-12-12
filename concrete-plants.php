<!DOCTYPE html>
<html>

<head>
	<title>Concrete Plants - BrownEquipment - Brown Equipment llc</title>
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
							echo '<p class="tableTitle">Central Mix</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Plant" AND Subtype="Central Mix" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Stationary Drybatch</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Plant" AND Subtype="Stationary Drybatch" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Portable Drybatch</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Plant" AND Subtype="Portable Drybatch" AND item.Location=locations.ID');
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
