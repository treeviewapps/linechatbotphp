<?php
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$url = 'https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=insert&sheet_name=member';
$data = array('id' => $id , 'name' => $name , 'age' => $age);
$datas = json_encode($data );

/*{"id":"10005","name":"\u0e1f\u0e49\u0e32","age":"17"}*/

//echo $datas;
//exit();
 
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
else{ 
  //echo $result;
  /*{"parameter":{"action":"insert","sheet_name":"member"},"contextPath":"","contentLength":38,"queryString":"action=insert&sheet_name=member","parameters":{"action":["insert"],"sheet_name":["member"]},"postData":{"type":"application/json","length":38,"contents":"{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}","name":"postData"}} */
  
/*{"parameter":{"action":"insert","sheet_name":"member","{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}":""},"contextPath":"","contentLength":38,"queryString":"action=insert&sheet_name=member","parameters":{"action":["insert"],"sheet_name":["member"],"{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}":[""]},"postData":{"type":"application/x-www-form-urlencoded","length":38,"contents":"{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}","name":"postData"}}*/

/*"{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}" */

/*"{\"id\":\"10005\",\"name\":\"abc\",\"age\":\"17\"}"*/

/*"10005,abc,17" */

/*"10005,abc,17"*/
  

 
?>
  <script langquage='javascript'>  window.location="show.php"; </script>
<?php }
 
?>
