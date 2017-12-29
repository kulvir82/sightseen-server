<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My First Email</title>
<style type="text/css">
    .brandimg img{
        max-width:150px;
        height:auto;
    }
    .border{
        border-bottom: 1px solid #E0E0E0;
    }
    .topspace{
        margin:20px;
        padding:15px;
        border-radius:3px;
        background:#E0E0E0;
    }
    .mailcontent{
        margin:20px;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="topspace"></div>
        <div class="mailcontent">
            <div class="brandimg">
            	<img src="https://go4sightseeing.com/images/frontimages/Go4ss_logo.png" class="img-fluid" />
        	</div>
	        <div class="headings">
	            <h3><strong></strong><strong></strong><strong></strong><h3>
	        </div>
	        <div class="row border">
	            <p>Hello {{ $username }},</p>
	            <p>Your reservation for Mimosa Pattaya City of Love Ticket - Admission Ticket + Mimosa Show is confirmed. Be sure to check below for instructions on how to use attached e-voucher. For more details, kindly refer to the attachment.</p>
	            <p>Booking Number : {{ $booking_number }}</p>
	        </div>
            <p> Traveler Name: {{ $username }}</p>
            <p> SightSeen Name: {{ $sightseen }}</p>
            <p> No of Person: {{ $persons }}</p>
            <p> Date: {{ $date }}</p>
    
        	<div class="row border">
	            <p>
	             Thanks for your order on kkday!
					We are in the midst of processing your order. Thank you for your patience!    
	            </p>
        	</div>
 		<img src="{{$message->embed($attachment)}}" />
        </div>
    </div>
</body>
</html>

