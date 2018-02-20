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
        max-width:150px;
        height:auto;
    }
    .border{
        border-bottom: 1px solid #E0E0E0;
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
    .order_confirm_detail h1{
        text-align: center;
    }
    .order_confirm_detail p.red{
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
    @media screen and (max-width: 768px){
        .mailcontent{
            max-width: 80%;
        }
    }
    @media screen and (max-width: 500px){
        .mailcontent{
            max-width: 90%;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <div class="mailcontent">
            <div class="brandimg">
                <img src="https://go4sightseeing.com/images/frontimages/Go4ss_logo.png" class="img-fluid" />
            </div>
            <div class="order_detail order_confirm_detail">
                <h1>Order Confirmed</h1>
                <p class="red">Dear {{ $username }}</p>
                <p>Thanks for your order on Go4SightSeeing!</p>
                <p>Your reservation for Mimosa Pattaya City of Love Ticket - Admission Ticket + Mimosa Show is confirmed. Be sure to check below for instructions on how to use attached e-voucher. For more details, kindly refer to the attachment.</p>
                <p class="red">Booking NO.</h5>
                <h2>{{ $booking_number }}</h2>
            </div>
            <div class="order_detail order_info_detail">
                <div class="order_info_header">
                    <span>Order Info</span>
                </div>
                <div class="booking_info">
                    <p> Travel Date: {{ $date }} </p>
                    <p> <b> {{ $sightseen }} </b> </p>
                    <p> {{ $username }}</p>
                    <p> {{ $persons }} Traveler </p>
                    </br>
                </div>
            </div>
            <div class="order_detail footer">
                <p>Look forward to having you back for your other travel plans. Have fun!</p>

                <p>Cheers,</p> 
                <p>Go4sightseeing Team.</p>
                <br/>
                <p>If you have questions or concerns, please call us or email us.</p>
                <p>
                Email: <a href="mailto:support@go4sightseeing.com"><span>support@go4sightseeing.com</span></a>  W3Cebsite: <a href="https://www.go4sightseeing.com"><span>https://www.go4sightseeing.com</span></a>
                </p>
            </div>
            <div class="note">
                <p>If you have received this communication in error, please do not forward its contents; notify the sender and delete it and any attachments. This message may contain information that is confidential and legally privileged. Unless you are the addressee, you may not use, copy or disclose to anyone this message or any information contained within</p>
            </div>
            <p class="border"></p>
            <img src="{{$message->embed($attachment)}}" />
        </div>
    </div>
</body>
</html>