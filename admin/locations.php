<!DOCTYPE html>
<html>
<head>
	<?php //load header
		require('admin-header.php');
	?>

	<?php //load map
		include('location-map.php');
	?>
</head>

	<?php //load nav
		require('nav.php');
	?>

	<?php //connect to database
		require('connection.php');
	?>

	<?php //update selected locations
		if(!empty($_POST)){
			$sql = 'SELECT * FROM locations';
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$check = false;
				if(isset($_POST["delete_" . $row["ID"]])){
					$sql = 'DELETE FROM locations WHERE ID="' . $row["ID"] . '"';
					if(!$conn->query($sql)){
						failUpdate(1);
					}
				}
				elseif($_POST["street_" . $row["ID"]] != $row["Street"]){
					$check = true;
				}
				elseif($_POST["city_" . $row["ID"]] != $row["City"]){
					$check = true;
				}
				elseif($_POST["state_" . $row["ID"]] != $row["State"]){
					$check = true;
				}
				elseif($_POST["zip_" . $row["ID"]] != $row["ZIP"]){
					$check = true;
				}
				if($check){
					if(validateUpdate($row)){
						$street = $_POST["street_" . $row["ID"]];
						$city = $_POST["city_" . $row["ID"]];
						$state = $_POST["state_" . $row["ID"]];
						$zip = $_POST["zip_" . $row["ID"]];
						$zip = ($zip == null || $zip == '')? null : $zip;

						$sql = $conn->prepare('UPDATE locations SET Street=?, City=?, State=?,
							ZIP=? WHERE ID=?');
						$sql->bind_param('sssii', $street, $city, $state, $zip, $row["ID"]);
						if(!$sql->execute()){
							failUpdate(2);
						}
					}
					else{
						failUpdate(3);
					}
				}
			}
		}

		function failUpdate($num){
			echo '<script>console.error("update failed (' . $num . ')");</script>';
		}

		function validateUpdate($row){
			$state = $_POST["state_" . $row["ID"]];
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

	<center>
		<div style="text-align: center; width: 400px;">
			<div id="map" style="width: 400px; height: 400px;"></div>
		</div>

	</center>

		<form action="locations.php" method="post">
			<div class="content-wrap" style="overflow: auto;">
				<div class="container">
					<div class="main-wrap">
						<div id='wsite-content' class='wsite-elements wsite-not-footer'>
							<table class="tableElements" style="margin-left: auto; margin-right: auto;">
								<tr>
									<th>
										Street
									</th>
									<th>
										City
									</th>
									<th>
										State
									</th>
									<th>
										ZIP
									</th>
									<th>
										Delete
									</th>
									<th>
										Show on Map
									</th>
								</tr>
								<?
									$sql = 'SELECT * FROM locations';
									$result = $conn->query($sql);
									$count = 0;
									while($row = $result->fetch_assoc()){
										$bkg_color = ($count % 2 == 0)? "tableRowDark" : "tableRowLight";
										echo '<tr class="' . $bkg_color . '">';
										echo '<td><input type="text" name="street_' . $row["ID"] . '" size="30" value="' . $row["Street"] . '" /></td>';
										echo '<td><input type="text" name="city_' . $row["ID"] . '" size="10" value="' . $row["City"] . '" /></td>';
										echo '<td style="text-align: center;"><select name="state_' . $row["ID"] . '"/>';
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
											echo '<option value="' . $states[$i] . '" ' . (($row["State"] == $states[$i])? "selected" : "") . '>' . $states[$i] . '</option>';
										}
										echo '</select></td>';
										echo '<td><input type="text" name="zip_' . $row["ID"] . '" size="10" value="' . $row["ZIP"] . '" /></td>';
										echo '<td style="text-align: center;"><input type="checkbox" name="delete_' . $row["ID"] . '" /></td>';
										echo '<td style="text-align: center;"><input type="checkbox" id="map_' . $row["ID"] . '" class="mapButtons"/></td>';
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
