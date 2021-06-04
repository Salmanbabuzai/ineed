<!DOCTYPE html>
<html>
<head>
  <title></title>


  <style type="text/css">
   


.modal {
  display: block; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10000; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  width: 500px;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-content form{
  width: 100%;
}
.modal-content .heading{
  color: #404145;
  font-weight: bolder;
  border: 1px solid #EFEFF0;
  background-color: #FAFAFA; 
  text-indent: 15px;
  margin: 10px 0px;
  padding: 10px 0px;
  display: block;
}
.modal-content .body{
  padding: 10px;
  font-size: 15px;
  color: #404145;
  border: 1px solid #EFEFF0;
  background-color: #FAFAFA; 
} 

.btn{
  padding: 10px;
  border: none;
  text-decoration: none;
  color: white;
  border-radius: 5px;
  outline: none;
  cursor: pointer;
  background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%);
}



  </style>

</head>

<body>


@foreach ($data as $data)

<div id="sendEmailModel" class="modal">
<div class="modal-content">
<form method="post" id="emailForm" action="{{url('/sendUserData')}}/{{ $data->id }}">
  @csrf
<div class="heading">Send An Email to the Seller</div>
<div class="body">
<p class="heading">Title:
<input type="text" name="title" value="Hello {{ $data->user_fname }}, Thanks for Your Offer" style="border: none; outline: none; width: 80%; background-color: inherit;" readonly=""></p>
<p class="heading">Body:</p>
<textarea type="text" name="body" form="emailForm" placeholder="Write Your Message Here...." required style="border: none; width: 100%; height: 100px; resize: none;"></textarea>
<textarea type="text" name="name" form="emailForm" style="border: none; outline: none; width: 100%; height: 30px; resize: none;" readonly="">
  Name: {{ $data->user_fname }} {{ $data->user_lname }}
</textarea>
<textarea type="text" name="phone" form="emailForm" style="border: none; outline: none; width: 100%; height: 30px; resize: none;" readonly="">
  Phone: {{ $data->user_phone }}
</textarea>
<textarea type="text" name="email" form="emailForm" style="border: none; outline: none; width: 100%; height: 30px; resize: none;" readonly="">
  Email: {{ $data->email }}
</textarea>

@endforeach

<p style="margin-top: 20px; color: red; font-size: 10px;">By Clicking Send, The above email will be send</p>

<input type="submit" class="btn" value="Urgent Email"></form>

</div>
</div>
</div>


</body>
</html>
