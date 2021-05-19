<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
<?php
$url = 'https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=selects&sheet_name=member' ; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed

//echo $data;
//var_dump($characters);
//exit();

?>
 
 
<div class="container">
 
<div class="jumbotron jumbotron-fluid">
 <div class="container">
  <center><h1 class="display-4">API GOOGLE APPSCRIPT</h1>
   <p class="lead"></p>
   <a class="btn btn-primary" href="form_insert.php" role="button">เพิ่ม</a></center>
 </div>
</div>
 
<table class="table">
 <thead>
   <tr>
     <th scope="col">num</th>
     <th scope="col">รหัสนักเรียน</th>
     <th scope="col">ชื่อ-สกุล</th>
     <th scope="col">อายุ</th>
     <th scope="col">จัดการ</th>
     <th scope="col">จัดการ js</th>
   </tr>
 </thead>
 <tbody>
 <?php foreach ($characters as $character) {
?>
   <tr>
     <td><?=$character->num;?> </td>
     <td><?=$character->id;?> </td>
     <td><?=$character->name;?></td>
     <td><?=$character->age;?></td>
     <td>
         <a href="del.php?num=<?php echo $character->num ?>"> ลบ  </a>
         <a href="form_update.php?num=<?php echo $character->num ?>"> แก้ไข </a>
     </td>
     <td>
     	<button id="deljs" onClick="delDataRow(<?=$character->num?>)">ลบ</button>
        <button id="updatejs" onClick="openUpdateFrom(<?=$character->num?>);">แก้ไข</button>
     </td>
   </tr>
 <?php } ?>
 </tbody>
</table>
 
</div>
<div>
	<button onClick="callgooglesheet();">test ajax call api google script</button>
</div>
<div id="showresult1"></div>
<div id="showresult2"></div>

<div>
 <label for="fname">id :</label>
 <input type="text"  name="id" id="id" >&nbsp;&nbsp;
 <label for="lname">name:</label>
 <input type="text"  name="name" id="name" >&nbsp;&nbsp;
 <label for="age">age:</label>
 <input type="text" name="age" id="age" >&nbsp;&nbsp;
 <button onClick="insertDataSheet();">เพิ่ม</button>
</div>
<div id="showresult3"></div>

<div id="form_update" style="display:none;">
 <label for="numupdate">no :</label>
 <input type="text"  name="numupdate" id="numupdate" disabled>&nbsp;&nbsp;
 <label for="fname">id :</label>
 <input type="text"  name="idupdate" id="idupdate" >&nbsp;&nbsp;
 <label for="lname">name:</label>
 <input type="text"  name="nameupdate" id="nameupdate" >&nbsp;&nbsp;
 <label for="age">age:</label>
 <input type="text" name="ageupdate" id="ageupdate" >&nbsp;&nbsp;
 <button onClick="updateDataSheet();">บันทึกการแก้ไข</button><button onClick="hideFormUpdate();">ยกเลิก</button>
</div>
<div id="showresult4"></div>

