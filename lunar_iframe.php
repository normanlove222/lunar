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
  <title>Lunar Ingress</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

   
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">   
    <link rel="mime" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css.map">        
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php

// Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
$latest_year = intval(date('Y'));
?>


<div class="container">
    <img src="images/moon-signs-ingress.jpg" alt="Moon and zodiac signs" width="auto">
    
    <h1>The Moon(Luna) is currently in the sign of: <?php 
    if(!$current) {
          echo "Current sign query returned no results";
      }

    echo $current['sign']; ?> </h1>
    <h1> It entered on: <?php echo $current['idate']; ?> at: <?php echo $current['time']; ?></h1>
    <h1>Lunar Ingress</h1>

    <h2>When the beloved Moon (Luna) enters a specific sign</h2>

    <div class="opening">
         The moon/Luna takes 28 days to cycle all zodiac. Luna spends approx. 2.5 days in each of the 12 Zodic signs. During the time when the moon is in your birth Sun sign, there is an alchemical reaction, process, and opportunity which can occur in the body, when we fast, cleanse and purify the body and consciousness during this period. The xxx of the brain produces this golden oil which will produce a few drops each month. These oils will eventually pool in the area of the solar plexus and then move on to other parts of the body. Overtime these oils act as the catalyst for advanced Ascension processes of the body. 
    </div>   

<h1>Luna is currently in the sign of: <span><?php echo $current['sign']; ?></span></h2>        

       <div class="d-flex justify-content-center">
    <table class="responsive table-striped mx-auto" style="max-width: 960px;">
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
              $row['time'] = date("H:i", strtotime($row['time']));
              $row['idate'] = date("Y-m-d", strtotime($row['idate'])); // remove the time portion
              echo '<tr>'
                  .'<td>'.$row['idate'].'</td>'
                  .'<td>'.$row['sign'].'</td>'
                  .'<td>'.$row['time'].'</td>'
                  .'</tr>';
          }

          
          ?>
        </tbody>
      </table>
</div>


</div> <!-- container -->


</div> <!-- / main container -->

        
    <!-- Bootstrap core JavaScript
    ================================================== -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
   integrity="" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>    
  
     <script >
            $(document).ready(function(){


            //  //below line is used for datatables sorting, searching UI to sork   
            // $('#mytable').DataTable({
            //     "scrollX": true,              
            //   "lengthMenu": [ [12, 24, 48, -1], [12, 24, 48, "All"] ],
            //   "iDisplayLength": 24
            // });

           
             
             
            
            });//document ready

        </script>

</body>
</html>
