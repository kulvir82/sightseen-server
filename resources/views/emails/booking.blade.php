<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My First Email</title>
<style type="text/css">
    body {
        font-family: Muli,Helvetica,Arial,sans-serif;
    }
    .brandimg img{
        max-width: 150px;
        height: auto;
    }
    .mailcontent{
        margin: auto;
        max-width: 50%;
        color: #000;
    }
    .order_detail{
        background: #fdf4d4;
        padding: 10px 20px;
        margin: 10px 0;
    }
    .order_processing_detail h1{
        text-align: center;
    }
    .order_processing_detail p.red{
        color: #f00;
    }
    .order_info_detail{
        padding: 0;
        margin: 10px 0;
    }
    .order_info_header{
        height: 40px;
        background: #f00;
        padding-left: 20px;
        color: #fff;
        font-size: 2em;
        font-weight: bold;
    }
    .order_info_header span{
      line-height: 40px;
    }
    .booking_info{
        padding: 10px 20px;
    }
    .note p{
        color: #bbb;
    }
    .footer span{
        color: #f00;
    }
    .footer a{
      text-decoration: none;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="mailcontent">
            <div class="brandimg">
            	<img src="https://go4sightseeing.com/images/frontimages/Go4ss_logo.png" class="img-fluid" />
        	</div>
	        <div class="order_detail order_processing_detail">
	            <h1>Order Processing</h1>
                <p class="red">Dear {{ $booking_detail[0]['last_name'] }}/{{ $booking_detail[0]['first_name'] }}:</p>
                <p>Thanks for your order on Go4SightSeeing!</p>
	            <p class="red">We are in the midst of processing your order. Thank you for your patience!</p>
	            <h5>Booking NO.</h5>
                <h2>{{ $booking_number }}</h2>
	        </div>
            <div class="order_detail order_info_detail">
                <div class="order_info_header">
                    <span> Order Info </span>
                </div>
                <div class="booking_info">
                    @foreach($booking_detail as $booking)
                        <p> Travel Date: {{ $booking['booking_date'] }} </p>
                        <p> <b> {{ $booking['title'] }} </b> </p>
                        <p> {{ $booking['first_name'] }} {{ $booking['last_name'] }} </p>
                        <p> {{ $booking['no_of_pax'] }} Traveler </p>
                        </br>
                    @endforeach
                </div>
            </div>
            <div class="order_detail footer">
              <p>Look forward to having you back for your other travel plans. Have fun!</p>

              <p>Cheers,</p> 
              <p>Go4sightseeing Team.</p>
              <br/>
              <p>If you have questions or concerns, please call us or email us.</p>
              <p>
                Email: <a href="mailto:support@go4sightseeing.com"><span>support@go4sightseeing.com</span></a>     Website: <a href="https://www.go4sightseeing.com"><span>https://www.go4sightseeing.com</span></a>
              </p>
            </div>
            <div class="note">
                <p>If you have received this communication in error, please do not forward its contents; notify the sender and delete it and any attachments. This message may contain information that is confidential and legally privileged. Unless you are the addressee, you may not use, copy or disclose to anyone this message or any information contained within</p>
            </div>
        </div>
    </div>
</body>
</html>
