/*  Character Counter  */

$('#title').keyup(function () {
  max = this.getAttribute("maxlength");
  var len1 = $(this).val().length;
   if (len1 >= max) {
    $('#titleCounter').text(' you have reached the limit');
   } else {
    var char = max - len1;
    $('#titleCounter').text(char + ' characters left');
   }
});

$('#details').keyup(function () {
   max = this.getAttribute("maxlength");
  var len2 = $(this).val().length;
   if (len2 >= max) {
    $('#detailsCounter').text(' you have reached the limit');
   } else {
    var char = max - len2;
    $('#detailsCounter').text(char + ' characters left');
   }
});


/*  getting categories from DB  */
$(document).ready(function(){
	$('select[name="mainCat"]').on('change',
		function(){

		var mainCat = $(this).val();
        if (mainCat) {

        $.ajax({
        	url: '/subCat/'+mainCat,
        	type: 'GET',
        	datatype: 'json',
        	success: function(data){

        	var newData = JSON.parse(data);
        	console.log(newData);


        	$('select[name="subCat"]').empty();
        	$.each(newData, function(key, value){
        		$('select[name="subCat"]').append('<option value="'+key+'">' + value + '</option>');
        	});
        	}
        });
    }
    else{
    	$('select[name="subCat"]').empty();
    }
});
});
