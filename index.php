<?php
$host = "mydb";
$user = "dbuser";
$pass = "dbpass";
$db = "msgdb";

$conn = new mysqli($host, $user, $pass, $db);

if(isset($_POST['comment']) && $_POST['comment'] !='') {
        $message = $conn->real_escape_string($_POST['comment']);
        $sql="INSERT INTO msg(message) VALUES ('".$message."')";



        if(!$result = $conn->query($sql)) {
                echo("Cannot insert message to database!!");
        }
        else {
                echo("Message accepted!");
        }

	exit(0);
}
?>



<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
.response_msg{
	margin-top:10px;
	font-size:13px;
	background:#E5D669;
	color:#ffffff;
	width:250px;
	padding:3px;
	display:none;
}
</style>
</head>
<body>
	<div class="container">

		<div class="row">
				<h1>Chat application</h1>
			<?php
				$sql="select * from msg";
				$result = $conn->query($sql);
				while($row = mysqli_fetch_assoc($result)) {
					#print_r($row);
			?>
			<div class="col-md-8">	
			<?php
					print($row['message'].'<br/>');
?>
			</div>
			<?php
				}
			?>
		</div><br/><br/>
		<div class="row">
			<div class="col-md-8">
					<form name="contact-form" action="" method="post" id="contact-form">
						<div class="form-group">
							<label for="comment">Comments</label>
							<textarea name="comment" class="form-control" rows="3" cols="28" rows="5" placeholder="Comments"></textarea> 
						</div>
						<button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Submit</button>
					</form>

					
					<div class="response_msg"></div>
			</div>
		</div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>

			$(document).ready(function(){
				$("#contact-form").on("submit",function(e){
					e.preventDefault();
					if ($("#contact-form [name='comment']").val() === '')
					{
						$("#contact-form [name='comment']").css("border","1px solid red");
					}
					else
					{
						var sendData = $( this ).serialize();
							console.log(sendData)
						$.ajax({
							type: "POST",
							url: "index.php",
							data: sendData,
							success: function(data){
								//$(".response_msg").text(data);
								//$(".response_msg").slideDown().fadeOut(3000);
								//$("#contact-form").find("textarea").val("");
								location.reload();
							}
						});
					}
				});

			});
</script>
</body>
</html>
