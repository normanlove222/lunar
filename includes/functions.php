<?php
require('init.php');

//show all errors during development only

/**
 * Converts a GMT date to PST/PDT time zone
 *
 * @param string $date Date in the format 'Y-m-d' (e.g., '2021-03-16')
 * @param string $time Time in the format 'H:i:s' (e.g., '23:34:00')
 * @return array An array with two elements: [0] => adjusted date, [1] => adjusted time
 */
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
function getDbInfo($lpn) {
//get lpn info from DB
	global $pdo;

$stmt = $pdo->query("SELECT * FROM lpn where lpn=$lpn LIMIT 1");
$info = $stmt->fetch();

return $info;

}

function console_log( $data )
{
    
    echo "<script>console.log( 'Debug: " . $data . "' );</script>";
}

function findSum($result) {
    $result = str_split($result);
    while(array_sum($result) > 9) 
        return findSum(array_sum($result));
    return array_sum($result);
}

function getLifePathNumber($d, $m, $y)
{
	
$n1 = $d + $m; // 5 + 30 = 35 reduces to 8
$n1 = findSum($n1);

$n2 = $y;
$n2 = findSum($n2);
$n3= $n1 + $n2; // 35 + 1965 reduces to 3
$n3 = findSum($n3);
return $n3;
}

function getOffset($n){

switch ($n) {
    case 9:
        return 8;
        break;
    case 2:
        return 1;
        break;
    case 3:
        return 2;
        break;
    case 4:
        return 3;
        break;
    case 5:
        return 4;
        break;
    case 6:
        return 5;
        break;
    case 7:
        return 6;
        break;
    case 8:
        return 7;
        break;
    default:
        return 0;
}


} //getOffset


function getNewYear($n, $y){

$year = $y - $n;
return $year;
}


function drawPad($y, $offset){

$message = '<tr>';
for ($i = 0; $i < $offset ; $i++) {

	$message .= '<td>'.$y.' xx</td>';
    $y++;
}


return $message;
}//end drawPad


function getTable($n, $y){
//calculate and return the dynamic numerology table built on the date.


//get offset
   
    $startage = 0;
	$offset = getOffset($n);

	$startyear = getNewYear($offset, $y);	
    $endyear = $y + 100;

	$pad = drawPad($startyear,$offset);

	$message = $pad;
        //calc numbers of years in table by adding 100 years to birth year
        while ($y <= $endyear ){
        if ($n == 1) { $message .= "<tr>";} //end if
            $message .= "<td>$y <span class='startage'>$startage</span></td>";
            
        if (($n == 9) or ($y == $endyear)) { $message .= "</tr>"; $n = 0;} //end if
        
        $n++;
        $y++;
        $startage++;
        
        } //end while
       
       $message .= "<tr><th>1</th><th>2</th><th>3</th><th>4</th> <th>5</th> <th>6</th> <th>7</th> <th>8</th> <th>9</th></tr>";
       return $message;


} //end gettable