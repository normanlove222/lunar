<?php
require('includes/functions.php');

global $pdo;

$stmt = $pdo->query("SELECT * FROM lunar
                    WHERE idate >= UTC_TIMESTAMP()
                    AND idate < DATE_ADD(UTC_TIMESTAMP(), INTERVAL 30 DAY)
                    ORDER BY idate ASC");
$info = $stmt->fetchall();

//lets get current sign info
$stmt2 = $pdo->query("SELECT * FROM lunar
                    WHERE idate <= UTC_TIMESTAMP()
                    ORDER BY idate DESC
                    LIMIT 1");
$current = $stmt2->fetch();
?>




<html5>
<head>


</head>
<body>
<?php

// Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
$latest_year = intval(date('Y'));

list($localDate, $localTime) = convertToLocalTime($current['idate'], $current['time']);

?>


<div class="container">
    <img src="images/moon-signs-ingress.jpg" alt="Moon and zodiac signs" width="auto">
    
    <h1>The Moon(Luna) is currently in the sign of: <?php echo $current['sign']; ?> </h1>
    <h1> It entered on: <?php echo $localDate; ?> at: <?php echo $localTime; ?></h1>
    <h1>Lunar Ingress</h1>

    <h2>When the beloved Moon (Luna) enters a specific sign</h2>

    <div class="opening">
         The moon takes 28 days to cycle all zodiac. Luna spends approx. 2.5 days in each of the 12 Zodic signs. During the time when the moon is in your birth Sun sign, there is an alchemical reaction, process, and opportunity which can occur in the body, when we fast, cleanse and purify the body and consciousness during this period. The Amygdala of the brain produces this golden oil which will produce a few drops each month. These oils will eventually pool in the area of the solar plexus and then move on to other parts of the body. Overtime these oils act as the catalyst for advanced Ascension processes of the body. 
    </div>   

<p>Luna is currently in the sign of: <span><?php echo $current['sign']; ?></span></p>        

        <table class="responsive table-striped">
        <thead>
          <tr>
            
           
            <th >Date</th>           
            <th >Sign Entered</th>
            <th>Time (Pacific Time)</th>
            
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($info as $row)
           { 
            list($localDate, $localTime) = convertToLocalTime($row['idate'], $row['time']);
          $row['time'] = date( "H:i", strtotime($row['time']));
                echo '<tr>'
            .'<td>'.$localDate.'</td>'
            .'<td>'.$row['sign'].'</td>'
            .'<td>'.$localTime.'</td>'            
            .'</tr>';
          }
          ?>
        </tbody>
      </table>

</div> <!-- container -->
</body>
</html5>