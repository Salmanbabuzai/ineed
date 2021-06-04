<!DOCTYPE html>
<html>
<head>
	
	<title></title>

<style type="text/css">
  
.contactUs-wrapper{
  margin: 20px 200px 100px 200px;
  border-radius: 5px;
  padding: 10px;
}
.contactUs-wrapper h1{
  text-align: center;
  color: #404145;
  margin: 20px 0px;
}
.contactUs-wrapper h2{
	color: #404145;
  margin: 30px 0px 0px 0px;
}

form p{
	color: #404145;
	font-weight: bold;
	margin: 20px 0px;
}
form select{
	padding: 7px;
	width: 100%;
	outline-color: purple;
	border: 2px solid #EFEFF0;
}
form input, textarea{
	padding: 7px;
	width: 98%;
	outline-color: purple;
	border: 2px solid #EFEFF0;
}
form textarea{
	height: 150px;
	resize: none;
	text-indent: 0px;
}
.contactUs-wrapper form input[type='submit']{
	padding: 10px;
	margin-top: 20px;
	width: 200px;
	outline: none;
	border: none;
	border-radius: 5px;
	font-weight: bolder;
	color: white;
	font-size: 20px;
	display: inline;
	cursor: pointer;
	background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%);
}

</style>

</head>

<body>

@include('header')

<div class="contactUs-wrapper">

<h1>Help & Support</h1>
<hr noshade="">
<h2>Submit a Request</h2>

<form method="post" id="contactSupportForm" action="{{url('/sendEmailToSupport')}}" style="width: 100%;">
	@csrf
	
	<p>What can we help you with?</p>
	<select name="options">
		<option>General Issue</option>
		<option>Account Issue</option>
		<option>Post Issue</option>
		<option>Offer Issue</option>
		<option>Report a Bug</option>
		<option>Data & Privacy</option>
		<option>Other</option>
	</select>
	<p>Subject</p>
	<input type="text" autocomplete="off" name="subject" maxlength="50" required>
	<p>Description</p>
	<textarea maxlength="200" form="contactSupportForm" name="details" required></textarea>
	<input type="submit" name="" value="Submit Request">
	

</form>



</div>

</body>
</html>