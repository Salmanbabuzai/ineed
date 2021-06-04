<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

@include('admin/adminHeader')


<div class="wrapper2">
	
<div class="allUsers" style="margin-bottom: 300px;">

<table class="table1">
	<tr class="tableHeading">
		<td colspan="9" class="tableHeading">Post Manager for @foreach ($userName as $userName) {{$userName->user_fname}} @endforeach</td>
	</tr>
</table>

<table class="table2">

	<tr>
		<th>id</th>
		<th>User id</th>
		<th>Title</th>
		<th>Picture</th>
		<th>Details</th>
		<th>Cat id</th>
		<th>SubCat id</th>
		<th>Max Days</th>
		<th>Budget</th>
		<th>City</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	@foreach ($dataa as $data)
	<tr>
		<td>{{$data->id}}</td>
		<td>{{$data->user_id}}</td>
		<td>{{$data->post_title}}</td>
		<td><img src="/postImages/{{$data->post_pic1}}"></td>
		<td>{{$data->post_details}}</td>
		<td>{{$data->post_category}}</td>
		<td>{{$data->post_subcategory}}</td>
		<td>{{$data->post_maxdays}}</td>
		<td>{{$data->post_budget}}</td>
		<td>{{$data->post_city}}</td>
		<td>{{$data->post_date}}</td>

		<td><a href="{{url('adminDeletePost')}}/{{$data->id}}"><img src="/Images/deleteIcon.png" class="icon"></a><a href="{{ url('editNeed') }}/{{$data->id}}"><img src="/Images/editIcon.png" class="icon"></td>

	</tr>
	@endforeach
</table>


</div>






</div>


@include('footer')


</body>
</html>