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
		<td colspan="9" class="tableHeading">Offer Manager for @foreach ($userName as $userName) {{$userName->user_fname}} @endforeach</td>
	</tr>
</table>

<table class="table2">
	
	<tr>
		<th>Offer id</th>
		<th>Post id</th>
		<th>Offer Amount</th>
		<th>Delivery Time</th>
		<th>Delivery Charges</th>
		<th>Payment Method</th>
		<th>Action</th>
	</tr>
	@foreach ($dataa as $data)
	<tr>
		<td>{{$data->id}}</td>
		<td>{{$data->post_id}}</td>
		<td><small>{{$data->offer_amount}}</small><small>{{$data->offer_date}}</small></td>
		<td>{{$data->delivery_time}}</td>
		<td>{{$data->delivery_charges}}</td>
		<td>{{$data->payment_method}}</td>
		<td><a href="{{url('adminDeleteOffer')}}/{{$data->id}}" class="btn">Delete</a></td>
	</tr>
	@endforeach
</table>


</div>








</div>

@include('footer')


</body>
</html>