
<?php
  //$conn must be a connection to the database for this code to function
  require('files/formatter.php');

  function display_thumbnails($conn, $sql){
    $result = $conn->query($sql);
    echo '<div class="thumbnail_div">';
    echo '<table class="tableElements" style="width: 100%;">';
    echo '<tr>';
      echo '<th>';
        echo 'Quantity';
      echo '</th>';
      echo '<th>';
        echo 'Name';
      echo '</th>';
      // echo '<th>';
      //   echo 'Make';
      // echo '</th>';
      // echo '<th>';
      //   echo 'Model';
      // echo '</th>';
      echo '<th>';
        echo 'Description';
      echo '</th>';
      echo '<th>';
        echo 'Price';
      echo '</th>';
      echo '<th>';
        echo 'State';
      echo '</th>';
    echo '</tr>';
    $rowColor = 0;
    $num_rows = 0;
    while($row = $result->fetch_assoc()){
      if($row['Visible']){
        $num_rows++;
        $rowClass = '';
        if($rowColor % 2 == 0){
          $rowClass = 'tableRowDark';
        }
        else{
          $rowClass = 'tableRowLight';
        }
        echo '<tr class="' . $rowClass . ' clickableRow" onclick="handleRowClick(' . $row["ID"] . ')">';
          echo '<td>';
            echo $row['Quantity'];
          echo '</td>';
          echo '<td>';
            echo $row['Year'] . " " . $row['Make'] . " " . $row['Model'];
          echo '</td>';
          // echo '<td>';
          //   echo $row['Make'];
          // echo '</td>';
          // echo '<td>';
          //   echo $row['Model'];
          // echo '</td>';
          echo '<td style="text-align: left;">';
            echo $row['Description'];
          echo '</td>';
          echo '<td>';
            echo format_to_money($row['Price']);
          echo '</td>';
          echo '<td>';
            echo $row['State'];
          echo '</td>';
        echo '</tr>';
        $rowColor++;
        // echo '<a href="display.php?id=' . $row["ID"] . '" >';
        // echo '<div class="thumbnail">';
        //   echo '<img class="thumbnail_img" src="' . "uploads/" . (($row["Picture_URL"] != "")? $row["Picture_URL"] : "BrownEquipmentDefault.png") . '" />';
        //   echo '<br>';
        //   echo '<p class="thumbnail_name">' . $row["Make"] . " " . $row["Model"] . '</p>';
        //   echo '<p class="thumbnail_price">$' . $row["Price"] . '</p>';
        // echo '</div>';
        // echo '</a>';
      }
    }
    if($num_rows < 1){
      echo '<td class="tableRowDark" colspan=5>No Items Currently Exist For This Category</td>';
    }

    echo '</table>';
    echo '</div>';
  }
?>
