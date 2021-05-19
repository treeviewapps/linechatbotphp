<?php
$num = $_GET['num'];
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$url = 'https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=edit&sheet_name=member';
$data = array('num' => $num, 'id' => $id , 'name' => $name , 'age' => $age);
$datas = json_encode($data );
 
$options = array(
   'http' => array(
       'header'  => "Content-type: application/json",
       'method'  => 'POST',
       'content' => ($datas)
   )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {  }
else{ ?>
  <script langquage='javascript'>  window.location="show.php"; </script>
<?php }
 
?>
