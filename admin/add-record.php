<!DOCTYPE html>
<html>

<head>
	<?php //load header
		require('admin-header.php');
	?>
</head>

	<?php //load nav
		require("nav.php");
	?>

	<?php //connect to database
		require('connection.php');
	?>

	<?php //insert item into database
		if(!empty($_POST)){
			if(validateUpdate($conn)){
				$type = $_POST["type"];
				$subtype = split("\|", $_POST["subtype"])[1];
				$year = (isset($_POST["year"]))? $_POST["year"] : "0";
				$make = $_POST["make"];
				$location = $_POST["location"];
				$quantity = $_POST["quantity"];
				$cost = $_POST["cost"];
				$price = $_POST["price"];
				$seller = $_POST["seller"];
				$description = $_POST["description"];
				$model = (isset($_POST["model"]))? $_POST["model"] : "";
				$s_n = (isset($_POST["s_n"]))? $_POST["s_n"] : "";
				$visible = (isset($_POST["visible"]))? "1" : "0";
				$comment = (isset($_POST["comment"]))? $_POST["comment"] : "";
				$picture_url = "";

				if(isset($_FILES["picture_url"]) && $_FILES["picture_url"]["size"] > 0){
					$directory = '../uploads/';
					$target_file = $directory . basename($_FILES["picture_url"]["name"]);
					$upload = true;
					$exists = false;
					$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
					if(getimagesize($_FILES["picture_url"]["tmp_name"]) === false){
						echo '<script>console.error("file not an image");</script>';
						$upload = false;
					}
					elseif(file_exists($target_file)){
						$upload = false;
						$exists = true;
					}
					elseif($_FILES["picture_url"]["size"] > 4194304){
						echo '<script>console.error("file too large (must be less than 4 MB)");</script>';
						$upload = false;
					}
					elseif(($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
						echo '<script>console.error("file must be have .png .jpg .jpeg or .gif extension");</script>';
						$upload = false;
					}

					if($exists){
						$picture_url = basename($_FILES["picture_url"]["name"]);
					}
					elseif($upload && (move_uploaded_file($_FILES["picture_url"]["tmp_name"], $target_file) !== false)){
						$picture_url = basename($_FILES["picture_url"]["name"]);
						echo '<script>console.log("file upload successful");</script>';
					}
					else{
						echo $testing;
						echo '<script>alert("file upload failed");</script>';
					}
				}

				$sql = $conn->prepare("INSERT INTO item (Type, Subtype, Year, Make,
					Location, Quantity, Cost, Price, Seller, Description, Model, S_N,
					Visible, Comment, Picture_URL)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$sql->bind_param('ssisiiiissssiss', $type, $subtype, $year, $make,
					$location, $quantity, $cost, $price, $seller, $description, $model, $s_n,
					$visible, $comment, $picture_url);
				if(!$sql->execute()){
					failUpdate();
				};
			}
			else{
				failUpdate();
			}
		}

		function validateUpdate($conn){
			//validate type
			$type = $_POST["type"];
			if(!isset($type)){
				return false;
			}
			$sql = 'SELECT * FROM types';
			$result = $conn->query($sql);
			$check = true;
			while($row = $result->fetch_assoc()){
				if($row["Type"] == $type){
					$check = false;
					break;
				}
			}
			if($check){
				return false;
			}

			//validate subtype
			$subtype = $_POST["subtype"];
			if(!isset($subtype)){
				return false;
			}
			$subtype = split("\|", $subtype)[1];
			$sql = 'SELECT * FROM subtypes WHERE Type = "' . $type . '"';
			$result = $conn->query($sql);
			if($result == false){
				return false;
			}
			$check = true;
			while($row = $result->fetch_assoc()){
				if($row["SubType"] == $subtype){
					$check = false;
					break;
				}
			}
			if($check){
				return false;
			}

			//validate year
			$year = $_POST["year"];
			if(isset($_POST["year"]) && ($_POST["year"] != "")){
				if(!(is_numeric($year) || strlen($year) == 4)){
					return false;
				}
			}

			//validate make
			$make = $_POST["make"];
			if(!isset($make)){
				return false;
			}
			$sql = 'SELECT * FROM makes';
			$result = $conn->query($sql);
			$check = true;
			while($row = $result->fetch_assoc()){
				if($row["Make"] == $make){
					$check = false;
					break;
				}
			}
			if($check){
				return false;
			}

			//validate location
			$location = $_POST["location"];
			$sql = 'SELECT * FROM locations WHERE ID = ' . $location;
			$result = $conn->query($sql);
			$check = true;
			while($row = $result->fetch_assoc()){
				$check = false;
				break;
			}
			if($check){
				return false;
			}

			//validate quantity
			$quantity = $_POST["quantity"];
			if(!isset($quantity)){
				return false;
			}
			if(!is_int(intval($quantity))){
				return false;
			}

			//validate cost
			$cost = $_POST["cost"];
			if(!isset($cost)){
				return false;
			}
			if(!is_int(intval($cost))){
				return false;
			}

			//validate price
			$price = $_POST["price"];
			if(!isset($price)){
				return false;
			}
			if(!is_int(intval($price))){
				return false;
			}

			//validate seller
			$seller = $_POST["seller"];
			if(!isset($seller)){
				return false;
			}
			$sql = 'SELECT * FROM sellers';
			$result = $conn->query($sql);
			$check = true;
			while($row = $result->fetch_assoc()){
				if($row["Seller"] == $seller){
					$check = false;
					break;
				}
			}
			if($check){
				return false;
			}

			$description = $_POST["description"];
			if(!isset($description)){
				return false;
			}
			if(strlen($description) < 1){
				return false;
			}

			//model not validated
			//serial number not validated
			//visible not validated
			//comment not validated
			//picture_url not validated

			return true;
		}

		function failUpdate(){
			echo '<script type="text/javascript">alert("Update Failed");</script>';
		}
	?>

	<div class="content-wrap">
		<form action="add-record.php" method="post" enctype="multipart/form-data">
		<div class="container">
			<div class="main-wrap">
				<div id='wsite-content' class='wsite-elements wsite-not-footer'>
						<table class="tableElements" style="margin-left: auto; margin-right: auto;">
							<tr>
								<th>
									Type
								</th>
								<td>
									<select name="type" id="type" required>
										<?
										$sql = 'SELECT * FROM types';
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '<option value="' . $row["Type"] . '">' . $row["Type"] . '</option>';
										}
										?>
									</select>*
								</td>
								<th>
									Quantity
								</th>
								<td>
									<input type="text" name="quantity" required />*
								</td>
							<tr>
							</tr>
								<th>
									Subtype
								</th>
								<td>
									<select name="subtype" id="subtype" required>
										<?
										$sql = 'SELECT * FROM subtypes';
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '<option value="' . $row["Type"] . "|" . $row["SubType"] . '" disabled>' . $row["SubType"] . '</option>';
										}
										?>
									</select>*
								</td>
								<th>
									Serial Number
								</th>
								<td>
									<input type="text" name="s_n" />
								</td>
							</tr>
							<tr>
								<th>
									Year
								</th>
								<td>
									<input type="text" name="year" />
								</td>
								<th>
									Cost
								</th>
								<td>
									<input type="text" name="cost" required/>*
								</td>
 							</tr>
							<tr>
								<th>
									Make
								</th>
								<td>
									<select name="make" required>
										<?
										$sql = 'SELECT * FROM makes';
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '<option value="' . $row["Make"] . '">' . $row["Make"] . '</option>';
										}
										?>
									</select>*
								</td>
								<th>
								 Price
							 	</th>
							 	<td>
								 	<input type="text" name="price" required/>*
							 	</td>
							</tr>
							<tr>
								<th>
									Model
								</th>
								<td>
									<input type="text" name="model" />
								</td>
								<th>
									Seller
								</th>
								<td>
									<select name="seller" required>
										<?
										$sql = 'SELECT * FROM sellers';
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '<option value="' . $row["Seller"] . '">' . $row["Seller"] . '</option>';
										}
										?>
									</select>*
								</td>
							</tr>
							<tr>
								<th>
									Location
								</th>
								<td>
									<select name="location" required>
										<?
										$sql = 'SELECT * FROM locations';
										$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '<option value="' . $row["ID"] . '">' .
												(($row["Street"] == "")? "" : $row["Street"] . ", ") .
												(($row["City"] == "")? "" : $row["City"] . ", ") .
												$row["State"] . " " .
												(($row["ZIP"] == "")? "" : $row["ZIP"]) .
												'</option>';
										}
										?>
									</select>*
								</td>
								<th>
									Visible
								</th>
								<td style="min-width: 20px">
									<input type="checkbox" name="visible" value="visible" checked/>
								</td>
							</tr>
							<tr>
								<th colspan="2">
									Description*
								</th>
								<th colspan="2">
									Comment
								</th>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="description" rows="10" cols="40" required></textarea>
								</td>
								<td colspan="2">
									<textarea name="comment" rows="10" cols="40"></textarea>
								</td>
							</tr>
							<tr>
								<th colspan="4">
									Picture
								</th>
							</tr>
							<tr>
								<td colspan="4">
									<input type="file" name="picture_url" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div><!-- end container -->
			<input type="submit" id="submitButton" value="Submit" name="submit"/>
		</form>
	</div><!-- end main-wrap -->

	<?php //load footer
		require("footer.php");
	?>
</html>
