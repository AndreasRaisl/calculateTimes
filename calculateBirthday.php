<?php
  setlocale(LC_ALL,"deu_deu");
  date_default_timezone_set("Europe/Berlin");
  
  $germanDaynames = array("Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");  

  function handleInputErrors($day, $month, $year) {
    if($day == "" or $month == "" or $year == "") {
      $linkWithQueryString = 'index.php?day=' . $day . '&month=' . $month . '&year=' . $year;	
      echo "Angaben sind unvollständig. Bitte zurück zur
      <a href='" . $linkWithQueryString . "'> Eingabemaske </a> <br>";
      exit;
    }
    else if($day <1 or $day > 31 or ctype_digit($day) == false) {
      $linkWithQueryString = 'index.php?day=' . $day . '&month=' . $month . '&year=' . $year . '&problem=day';	
      echo "Angaben sind fehlerhaft. Bitte zurück zur
      <a href='" . $linkWithQueryString . "'> Eingabemaske </a> <br>";
      exit;
    }
    else if($month < 1 or $month > 12 or ctype_digit($month) == false) {
      $linkWithQueryString = 'index.php?day=' . $day . '&month=' . $month . '&year=' . $year . '&problem=month';	
      echo "Angaben sind fehlerhaft. Bitte zurück zur
      <a href='" . $linkWithQueryString . "'> Eingabemaske </a> <br>";
      exit;
    }
    else if($year < 0 or ($year > 20 and $year < 70) or ($year > 99 and $year < 1880)  or $year > 2020 or ctype_digit($year) == false) {
      $linkWithQueryString = 'index.php?day=' . $day . '&month=' . $month . '&year=' . $year . '&problem=year';	
      echo "Angaben sind fehlerhaft. Bitte zurück zur
      <a href='" . $linkWithQueryString . "'> Eingabemaske </a> <br>";
      exit;
    }
    else return;
  }
  
  //$dayToday=strftime("%A");
  $dayTodayNumber = date("w");
  $dayTodayGerman = $germanDaynames[$dayTodayNumber];
  $timestampInOneYear = strtotime('+1year');
  //$dayNextYear = strftime("%A",$timestamp_in_one_year);
  $dayNextYearNumber = date("w", $timestampInOneYear);
  $dayNextYearGerman = $germanDaynames[$dayNextYearNumber];

  $birthdayDay = $_POST['birthdayDay'];
  $birthdayMonth = $_POST['birthdayMonth'];
  $birthdayYear = $_POST['birthdayYear'];

  handleInputErrors($birthdayDay, $birthdayMonth, $birthdayYear);    
    
  $birthdayString = "$birthdayDay.$birthdayMonth.$birthdayYear";
  $birthdayTimestamp = strtotime($birthdayString)."<br />";
  $birthdayWeekdayNumber = date("w", $birthdayTimestamp);
  $birthdayWeekdayGerman = $germanDaynames[$birthdayWeekdayNumber];

  $handle=fopen("besucherzaehler.txt", "r");
  $visitorsBefore=fread($handle, filesize("besucherzaehler.txt"));
  fclose($handle);  
  $visitorsNow = $visitorsBefore+1;    
  $handle=fopen("besucherzaehler.txt","w");
  fwrite($handle, $visitorsNow);
  fclose($handle);
  //$birthdayWeekday = strftime("%A", $birthdayTimestamp);  
?>


<html>
  <head>
    <title> Calculate Birthday </title>
    <link rel="stylesheet" href="stylesForResult.css">
  </head>

  <body> 

    <div class="mainInfoBox">
      <h1> Geburtstag </h1>      
      <h3> Ihr Geburtstag war an einem <?php echo $birthdayWeekdayGerman; ?> </h3> 
    </div> 
    
    <div class="extraInfoBox">
      <h1> Auch interessant </h1>
      <p> Heute ist <?php echo $dayTodayGerman; ?> </p> 
      <p> Die aktuelle Uhrzeit ist jetzt: <?php echo date("H:i"); ?> </p>    
      <p> In genau einem Jahr ist <?php echo $dayNextYearGerman; ?> </p>
      <div class="innerInfoBox">
        <p> Übrigens, vor Ihnen haben bereits  <?php echo $visitorsBefore; ?> Personen diesen Service genutzt. <br>
            Sie sind der <?php echo $visitorsNow; ?>. Nutzer. Die neue Zahl <?php echo $visitorsNow; ?> wurde im Besucherzähler 
            gespeichert. </p>
      </div>       
			<a href="index.php" class="submitButton"> weitere Berechnung </a>      
      
    </div>

  </body>
</html>
