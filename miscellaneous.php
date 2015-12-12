<!DOCTYPE html>
<html>

<head>
	<title>Miscellaneous - BrownEquipment - Brown Equipment llc</title>
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
							echo '<p class="tableTitle">Cement Storage</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Miscellaneous" AND Subtype="Cement Storage" AND item.Location=locations.ID');

							echo '<p class="tableTitle">Other</p>';
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Type="Miscellaneous" AND Subtype="Other" AND item.Location=locations.ID');
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
