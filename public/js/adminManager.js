var modal1 = document.getElementById("addUser-dialog");
var span1 = document.getElementsByClassName("close")[0];
var modal2 = document.getElementById("editUser-dialog");
var span2 = document.getElementsByClassName("close")[0];

function showAddModel() {
  modal1.style.display = "block";
}
span1.onclick = function() {
  modal1.style.display = "none";
}
function showEditModel() {
  modal2.style.display = "block";
}
span2.onclick = function() {
  modal2.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}


/*   Edit user details  */

$(document).ready(function(){

	$('.showEditUserModel').on('click', function(){
		$tr = $(this).closest('tr');

		var data = $tr.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#id').val(data[0]);
		$('#fname').val(data[2]);
		$('#lname').val(data[3]);
		$('#email').val(data[4]);
		$('#phone').val(data[5]);
		$('#city').val(data[6]);
		$('#address').val(data[7]);
	});
});


/*   Edit post details  */

$(document).ready(function(){

	$('.showEditPostModel').on('click', function(){
		$tr = $(this).closest('tr');

		var data = $tr.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#id').val(data[0]);
		$('#fname').val(data[2]);
		$('#lname').val(data[3]);
		$('#email').val(data[4]);
		$('#phone').val(data[5]);
		$('#city').val(data[6]);
		$('#address').val(data[7]);
	});
});