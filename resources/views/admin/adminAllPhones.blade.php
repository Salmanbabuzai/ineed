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
		<td colspan="9" class="tableHeading">All Registered Users Phone</td>
	</tr>
</table>

<table class="table2">

	<tr>
		<th>User Name</th>
		<th>User Phone</th>
	</tr>
	@foreach ($dataa as $data)
	<tr>
		<td>{{$data->user_fname}} {{$data->user_fname}}</td>
		<td>{{$data->user_phone}}</td>
	</tr>
	@endforeach
</table>

</div>
</div>

@include('footer')

</body>
</html>