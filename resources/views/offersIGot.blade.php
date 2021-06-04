<!DOCTYPE html>
<html>
<head>
  <title></title>

</head>

<body>


@include('header')

@if(count($data)>0)

<div class="postDetails">
  
@foreach ($postDetails as $postDetails)

    <img src="/postImages/{{ $postDetails->post_pic1 }}">
    <h2>{{ $postDetails->post_title }}</h2>
    <div class="within-days">Within {{ $postDetails->post_maxdays }} Days | </div>
    <div class="days-ago">3 Days ago</div>
    <div class="under-amount">Under Rs {{ $postDetails->post_budget }}</div>
    <div class="country">Needed in {{ $postDetails->post_city }}</div>

@endforeach

</div>

<div class="offersTable">

  <table>
  <tr>
      <th>Name</th>
      <th>Phone</th>
      <th style="">Email</th>
    </tr>
@foreach ($userContact as $userContact)
    <tr>
      <td>{{ $userContact->user_fname }} {{ $userContact->user_lname }}</td>
      <td>{{ $userContact->user_phone }}</td>
      <td>{{ $userContact->email }}</td>
    </tr>
@endforeach
  </table>
  
  <table>    

    <tr>
      <th>Date</th>
      <th>Offer</th>
      <th>Days</th>
      <th>Delviery Charges</th>
      <th>Payment Method</th>
      <th>Inbox</th>
    </tr>

@foreach ($data as $data)

    <tr class="offersTabletd">
      <td>{{ \Carbon\Carbon::parse($data->offer_date)->diffForHumans() }}</td>
      <td>{{ $data->offer_amount }}</td>
      <td>{{ $data->delivery_time }}</td>
      <td>{{ $data->delivery_charges }}</td>
      <td>{{ $data->payment_method }}</td>

@if($data->emailSent==0)
    <td>
      <form method="post" action="{{ url('/sendEmail') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="submit" class="btn" value="Send Email">
      </form>
    </td>
@else
   <td><input type="submit" class="btn" value="Email Sent" style="opacity: 0.5; cursor: default;"></td>
@endif
    </tr>
@endforeach

@else

<div class="wrapper-heading">No Offer Received</div>


@endif

</table>

</div>

@include('footer')

</body>
</html>
