<?php
$num = $_GET['num'];
$url = 'https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=delete&sheet_name=member';
$data = array('num' => $num);
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
