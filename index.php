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
  <link rel="icon" type="image/svg+xml" href="images/favicon.svg" />
  <link rel="shortcut icon" href="images/favicon.svg" />
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
    <h2 class="subtitle">Shows which zodiac sign the Moon (Luna) is currently in</h2>
    <h1 class="current">Luna is currently in: <span><?php echo htmlspecialchars($current['sign'], ENT_QUOTES, 'UTF-8'); ?></span></h1>
    <h2 class="entered">Entered on: <?php echo htmlspecialchars($localDate, ENT_QUOTES, 'UTF-8'); ?> at <?php echo htmlspecialchars($localTime, ENT_QUOTES, 'UTF-8'); ?></h2>

    <div class="opening">
        <p>The Moon completes its journey through all 12 zodiac signs in approximately 28 days, spending about 2.5 days in each sign.</p>
        
        <p>When the Moon enters your birth Sun sign, a unique opportunity arises. During this time, fasting and cleansing practices can trigger a special alchemical process within the body.</p>
        
        <p>The Amygdala gland in the brain produces a sacred oil, releasing a few drops each month. This oil gradually accumulates in the solar plexus region before distributing throughout the body. Over time, this oil serves as a catalyst for spiritual transformation and bodily ascension.</p>
    </div>   

<p class="current-sign">Luna is currently in: <span><?php echo htmlspecialchars($current['sign'], ENT_QUOTES, 'UTF-8'); ?></span></p>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Sign Enters</th>
              <th>Time (PST)</th>
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