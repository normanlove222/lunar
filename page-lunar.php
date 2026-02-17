<?php
/*
Template Name: Lunar
*/
?>
<?php get_header(); ?>
<?php

$host = 'lunar-ingress.norman-love.com';
$db = "lunar";
$user = 'lunar222';
$pass = 'Norman144$';
$charset = 'utf8mb4';

// $host = 'localhost';
// $db = "lunar-ingress";
// $user = 'root';
// $pass = '';
// $charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+00:00'",
];
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);


//sql for future lunar ingresses
$stmt = $pdo->query("SELECT * FROM lunar
                    where idate >= utc_timestamp()
                    order by idate asc
                    limit 60");
$info = $stmt->fetchall();

//lets get current sign luna is in
$stmt2 = $pdo->query("SELECT * FROM lunar
                    where idate <= utc_timestamp()
                    order by idate desc
                    limit 1");
$current = $stmt2->fetch();

function convertToLocalTime($date, $time)
{
    // Create a DateTime object with the GMT date
    $gmtDateTime = new DateTime($date, new DateTimeZone('GMT'));

    // Set the time on the DateTime object
    $gmtDateTime->setTime(
        intval(substr($time, 0, 2)),
        intval(substr($time, 3, 2)),
        intval(substr($time, 6, 2))
    );

    // Get the timezone for the Pacific region
    $tz = new DateTimeZone('America/Los_Angeles');

    // Adjust the DateTime object to the Pacific timezone
    $gmtDateTime->setTimezone($tz);

    // Get the offset from GMT for the current time
    $offset = $tz->getOffset($gmtDateTime) / 3600;

    // Determine if it's currently PDT (-7 hours) or PST (-8 hours)
    $isDaylightSavingTime = $offset == -7;

    // Format the adjusted date and time
    $adjustedDate = $gmtDateTime->format('Y-m-d');
    $adjustedTime = $gmtDateTime->format('H:i:s');

    // Append the time zone information to the time
    $timeZone = $isDaylightSavingTime ? 'PDT' : 'PST';
    $adjustedTime .= ' ' . $timeZone;

    // Return the adjusted date and time as an array
    return [$adjustedDate, $adjustedTime];
}

$latest_year = intval(date('Y'));

list($localDate, $localTime) = convertToLocalTime($current['idate'], $current['time']);
?>

	<div id="content" role="main">				
           <div class="lunar-image-div">
                   <h1>Lunar Ingress</h1>
                    <h2>When the beloved Luna (Moon) enters YOUR sign</h2>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/lunar/images/moon-signs-ingress.jpg" alt="Moon and zodiac signs" width="auto" class="aligncenter">
           </div>
        
    
    <h1>Luna is currently in the sign of: <span class="yellow-sign"><?php echo $current['sign']; ?> </span></h1>
<h1> It entered on: <?php echo $localDate; ?> at: <?php echo $localTime; ?></h1>    	
    	

    <div class="opening">
         All times are in Pacific-Time/California, USA., Since we all live in different time zones around the planet. You can use this site <a href="https://www.timeanddate.com/worldclock/converter.html" target="_blank">here</a> to convert the below times to your local time. 
    </div>   
  <br>

    <div class="opening">
         The moon takes 28 days to cycle the zodiac. Luna spends approx. 2.5 days in each of the 12 Zodic signs. During the time when the moon is in your birth Sun sign, there is an alchemical reaction, process, and opportunity, which can occur in the body, when we fast, cleanse and purify the body and consciousness during this period. The PANGALA of the brain produces this golden oil which will produce a few drops each month. These oils will eventually pool in the area of the solar plexus and then move on to other parts of the body. Overtime these oils act as the catalyst for the complete Ascension processes of the body. 
    </div>   
    <br>
    <div class="opening">
        The above teaching is from the teachings of SanandaJi & Shekinah Ma, 2 Ascended Masters who are here to teach the art of Ascension. I have studied under them since October of 2017. Their "base" course is called Golden Age Energetics and covers much on the Ascension process and how to thrive in this new Age of Aquarius, which we officially entered on December 21, 2020. I have already taken it, and I highly recommend it for anyone who is interested in Ascending THIS lifetime. Get more info by clicking <a href="https://tx435.isrefer.com/go/gae/normanbird/" target="_blank">here</a>. They are sponsors for this site, and I do benefit if you purchase their teachings; so you should of course check it out and decide for yourself if its for you.<br> <br> Bless Sings
        <br><br>~Norman Love
    </div>
    

    <h1>Upcoming Lunar Transits </h1>
        <div style="text-align:center;">
        <table class="responsive table-striped lunar center">
        <thead>
          <tr>
            
           
            <th >Date Moon Enters</th>           
            <th >Sign</th>
            <th >Time(GMT)</th>
            
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($info as $row) {   

            list($localDate, $localTime) = convertToLocalTime($row['idate'], $row['time']);  
          		//format time to remove unneeded seconds
          	$row['time'] = date( "H:i", strtotime($row['time']));

             echo '<tr>'
                    .'<td class="next-date">'.htmlspecialchars($localDate, ENT_QUOTES, 'UTF-8').'</td>'
                    .'<td class="next-sign">'.htmlspecialchars($row['sign'], ENT_QUOTES, 'UTF-8').'</td>'
                    .'<td class="next-time">'.htmlspecialchars($localTime, ENT_QUOTES, 'UTF-8').'</td>'            
                 .'</tr>';

          }
          ?>
        </tbody>
      </table>
    </div>
  </div><!-- #content -->	
        

                <?php //get_sidebar(); ?>
	        
           

<?php get_footer(); ?>