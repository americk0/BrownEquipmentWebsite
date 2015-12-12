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

	<?php //insert make into database
		if(!empty($_POST)){
			if(validateMake()){
				$make = $_POST["make"];
				$sql = $conn->prepare('INSERT INTO makes(Make) VALUE (?)');
				$sql->bind_param("s", $make);
				if(!$sql->execute()){
					failUpdate();
				}
			}
			else{
				failUpdate();
			}
		}

		function failUpdate(){
			echo '<script type="text/javascript">alert("Add Make Failed");</script>';
		}

		function validateMake(){
			if(!isset($_POST["make"])){
				return false;
			}
			return true;
		}
	?>

	<form action="add-make.php" method="post">
		<div class="content-wrap">
			<div class="container">
				<div class="main-wrap">
					<div id='wsite-content' class='wsite-elements wsite-not-footer'>
						<table class="tableElements" style="margin-left: auto; margin-right: auto;">
							<tr>
								<th>
									Make
								</th>
								<td>
									<input type="text" name="make" required/>
								</td>
							</tr>
						</table>
						<input id="submitButton" type="submit" value="Submit"/>
					</div>
				</div>
			</div>
			<!-- end container -->
		</div>
		<!-- end main-wrap -->

	</form>

	<?php //load footer
		require('footer.php');
	?>
</html>
