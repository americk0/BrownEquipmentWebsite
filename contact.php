<!DOCTYPE html>
<html>
	<head>
		<title> Contact BrownEquipment - Brown Equipment llc</title>
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
        <div class="main-wrap"><div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div><div style="height: 20px; overflow: hidden; width: 100%;"></div>
<hr class="styled-hr" style="width:100%;"></hr>
<div style="height: 20px; overflow: hidden; width: 100%;"></div></div>

<div class="paragraph" style="text-align:left;">Brown Equipment of Georgia, LLC<br />417 Terrace Blvd.<br />Valdosta, GA&nbsp; 31602<br /><br />PH:&nbsp; 770-889-8280<br />FX:&nbsp; 770-809-5144</div>

<div class="wsite-spacer" style="height:50px;"></div>

<div><div style="height: 20px; overflow: hidden; width: 100%;"></div>
<hr class="styled-hr" style="width:100%;"></hr>
<div style="height: 20px; overflow: hidden; width: 100%;"></div></div>

<div>
<form enctype="multipart/form-data" action="contact.php" method="POST" id="form-162461235945871732">
<div id="162461235945871732-form-parent" class="wsite-form-container" style="margin-top:10px;">
  <ul class="formlist" id="162461235945871732-form-list">
    <h2 class="wsite-content-title" style="text-align:left;"></h2>

<?php
//if "email" variable is filled out, send email
  if (!empty($_POST)){
	  //Email information
	  $admin_email = "americk0@gmail.com";
	  $title = $_POST['first'] . " " . $_POST['last'];
		$headers = "From:" . $_POST['email'] . "\r\n";
	  $comment = wordwrap($_POST['comment'], 70, "\r\n");

		//echo "Your message : ";
		//echo $title . "<br>";
		echo "Your message : ".$comment . "<br>";
		//echo $headers . "<br>";

	  //send email
	  if(mail($admin_email, $title, $comment, $headers)){
		  //Email response
		  echo "<br>"."Thank you for contacting us!";
		}
		else{
			echo 'error: ' . error_get_last();
		}
	}
	//if "email" variable is not filled out, display the form
?>

<form method="post">
<div><div class="wsite-form-field wsite-name-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-733353921873357205">Name <span class="form-required">*</span></label>
				<div style="clear:both;"></div>
				<div class="wsite-form-input-container wsite-form-left wsite-form-input-first-name">
					<input id="input-733353921873357205" class="wsite-form-input wsite-input" type="text" name="first" />
					<label class="wsite-form-sublabel" for="input-733353921873357205">First</label>
				</div>
				<div class="wsite-form-input-container wsite-form-right wsite-form-input-last-name">
					<input id="input-733353921873357205-1" class="wsite-form-input wsite-input" type="text" name="last" />
					<label class="wsite-form-sublabel" for="input-733353921873357205-1">Last</label>
				</div>
				<div id="instructions-733353921873357205" class="wsite-form-instructions" style="display:none;"></div>
			</div>
			<div style="clear:both;"></div></div>

<div><div class="wsite-form-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-647452509454560653">Email <span class="form-required">*</span></label>
				<div class="wsite-form-input-container">
					<input id="input-647452509454560653" class="wsite-form-input wsite-input wsite-input-width-370px" type="text" name="email" />
				</div>
				<div id="instructions-647452509454560653" class="wsite-form-instructions" style="display:none;"></div>
			</div></div>

<div><div class="wsite-form-field" style="margin:5px 0px 5px 0px;">
				<label class="wsite-form-label" for="input-208611392636471279">Comment <span class="form-required">*</span></label>
				<div class="wsite-form-input-container">
					<textarea id="input-208611392636471279" class="wsite-form-input wsite-input wsite-input-width-370px" name="comment" style="height: 200px"></textarea>
				</div>
				<div id="instructions-208611392636471279" class="wsite-form-instructions" style="display:none;"></div>
			</div></div>
			</form>
  </ul>
</div>
<div style="text-align:left; margin-top:10px; margin-bottom:10px;">
  <input type="hidden" name="form_version" value="2" />
  <input type="hidden" name="wsite_approved" id="wsite-approved" value="approved" />
  <input type="hidden" name="ucfid" value="162461235945871732" />
  <input type='submit' style='position:absolute;top:0;left:-9999px;width:1px;height:1px' /><a class='wsite-button' onclick="document.getElementById('form-162461235945871732').submit()"><span class='wsite-button-inner'>Submit</span></a>
</div>
</form>


</div></div>
</div>
      </div><!-- end container -->
    </div><!-- end main-wrap -->

		<?php
			require('footer.php');
		?>
</html>
