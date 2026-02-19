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




<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lunar Ingress</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php

// Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
$latest_year = intval(date('Y'));

list($localDate, $localTime) = convertToLocalTime($current['idate'], $current['time']);

?>


<div class="container">
    <img class="hero-image" src="images/moon-signs-ingress.jpg" alt="Moon and zodiac signs">
    
    <h1 class="title">Lunar Ingress</h1>
    <h2 class="subtitle">When the beloved Moon (Luna) enters a specific sign</h2>
    <h1 class="current">The Moon (Luna) is currently in: <span><?php echo htmlspecialchars($current['sign'], ENT_QUOTES, 'UTF-8'); ?></span></h1>
    <h1 class="current">Entered on: <?php echo htmlspecialchars($localDate, ENT_QUOTES, 'UTF-8'); ?> at <?php echo htmlspecialchars($localTime, ENT_QUOTES, 'UTF-8'); ?></h1>

    <div class="opening">
         The moon takes 28 days to cycle all zodiac. Luna spends approx. 2.5 days in each of the 12 Zodic signs. During the time when the moon is in your birth Sun sign, there is an alchemical reaction, process, and opportunity which can occur in the body, when we fast, cleanse and purify the body and consciousness during this period. The Amygdala of the brain produces this golden oil which will produce a few drops each month. These oils will eventually pool in the area of the solar plexus and then move on to other parts of the body. Overtime these oils act as the catalyst for advanced Ascension processes of the body. 
    </div>   

<p class="current-sign">Luna is currently in: <span><?php echo htmlspecialchars($current['sign'], ENT_QUOTES, 'UTF-8'); ?></span></p>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Sign Entered</th>
              <th>Time (Pacific Time)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($info as $row) {
              list($localDate, $localTime) = convertToLocalTime($row['idate'], $row['time']);
              echo '<tr>'
                . '<td>' . htmlspecialchars($localDate, ENT_QUOTES, 'UTF-8') . '</td>'
                . '<td>' . htmlspecialchars($row['sign'], ENT_QUOTES, 'UTF-8') . '</td>'
                . '<td>' . htmlspecialchars($localTime, ENT_QUOTES, 'UTF-8') . '</td>'
                . '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

</div> <!-- container -->
</body>
</html>