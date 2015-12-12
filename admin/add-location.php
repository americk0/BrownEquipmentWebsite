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

	<?php //insert location into database
		if(!empty($_POST)){
			if(validateUpdate()){
				$street = $_POST["street"];
				$city = $_POST["city"];
				$state = $_POST["state"];
				$zip = $_POST["zip"];
				$zip = ($zip == null || $zip == '')? null : $zip;

				$sql = $conn->prepare('INSERT INTO locations(Street, City, State, ZIP)
					VALUES (?, ?, ?, ?)');
				$sql->bind_param('sssi', $street, $city, $state, $zip);
				if(!$sql->execute()){
					failUpdate();
				}
			}
			else{
				failUpdate();
			}
		}

		function failUpdate($num){
			echo '<script>console.error("update failed (' . $num . ')");</script>';
		}

		function validateUpdate(){
			$state = $_POST["state"];
			if(!isset($state)){
				return false;
			}
			$states = ["AL", "MT", "AK", "NE", "AZ", "NV", "AR",	"NH", "CA", "NJ",
				"CO", "NM", "CT", "NY", "DE", "NC", "FL", "ND", "GA", "OH", "HI", "OK",
				"ID", "OR", "IL", "PA", "IN", "RI", "IA", "SC", "KS", "SD", "KY", "TN",
				"LA", "TX", "ME", "UT", "MD", "VT", "MA", "VA", "MI", "WA", "MN", "WV",
				"MS", "WI", "MO", "WY"];
			$check = true;
			for($i = 0; $i < sizeof($states); $i++){
				if($state == $states[$i]){
					$check = false;
					break;
				}
			}
			if($check){
				return false;
			}

			return true;
		}
	?>

	<form action="add-location.php" method="post">
		<div class="content-wrap">
			<div class="container">
				<div class="main-wrap">
					<div id='wsite-content' class='wsite-elements wsite-not-footer'>
						<table class="tableElements" style="margin-left: auto; margin-right: auto;">
							<tr>
								<th>
									Street
								</th>
								<td>
									<input type="text" name="street" />
								</td>
							</tr>
							<tr>
								<th>
									City
								</th>
								<td>
									<input type="text" name="city" />
								</td>
							</tr>
							<tr>
								<th>
									State
								</th>
								<td>
									<select name="state">
										<?
											$states = ["AL", "AK", "AZ", "AR", "CA",
												"CO", "CT", "DE", "FL", "GA", "HI",
												"ID", "IL", "IN", "IA", "KS", "KY",
												"LA", "ME", "MD", "MA", "MI", "MN",
												"MS", "MO", "MT", "NE", "NV", "NH",
												"NJ", "NM", "NY", "NC", "ND", "OH",
												"OK", "OR", "PA", "RI", "SC", "SD",
												"TN", "TX", "UT", "VT", "VA", "WA",
												"WV", "WI", "WY"];
											for($i=0; $i < sizeof($states); $i++){
												echo '<option value="' . $states[$i] . '" >' . $states[$i] . '</option>';
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th>
									ZIP
								</th>
								<td>
									<input type="text" name="zip" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!-- end container -->
		</div>
		<!-- end main-wrap -->
		<input type="submit" id="submitButton" value="Submit" />
	</form>

		<?php //load footer
			require('footer.php');
		?>
</html>
