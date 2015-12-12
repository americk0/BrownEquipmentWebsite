<!DOCTYPE html>
<html>
<head>
	<?php //load header
		require('admin-header.php');
	?>
</head>

	<?php //load nav
		require('nav.php');
	?>

	<?php //load connection
		require('connection.php');
	?>

	<?php //delete selected sellers
		if(!empty($_POST)){
			$sql = 'SELECT * FROM sellers';
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				if(isset($_POST["delete_" . $row["Seller"]])){
					$sql = 'DELETE FROM sellers WHERE Seller="' . $row["Seller"] . '"';
					if(!$conn->query($sql)){
						echo '<script type="text/javascript">alert("Delete Failed");</script>';
					}
				}
			}
		}
	?>

		<form action="sellers.php" method="post">
			<div class="content-wrap">
				<div class="container">
					<div class="main-wrap">
						<div id='wsite-content' class='wsite-elements wsite-not-footer'>
							<table class="tableElements" style="margin-left: auto; margin-right: auto;">
								<tr>
									<th>
										Seller
									</th>
									<th>
										Delete
									</th>
								</tr>
								<?
									$sql = 'SELECT * FROM sellers';
									$result = $conn->query($sql);
									$count = 0;
									while($row = $result->fetch_assoc()){
										$bkg_color = ($count % 2 == 0)? "tableRowDark" : "tableRowLight";
										echo '<tr class="' . $bkg_color . '">';
										echo '<td>' . $row["Seller"] . '</td>';
										echo '<td style="text-align: center;"><input type="checkbox" name="delete_' . $row["Seller"] . '" value="' . $row["Seller"] . '"/></td>';
										echo '</tr>';
										$count++;
									}
								?>
							</table>
						</div>
					</div>
				</div>
				<!-- end container -->
				<input id="submitButton" type="submit" value="Submit"/>
			</div>
			<!-- end main-wrap -->
		</form>

	<?php //load footer
		require('footer.php');
	?>
</html>
