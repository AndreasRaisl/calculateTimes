<!DOCTYPE html>
<html>
<head>
	<title> Geburtstag berechnen - Eingabeseite </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="formBirthdayCalcStyles.css">	
</head>

<body>
<?php	
	function showDateGerman() {
		$deutscheWochentage = array("Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");
		$timestamp = time();
		$date = date("d.m.Y", $timestamp);
		$numberOfWeekday = date("w", $timestamp);
		$wochentag = $deutscheWochentage[$numberOfWeekday];
		echo "Heute ist $wochentag, der  $date";	
	}	
	if(isset($_GET['problem'])) $problem = $_GET['problem'];
	else $problem = "";		
?>

<div class='menu-container'>
	<div class='menu'>
		<div class='date'> <?php echo showDateGerman(); ?> </div>
		<!-- <div class="signupandlogin">
			<div class='signup'> <a href="#RegistrationHeader">Sign Up</a></div>
			<div class='login'> <a href="#LoginHeader">Login</a> </div>
	  </div> -->
	</div>
</div>

<div class="registration-container">
	<div class="register">
		<h2> Wochentag der Geburt berechnen </h2>
		<p> Bitte geben Sie Tag, Monat und Jahr als Zahlenwerte an! </p>
		<br> <br>

		<form action="calculateBirthday.php" method="post" enctype="multipart/form-data" name="birthdayForm">		
			<div class="form-row">
				<label for="birthdayDay"> Tag </label>
				<input type="text" name="birthdayDay" size="2" value="<?php echo @$_GET['day'];	?>">
				<?php
				if($problem == 'day') echo '<p> Der Tag muss ein Zahlenwert zwischen 1 und 31 sein </p>';
				?>
			</div>			

			<div class="form-row">
				<label for="birthdayMonth"> Monat </label>
				<input type="text" name="birthdayMonth" value="<?php echo @$_GET['month']; ?>">
			</div>

			<?php
				if($problem == 'month') echo '<p> Der Monat muss ein Zahlenwert zwischen 1 und 12 sein </p>';
			?>

			<div class="form-row">
				<label for="birthdayYear"> Jahr </label>
				<input type="text" name="birthdayYear" value="<?php echo @$_GET['year']; ?>">
			</div>

			<?php
				if($problem == 'year') echo '<p> Das Jahr muss ein Zahlenwert zwischen 1880 und 2020 sein <br>
				                             Für Geburtsjahre ab 1970 ist auch die Eingabe  2 Ziffern möglich (88 statt 1988)  </p>';
			?>
			
			<div class='form-row'>
				<!-- <button>Tag berechnen</button> -->
				<input class="submitButton" type="submit" value="Tag berechnen">
			</div>
		</form>

	</div>
</div>