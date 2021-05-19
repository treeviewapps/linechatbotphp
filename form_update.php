<!DOCTYPE html>
<html>
<body>
 
<h2>API GOOGLE APPSCRIPT</h2>
<?php
$num =  $_GET['num'];
$url = 'https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=selects&sheet_name=member' ; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed
?>
<form action="edit_save.php?num=<?php echo $num ?>" name="form1" method="post">
<?php foreach ($characters as $character) {
   if($character->num == $num){
   ?>
 <label for="fname">First name:</label><br>
 <input type="text"  name="id" value="<?php echo $character->id?>"><br>
 <label for="lname">Last name:</label><br>
 <input type="text"  name="name" value="<?php echo $character->name?>"><br><br>
 <label for="age">age:</label><br>
 <input type="text" name="age" value="<?php echo $character->age?>"> <br><br>
<? } }?>
 <input type="submit" value="Submit">
</form>
 
 
 
</body>
</html>
