<!DOCTYPE html>
<html>
	<head>
		<?php //load header
			require("admin-header.php");
		?>
	</head>

	<?php //load nav
		require("nav.php");
	?>

	<?php //connect to database
		require('connection.php');
	?>

	<?php //handle postback
		if( !empty($_POST) && !isset($_POST["select_type"])){
			$sql = 'SELECT * FROM item';
			$items = $conn->query($sql);

			while($row = $items->fetch_assoc()){
				$needUpdate = false;
				if(isset($_POST['delete_' . $row["ID"]])){
					$sql = 'DELETE FROM item WHERE ID = "' . $row["ID"] . '"';
					if(!$conn->query($sql)){
						echo '<script>console.err("delete failed for row with ID=' . $row["ID"] . '");</script>';
					}
				}
				elseif(isset($_POST["quantity_" . $row["ID"]]) && ($_POST["quantity_" . $row["ID"]] != $row["Quantity"])){
					$needUpdate = true;
				}
				elseif(isset($_POST["year_" . $row["ID"]]) && ($_POST["year_" . $row["ID"]] != $row["Year"])){
					$needUpdate = true;
				}
				elseif(isset($_POST["model_" . $row["ID"]]) && ($_POST["model_" . $row["ID"]] != $row["Model"])){
					$needUpdate = true;
				}
				elseif(isset($_POST["s_n_" . $row["ID"]]) && ($_POST["s_n_" . $row["ID"]] != $row["S_N"])){
					$needUpdate = true;
				}
				elseif(isset($_POST['cost_' . $row["ID"]]) && ($_POST['cost_' . $row["ID"]] != $row["Cost"])){
					$needUpdate = true;
				}
				elseif(isset($_POST['price_' . $row["ID"]]) && ($_POST['price_' . $row["ID"]] != $row["Price"])){
					$needUpdate = true;
				}
				elseif(isset($_POST['description_' . $row["ID"]]) && ($_POST['description_' . $row["ID"]] != $row["Description"])){
					$needUpdate = true;
				}
				elseif(isset($_POST['comment_' . $row["ID"]]) && ($_POST['comment_' . $row["ID"]] != $row["Comment"])){
					$needUpdate = true;
				}
				elseif(isset($_POST['picture_url_' . $row["ID"]]) && ($_POST['picture_url_' . $row["ID"]] != $row["Picture_URL"])){
					$needUpdate = true;
				}
				elseif((isset($_POST['visible_' . $row["ID"]]) and $row["Visible"] == 0) or (!isset($_POST['visible_' . $row["ID"]]) and $row["Visible"] > 0)){
					$needUpdate = true;
				}

				if($needUpdate){
					$sql = $conn->prepare("UPDATE item SET
						Quantity = ?,
						Year = ?,
						Model = ?,
						S_N = ?,
						Cost = ?,
						Price = ?,
						Description = ?,
						Comment = ?,
						Picture_URL = ?,
						Visible = ?
						WHERE ID = ?");
					$quantity = ((isset($_POST["quantity_" . $row["ID"]]))? $_POST["quantity_" . $row["ID"]] : 0);
					$year = ((isset($_POST["year_" . $row["ID"]]))? $_POST["year_" . $row["ID"]] : 0);
					$model = ((isset($_POST["model_" . $row["ID"]]))? $_POST["model_" . $row["ID"]] : '');
					$s_n = ((isset($_POST["s_n_" . $row["ID"]]))? $_POST["s_n_" . $row["ID"]] : '');
					$cost = ((isset($_POST["cost_" . $row["ID"]]))? $_POST["cost_" . $row["ID"]] : 0);
					$price = ((isset($_POST["price_" . $row["ID"]]))? $_POST["price_" . $row["ID"]] : 0);
					$description = ((isset($_POST["description_" . $row["ID"]]))? $_POST["description_" . $row["ID"]] : '');
					$comment = ((isset($_POST["comment_" . $row["ID"]]))? $_POST["comment_" . $row["ID"]] : '');
					$picture_url = ((isset($_POST["picture_url_" . $row["ID"]]))? $_POST["picture_url_" . $row["ID"]] : '');

					$visible = ((isset($_POST["visible_" . $row["ID"]]))? 1 : 0);

					$id = $row["ID"];
					if(!($sql->bind_param('iissiisssii',
							$quantity,
							$year,
							$model,
							$s_n,
							$cost,
							$price,
							$description,
							$comment,
							$picture_url,
							$visible,
							$id))){
						echo "bind_param unsuccessful" . '<br>';
					}
					if(!($sql->execute())){
						echo "execute unsuccessful" . '<br>';
					}
					$sql->close();
				}
			}
		}
	?>

	<br>
	<form action="index.php" method="post">
		<?php
			echo '<div style="text-align: center">';
			echo 'Type:&nbsp;';
			echo '<select name="select_type">';
				echo '<option value="show_all">';
					echo 'Show All';
				echo '</option>';
					$sql = 'SELECT * FROM types';
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						echo '<option value="' . $row["Type"] . '" ' . ((isset($_POST) && ($row["Type"] == $_POST["select_type"]))? "selected" : "") . '>' . $row["Type"] . '</option>';
						if(isset($_POST) && ($row["Type"] == $_POST["select_type"])){
							$selectedType = $row["Type"];
						}
					}
				echo '</select>';
				echo '&nbsp;<input type="submit" value="Show All"/>';
			echo '</div>';

			echo '<div style="text-align: center">';
			if(isset($_POST) && isset($_POST["select_type"])){
				echo 'Subtype:&nbsp;';
				echo '<select name="select_subtype">';
					echo '<option value="show_all">';
						echo 'Show All';
					echo '</option>';
						$sql = 'SELECT * FROM subtypes WHERE Type="' . ((isset($selectedType))? $selectedType : "") . '"';
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo '<option value="' . $row["SubType"] . '" ' . ((isset($_POST) && ($row["SubType"] == $_POST["select_subtype"]))? "selected" : "") . '>' . $row["SubType"] . '</option>';
							if(isset($_POST) && ($row["SubType"] == $_POST["select_subtype"])){
								$selectedType = $row["SubType"];
							}
						}
					echo '</select>';
					echo '&nbsp;<input type="submit" value="Show All"/>';
				echo '</div>';
			}
			echo '</div>';
		?>
	</form>
	<br>

	<form action="index.php" method="post" enctype="multipart/form-data" id="primaryForm">
		<?php //generate/populate table
			echo '<div class="content-wrap" style="overflow: auto; width: 96%; margin-left: 2%; margin-right: 2%; border: 1px solid black;">';
			echo '<div style="margin-left: 2%;"><input id="submitButton" type="submit" value="Submit"/></div>';

			$states = [];
			$sql = 'SELECT * FROM locations';
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$states[$row["ID"]]["Street"] = $row["Street"];
				$states[$row["ID"]]["City"] = $row["City"];
				$states[$row["ID"]]["ZIP"] = $row["ZIP"];
				$states[$row["ID"]]["State"] = $row["State"];
			}

			$sql = 'SELECT * FROM item';
			$typeSet = false;
			if(!empty($_POST) && isset($_POST["select_type"])){
				$sql2 = 'SELECT * FROM types';
				$result = $conn->query($sql2);
				while($row = $result->fetch_assoc()){
					if($row["Type"] == $_POST["select_type"]){
						$sql = $sql . ' WHERE Type="' . $row["Type"] . '"';
						$typeSet = true;
						break;
					}
				}
			}
			if(!empty($_POST) && isset($_POST["select_subtype"])){
				$sql2 = 'SELECT * FROM subtypes';
				$result = $conn->query($sql2);
				while($row = $result->fetch_assoc()){
					if($row["SubType"] == $_POST["select_subtype"]){
						if($typeSet){
							$sql = $sql . ' AND Subtype="' . $row["SubType"] . '"';
							break;
						}
						$sql = $sql . ' WHERE Subtype="' . $row["SubType"] . '"';
						break;
					}
				}
			}
			if(isset($_POST) && isset($_POST["select_type"]) && ($_POST["select_type"] == "show_all")){
				$sql = 'SELECT * FROM item';
			}
			$result = $conn->query($sql);

			echo '<table class="tableElements">';
			echo '<tr>
				<th class="tableElements">Type</th>
				<th class="tableElements">Subtype</th>
				<th class="tableElements">Quantity</th>
				<th class="tableElements">Year</th>
				<th class="tableElements">Make</th>
				<th class="tableElements">Model</th>
				<th class="tableElements">Serial Number</th>
				<th class="tableElements">Cost</th>
				<th class="tableElements">Price</th>
				<th class="tableElements">Description</th>
				<th class="tableElements">Comment</th>
				<th class="tableElements">Seller</th>
				<th class="tableElements">Location</th>
				<th class="tableElements">Date Created</th>
				<th class="tableElements">Picture URL</th>
				<th class="tableElements">Visible</th>
				<th class="tableElements">Delete</th>
			</tr>';
			$count = 0;
			while($row = $result->fetch_assoc()){
				$bkg_color = ($count % 2 == 0)? ", tableRowDark" : ", tableRowLight";
				echo '<tr class="tableElements' . $bkg_color . '">';
					echo '<td class="tableElements">' . $row["Type"] . '</td>';
					echo '<td class="tableElements">' . $row["Subtype"] . '</td>';
					echo '<td class="tableElements"><input type="text" name="quantity_' . $row["ID"] . '" size="10" value="' . $row["Quantity"] . '" /></td>';
					echo '<td class="tableElements"><input type="text" name="year_' . $row["ID"] . '" size="10" value="' . $row["Year"] . '" /></td>';
					echo '<td class="tableElements">' . $row["Make"] . '</td>';
					echo '<td class="tableElements"><input type="text" name="model_' . $row["ID"] . '" size="10" value="' . $row["Model"] . '" /></td>';
					echo '<td class="tableElements"><input type="text" name="s_n_' . $row["ID"] . '" size="10" value="' . $row["S_N"] . '" /></td>';
					echo '<td class="tableElements"><input type="text" name="cost_' . $row["ID"] . '" size="10" value="' . $row["Cost"] . '" /></td>';
					echo '<td class="tableElements"><input type="text" name="price_' . $row["ID"] . '" size="10" value="' . $row["Price"] . '" /></td>';
					echo '<td class="tableElements"><textarea name="description_' . $row["ID"] . '" cols="24" rows="6" >' . $row["Description"] . '</textarea></td>';
					echo '<td class="tableElements"><textarea name="comment_' . $row["ID"] . '" cols="24" rows="6" >' . $row["Comment"] . '</textarea></td>';
					echo '<td class="tableElements">' . $row["Seller"] . '</td>';
					echo '<td class="tableElements">' .
						(($states[$row["Location"]]["Street"])? $states[$row["Location"]]["Street"] . '<br>' : '') .
						(($states[$row["Location"]]["City"])? $states[$row["Location"]]["City"] . '<br>' : '' ) .
						(($states[$row["Location"]]["ZIP"])? $states[$row["Location"]]["ZIP"] . '<br>' : '' ) .
						$states[$row["Location"]]["State"] . '</td>';
					echo '<td class="tableElements">' . $row["Date_Created"] . '</td>';
					echo '<td class="tableElements"><input type="text" name="picture_url_' . $row["ID"] . '" size="10" value="' . $row["Picture_URL"] . '" /><br>
						<a href="../uploads/' . $row["Picture_URL"] . '">photo</a></td>';
					echo '<td class="tableElements" style="text-align: center;"><input type="checkbox" name="visible_' . $row["ID"] . '" ' . (($row["Visible"])? 'checked' : '') . ' /></td>';
					echo '<td class="tableElements" style="text-align: center;"><input type="checkbox" name="delete_' . $row["ID"] . '" ' . ' /></td>';
				echo '</tr>';
				$count++;
			}
			echo '</table>';
			echo '</div>';
		?>
	</form>

	<?php //load footer
		require('footer.php');
	?>
</html>
