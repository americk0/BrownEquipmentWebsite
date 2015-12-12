<!DOCTYPE html>
<html>
	<head>
		<title>Brown Equipment llc -  About BrownEquipment</title>
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
<div class="wsite-spacer" style="width: 70%; text-align: center; margin-left: auto; margin-right: auto;">
	<?php
		$about = file_get_contents("files/content_about.txt");
		echo $about;
	?>
</div>

<div class="paragraph" style="text-align:left;"></a>.</div></div></div>
      </div><!-- end container -->
    </div><!-- end main-wrap -->

		<?php
			require('footer.php');
		?>
</html>