<script>
    
	var datobjects = [];

	function callgooglesheet(){
		/*alert('test api');	
		$("#showresult1").html("Test API");
		var data1 = 'action=selects&sheet_name=member';
	    alert(data1);
		$("#showresult1").html(data1);
		*/
		var data1 = "";
		
		$.ajax({
			type: "POST", 
			url: "https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec",      
			data: 
			{
				action: "selects",
		        sheet_name: "member"
			},         
			success: function (da)
			{
			   alert(JSON.stringify(da));
			   $("#showresult1").html(JSON.stringify(da));
			   datobjects = da;
			   for(var i=0; i<datobjects.length; i++){
				   data1 += datobjects[i].name + ",";
			   }
			   $("#showresult2").html(data1);
			},
			error: function(da)
			{
			   alert(JSON.stringify(da));
			   $("#showresult").html(JSON.stringify(da));	
			}
		});
		
		 /*$.get("https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=selects&sheet_name=member", function(data){
      		alert(JSON.stringify(data));
			//datobjects = JSON.stringify(data);
			$("#showresult1").html(JSON.stringify(data));
    	});*/
		
		/*$.post("https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec",
		{
		  action: "selects",
		  sheet_name: "member"
		},
		function(data){
		  alert(JSON.stringify(data));
		  $("#showresult1").html(JSON.stringify(data));
		});
		*/
		
	}
	
	
	function insertDataSheet(){
		//alert('test');	
		var id = $("#id").val();
		var name = $("#name").val();
		var age = $("#age").val();
		//$("#showresult3").html("" + id + "," + name + "," + age);
		var obj = { id: "" + id + "", name: "" + name + "", age: "" + age + "" };
		var myJSON = JSON.stringify(obj);
		//document.getElementById("showresult3").innerHTML = myJSON;
		
		$.ajax({
			url: "https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=insert&sheet_name=member",
			type: "POST",
			data: myJSON,
			//contentType: "application/json",
			dataType:'json',
			success: function (response) {
				//console.log(response);
				alert(JSON.stringify(response));
			   $("#showresult3").html(JSON.stringify(response));
			},
			error: function(error){
				//console.log("Something went wrong", error);
				alert(JSON.stringify(error));
			   $("#showresult3").html(JSON.stringify(error));
			}
		});
		
	}
	
	function openUpdateFrom(num){
		//alert("test update => " + num);
		
		$.ajax({
			type: "POST", 
			url: "https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec",      
			data: 
			{
				action: "selects",
		        sheet_name: "member"
			},         
			success: function (da)
			{
			   datobjects = da;
			   for(var i=0; i<datobjects.length; i++){
				   if(datobjects[i].num==num){
					    $("#numupdate").val(datobjects[i].num);
						$("#idupdate").val(datobjects[i].id);
						$("#nameupdate").val(datobjects[i].name);
						$("#ageupdate").val(datobjects[i].age);
						$("#form_update").show();
						break;
				   }
			   }
			},
			error: function(da)
			{
			   alert(JSON.stringify(da));
			   //$("#showresult").html(JSON.stringify(da));	
			   
			}
		});
		
	}
	
	function hideFormUpdate(){
		$("#form_update").hide();
		$("#idupdate").val("");
		$("#nameupdate").val("");
		$("#ageupdate").val("");
			
	}
	
	function updateDataSheet(){
		alert("test update datasheet");	
		var num = $("#numupdate").val();
		var id = $("#idupdate").val();
		var name = $("#nameupdate").val();
		var age = $("#ageupdate").val();
		alert(num + "," + id + "," + name + "," + age);
		var obj = { num: "" + num + "", id: "" + id + "", name: "" + name + "", age: "" + age + "" };
		var objJSON = JSON.stringify(obj);
		$.ajax({
			url: "https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=edit&sheet_name=member",
			type: "POST",
			data: objJSON,
			//contentType: "application/json",
			dataType:'json',
			success: function (response) {
				//console.log(response);
				alert(JSON.stringify(response));
			   $("#showresult4").html(JSON.stringify(response));
			   hideFormUpdate();
			},
			error: function(error){
				//console.log("Something went wrong", error);
				alert(JSON.stringify(error));
			   $("#showresult4").html(JSON.stringify(error));
			}
		});
		
	}
	
	function delDataRow(num){
		//alert(num);
		var num = num;
		var obj = { num: "" + num + ""};
		var objJSON = JSON.stringify(obj);
		$.ajax({
			url: "https://script.google.com/macros/s/AKfycbyhRZYTsq83FG7X_waFKhRwUivjyOPvjEYPUTPqmDriv42mb1dbxqN4QxwyV2SY5EMs/exec?action=delete&sheet_name=member",
			type: "POST",
			data: objJSON,
			//contentType: "application/json",
			dataType:'json',
			success: function (response) {
				//console.log(response);
				alert(JSON.stringify(response));
			   $("#showresult4").html(JSON.stringify(response));
			},
			error: function(error){
				//console.log("Something went wrong", error);
				alert(JSON.stringify(error));
			   $("#showresult4").html(JSON.stringify(error));
			}
		});
	}
	
</script>

</body>
</html>
