<!DOCTYPE html>
<html>
<head>
	<title>6x6 Mixer Trucks - BrownEquipment - Brown Equipment llc</title>

		<?php
			require("header.php");
		?>
		<link href="admin/adminstyles.css" type="text/css" rel="stylesheet" />
</head>

	<?php //connect to database
		require('admin/connection.php');
	?>

	<?php
		require('nav.php');
	?>

	<?php
		require('files/formatter.php');
	?>

		<div class="content-wrap">
			<div class="container">
				<div class="main-wrap skinny">
					<div id='wsite-content' class='wsite-elements wsite-not-footer'>

						<?php
							$sql = $conn->prepare('SELECT item.*, locations.State FROM item, locations WHERE Subtype="aluminum" AND item.Location=locations.ID');
							$sql = $conn->prepare('SELECT item.*, locations.State FROM item, locations WHERE item.ID=? AND item.Location=locations.ID');
							$sql->bind_param("i", $_GET["id"]);
							if(!$sql->execute()){
								echo $sql->error;
							}
							$result = $sql->get_result();
							$row = $result->fetch_assoc();
						?>

            <?php
							echo '<table class="tableElements displayTable">';
								echo '<tr>';
									echo '<th>';
						        echo 'Quantity';
						      echo '</th>';
						      echo '<th>';
						        echo 'Name';
						      echo '</th>';
						      echo '<th>';
						        echo 'Description';
						      echo '</th>';
						      echo '<th>';
						        echo 'Price';
						      echo '</th>';
						      echo '<th>';
						        echo 'State';
						      echo '</th>';
								echo '</tr>';
								echo '<tr class="tableRowDark">';
									echo '<td>';
										echo $row['Quantity'];
									echo '</td>';
									echo '<td>';
										echo $row['Year'] . " " . $row['Make'] . " " . $row['Model'];
									echo '</td>';
									echo '<td style="text-align: left;">';
										echo $row['Description'];
									echo '</td>';
									echo '<td>';
										echo format_to_money($row['Price']);
									echo '</td>';
									echo '<td>';
										echo $row['State'];
									echo '</td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td colspan=5>';
										echo '<img class="display_img" src="' . "uploads/" . ((file_exists("uploads/" . $row["Picture_URL"]) && ($row["Picture_URL"] != ""))? $row["Picture_URL"] : "BrownEquipmentDefault.png") . '" />';
									echo '</td>';
								echo '</tr>';
							// echo '<ul style="float: left;">';
							// if($row["Type"] != ''){ echo '<li>Type: ' . $row["Type"] . '</li>'; }
              // if($row["Subtype"] != ''){ echo '<li>Subtype: ' . $row["Subtype"] . '</li>'; }
              // if($row["Make"] != ''){ echo '<li>Make: ' . $row["Make"] . '</li>'; }
              // if($row["Model"] != ''){ echo '<li>Model: ' . $row["Model"] . '</li>'; }
              // if($row["Price"] != ''){ echo '<li>Price: $' . $row["Price"] . '</li>'; }
              // if($row["Description"] != ''){ echo '<li>Description: ' . $row["Description"] . '</li>'; }
							// echo '</ul>';
							echo '</table>';
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

<html>
