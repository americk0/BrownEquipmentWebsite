<!DOCTYPE html>
<html>
	<head>
		<?php //handle postback
		if(!empty($_POST)){
			//updates the "about" text for the about page
			$about_content = (isset($_POST["about"]))? $_POST["about"] : "";
			file_put_contents("../files/content_about.txt", $about_content);

			//checks if radio button for which file to use as logo was changed
			$current_logo = file_get_contents("../files/content_logo_name.txt");
			if(isset($_POST["logo_file"])){
				if($_POST["logo_file"] != $current_logo){
					$files = scandir("../uploads/logos/");
					foreach ($files as $file){
						if(($file == '.') || ($file == '..')){
							continue;
						}
						$file_type = explode(".", $file)[1];
						if(($file_type != null) && ($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
							continue;
						}
						if($file == $_POST["logo_file"]){
							file_put_contents('../files/content_logo_name.txt', $_POST["logo_file"]);
							break;
						}
					}
				}
			}

			//validates/uploads new image file and sets as the new logo
			if(isset($_FILES["logo_image"]) && $_FILES["logo_image"]["size"] > 0){
				$directory = '../uploads/logos/';
				$target_file = $directory . basename($_FILES["logo_image"]["name"]);
				$upload = true;
				$exists = false;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
				if(getimagesize($_FILES["logo_image"]["tmp_name"]) === false){
					echo '<script>console.error("file not an image");</script>';
					$upload = false;
				}
				elseif(file_exists($target_file)){
					$upload = false;
					$exists = true;
				}
				elseif($_FILES["logo_image"]["size"] > 4194304){
					echo '<script>console.error("file too large (must be less than 4 MB)");</script>';
					$upload = false;
				}
				elseif(($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
					echo '<script>console.error("file must be have .png .jpg .jpeg or .gif extension");</script>';
					$upload = false;
				}

				if($exists){
					$picture_url = basename($_FILES["logo_image"]["name"]);
					file_put_contents('../files/content_logo_name.txt', trim($picture_url, "\n\0\r \t"));
				}
				elseif($upload && (move_uploaded_file($_FILES["logo_image"]["tmp_name"], $target_file) !== false)){
					$picture_url = basename($_FILES["logo_image"]["name"]);
					echo '<script>console.log("file upload successful");</script>';
					file_put_contents('../files/content_logo_name.txt', trim($picture_url, "\n\0\r \t"));
				}
				else{
					echo '<script>alert("file upload failed");</script>';
				}
			}

			//validates/uploads new image file to list of image files
			if(isset($_FILES["upload_image"]) && $_FILES["upload_image"]["size"] > 0){
				$directory = '../uploads/';
				$target_file = $directory . basename($_FILES["upload_image"]["name"]);
				$upload = true;
				$exists = false;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
				if(getimagesize($_FILES["upload_image"]["tmp_name"]) === false){
					echo '<script>console.error("file not an image");</script>';
					$upload = false;
				}
				elseif(file_exists($target_file)){
					$upload = false;
					$exists = true;
				}
				elseif($_FILES["upload_image"]["size"] > 4194304){
					echo '<script>console.error("file too large (must be less than 4 MB)");</script>';
					$upload = false;
				}
				elseif(($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
					echo '<script>console.error("file must be have .png .jpg .jpeg or .gif extension");</script>';
					$upload = false;
				}

				if(!$exists && $upload && (move_uploaded_file($_FILES["upload_image"]["tmp_name"], $target_file) !== false)){
					$picture_url = basename($_FILES["upload_image"]["name"]);
					echo '<script>console.log("file upload successful");</script>';
				}
				else{
					echo '<script>alert("file upload failed");</script>';
				}
			}
		}
		?>

		<?php //load header
			require("admin-header.php");
		?>
	</head>

	<?php //load nav
		require("nav.php");
	?>

	<div class="content-wrap">
		<form action='content.php' method='post' enctype="multipart/form-data">
			<div style="width: 30%; min-width: 400px; text-align: center; margin: auto;">
				<table class="tableElements" style="width: 100%;">
					<tr>
						<th colspan="2">
							Logo Image
						</th>
					</tr>
					<tr>
						<th>
							Upload
						</th>
						<td>
							<input type="file" name="logo_image" />
						</td>
					</tr>
					<tr>
						<th>
							Selected Image
						</th>
						<td style="width: 100%;">
							<div style="overflow: auto; max-height: 200px;">
								<?php
									$files = scandir("../uploads/logos/");
									$current_logo = file_get_contents("../files/content_logo_name.txt");
									foreach ($files as $file){
										if(($file == '.') || ($file == '..')){
											continue;
										}
										$file_type = explode(".", $file);
										$file_type = $file_type[count($file_type) - 1];
										if(($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
											continue;
										}
										echo '<input type="radio" name="logo_file" value="' . $file . '" ' . (($file == $current_logo)? 'checked' : '') . '/>';
										echo " $file<br>";
									}
								?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<br>
			<div style="width: 30%; min-width: 400px; text-align: center; margin: auto;">
				<table class="tableElements" style="width: 100%;">
					<tr>
						<th colspan="2">
							Manage Images
						</th>
					</tr>
					<tr>
						<th>
							Upload
						</th>
						<td>
							<input type="file" name="upload_image" />
						</td>
					</tr>
					<tr>
						<th>
							Images
						</th>
						<td style="width: 100%;">
							<div style="overflow: auto; max-height: 200px;">
								<?php
									$files = scandir("../uploads/");
									foreach ($files as $file){
										if(($file == '.') || ($file == '..')){
											continue;
										}
										$file_type = explode(".", $file);
										$file_type = $file_type[count($file_type) - 1];
										if(($file_type != "png") && ($file_type != "jpg") && ($file_type != "jpeg") && ($file_type != "gif")){
											continue;
										}
										echo '<a href="../uploads/' . $file . '">' . $file . '</a><br>';
									}
								?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<br>
			<div style="width: 60%; min-width: 400px; text-align: center; margin: auto;">
				<table class="tableElements" style="width: 100%;">
					<tr>
						<th style="text-align: center;">
							About
						</th>
					</tr>
					<tr>
						<td style="padding-right: 7px;">
							<?php //fill 'about' textarea
								$about_contents = file_get_contents("../files/content_about.txt", "r");
								echo '<textarea name="about" style="width: 100%; height: 300px; resize: both;">';
									echo $about_contents;
								echo '</textarea>';
							?>
						</td>
					</tr>
				</table>
			</div>
			<input type="submit" id="submitButton" value="Submit" name="submit"/>
		</form>

	</div>

	<?php //load footer
		require('footer.php');
	?>
</html>
