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

	<?php //connect to database
		require('connection.php');
	?>

	<?php //delete selected makes
		if(!empty($_POST)){
			$sql = 'SELECT * FROM makes';
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				if(isset($_POST["delete_" . $row["Make"]])){
					$sql = 'DELETE FROM makes WHERE Make="' . $row["Make"] . '"';
					if(!$conn->query($sql)){
						echo '<script type="text/javascript">alert("Delete Failed");</script>';
					}
				}
			}
		}
	?>

		<form action="makes.php" method="post">
			<div class="content-wrap">
				<div class="container">
					<div class="main-wrap">
						<div id='wsite-content' class='wsite-elements wsite-not-footer'>
							<table class="tableElements" style="margin-left: auto; margin-right: auto;">
								<tr>
									<th>
										Make
									</th>
									<th>
										Delete
									</th>
								</tr>
								<?
									$sql = 'SELECT * FROM makes';
									$result = $conn->query($sql);
									$count = 0;
									while($row = $result->fetch_assoc()){
										$bkg_color = ($count % 2 == 0)? "tableRowDark" : "tableRowLight";
										echo '<tr class="' . $bkg_color . '">';
										echo '<td>' . $row["Make"] . '</td>';
										echo '<td style="text-align: center;"><input type="checkbox" name="delete_' . $row["Make"] . '" value="' . $row["Make"] . '"/></td>';
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
