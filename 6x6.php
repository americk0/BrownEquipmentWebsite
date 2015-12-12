<!DOCTYPE html>
<html>
<head>
	<title>6x6 Mixer Trucks - BrownEquipment - Brown Equipment llc</title>
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
							display_thumbnails($conn, 'SELECT item.*, locations.State FROM item, locations WHERE Subtype="6x6" AND item.Location=locations.ID');
						?>

<!--					<style>
                    table, td, th {
                      border: 1px solid brown;
                                  }
                      th {
                         background-color: brown;
                       color: white;
                      }
                    </style>
		<table>
							<tr>
								<th align = "center">
									Photo
								</th>
								<th align = "center">
									Quantity
								</th>
								<th align = "center">
									Year
								</th>
								<th align = "center">
									Make
								</th>
								<th align = "center">
									Model
								</th>
								<th align = "center">
									Description
								</th>
								<th align = "center">
									Price
								</th>
								<th align = "center">
									Location
								</th>
							</tr>
							<?php //print data listed
								// $conn is set by the php code above

								// $sql = 'SELECT * FROM item WHERE Subtype = "6x6"';
								// $result = $conn->query($sql);
								while($row = $result->fetch_assoc())
								{
								  echo "<tr>" .
										"<td>" . $row['Picture_URL'] . "</td>" .
										'<td style="text-align:center;">'.$row['Quantity'] . "</td>" .
										'<td style="text-align:center;">'.$row['Year'] . "</td>" .
										'<td style="text-align:center;">'.$row['Make'] . "</td>" .
										'<td style="text-align:center;">'.$row['Model'] . "</td>" .
										'<td style="text-align:center;"><a href="display.php?id=' . $row["ID"] . '" >'.$row['Description'] . "</a></td>" .
										'<td style="text-align:center;">'.$row['Price'] . "</td>" .
										'<td style="text-align:center;">'.$row['Quantity'] . "</td>" .
										"</tr>";
								}
							?>

						</table> -->
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
