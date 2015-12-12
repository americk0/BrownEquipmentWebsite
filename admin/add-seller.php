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

	<?php //insert seller into database
		if(!empty($_POST)){
			if(validateMake()){
				$seller = $_POST["seller"];
				$sql = $conn->prepare('INSERT INTO sellers(Seller) VALUE (?)');
				$sql->bind_param("s", $seller);
				if(!$sql->execute()){
					failUpdate();
				}
			}
			else{
				failUpdate();
			}
		}

		function failUpdate(){
			echo '<script type="text/javascript">alert("Add Seller Failed");</script>';
		}

		function validateMake(){
			if(!isset($_POST["seller"])){
				return false;
			}
			return true;
		}
	?>

	<form action="add-seller.php" method="post">
		<div class="content-wrap">
			<div class="container">
				<div class="main-wrap">
					<div id='wsite-content' class='wsite-elements wsite-not-footer'>
						<table class="tableElements" style="margin-left: auto; margin-right: auto;">
							<tr>
								<th>
									Seller
								</th>
								<td>
									<input type="text" name="seller" required/>
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
