<!DOCTYPE html>
<html>
<head>
	
	<title></title>

<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: left;
  margin-right: 10px;
}

.active:after {
  content: "\2212";
}

.panel {
  padding: 0 18px;
  margin: 10px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}

.wrapper_help{
	margin: 20px 200px 100px 200px;
}
.wrapper_help p{
	margin: 20px;
}

</style>



</head>
<body>

@include('header')

<div class="wrapper_help">

<h2 class="wrapper-heading" style="text-align: center;">How | Where | What | When</h2>

<p>
We believe in providing excellent Service to our Customers. Here will be be able to find how the application works, how you can interact with, and where it will be leading you.


</p>


<button class="accordion">How to Join as Buyer</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How to Join as Seller</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How and Where to Post a Need</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How to Send an Offer / How to Bid on Post</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How I Can Contact a Seller</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How to Update Password</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">Where I Can View Offers that I Have Recieved</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How to Contact a Buyer</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>

<button class="accordion">How to Reach Contact Support</button>
<div class="panel">
  <p>Details goes here.............................................</p>
</div>










</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

@include('footer')

</body>
</html>