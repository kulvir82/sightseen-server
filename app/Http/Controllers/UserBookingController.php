<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Models\UserBooking;
use App\Models\Sightseen;
use App\Models\BookingDetail;
// use SparkPost\SparkPost;
// use GuzzleHttp\Client;
// use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {

        $bookings = UserBooking::getBookings($request);
    	
    	return response()->json($bookings);
    }

    public function getBookingDetail(Request $request)
    {
        $booking = UserBooking::where('id', $request->id)->first();
        
        $bookingDetail = new BookingDetail;
        
        $bookings = $bookingDetail->getCartItems($booking);
        
        return response()->json($bookings);
    }

    public function addVoucher(Request $request)
    {

        $bookingModel = new UserBooking;
        
        $res = $bookingModel->addVoucher($request);

        if($res['error']!='')
            return response()->json($res['error'], 500);
            
        else
            return response()->json("Voucher added successfully.", 200);
    }


    public function removeVoucher(Request $request)
    {
        BookingDetail::where('id', $request->booking_id)->update(['voucher'=> '']);
        
        return response()->json("Voucher removed successfully.", 200);
    }

    public function sendVoucherEmail(Request $request)
    {

        $bookingData = $request->booking;

        $traveler_name = $bookingData['traveler']['first_name']." ".$bookingData['traveler']['last_name'];

        $userBooking = UserBooking::where('user_bookings.id', $bookingData['booking_id'])->join('users', 'users.id', '=', 'user_bookings.userid')->select('booking_number','email')->first();

        $recipient = ['email' => $userBooking->email, 'name' => $traveler_name, 'sightseen' => $bookingData['sight_seen_name']];

        $data = [
                'username' => $traveler_name,
                'sightseen' => $bookingData['sight_seen_name'],
                'persons' => $bookingData['no_of_pax'],
                'date' => $bookingData['booking_date'],
                'booking_number' => $userBooking->booking_number,
                'attachment' => $bookingData['voucher']
            ];

        Mail::send('emails.voucher', $data, function ($message) use($recipient) {
            $message
              ->from('support@go4sightseeing.com', 'Go4SightSeeing')
              ->to($recipient['email'], $recipient['name'])
              ->subject('Voucher Email Confirmation for '.$recipient['sightseen']);
        });
    }    

    public function updateBooking(Request $request)
    {
        UserBooking::where('id', $request->booking_id)->update(['status'=>$request->status]);
        

        return response()->json("Successfully updated");
    }

    // public function sendVoucherEmail(Request $request)
    // {

    //     $httpClient = new GuzzleAdapter(new Client());
        
    //     $sparky = new SparkPost($httpClient, ['key'=>env('SPARKPOST_SECRET')]);
        

    //     $bookingData = $request->booking;

    //     $traveler_name = $bookingData['traveler']['first_name']." ".$bookingData['traveler']['last_name'];

    //     $userBooking = UserBooking::where('user_bookings.id', $bookingData['booking_id'])->join('users', 'users.id', '=', 'user_bookings.userid')->select('booking_number','email')->first();
        
    //     $fileName = explode("/", $bookingData['voucher']);

    //     $fileName = end($fileName);

    //     $fileData = base64_encode(file_get_contents($bookingData['voucher']));
        
    //     $promise = $sparky->transmissions->post([
    //         'content' => [
    //             'template_id' => 'voucher',
    //             'from' => [
    //                 'name' => 'Go4SightSeeing Team',
    //                 'email' => 'from@sparkpostbox.com',
    //             ],
    //             'subject' => 'Booking Voucher Email Confirmation',
    //             'attachments' => [
    //                 [
    //                     'name' => $fileName,
    //                     'type' => 'image/png',
    //                     'data' => $fileData,
    //                 ],
    //             ],
    //         ],
    //         'substitution_data' => [
    //             'username' => $traveler_name,
    //             'sightseen' => $bookingData['sight_seen_name'],
    //             'persons' => $bookingData['no_of_pax'],
    //             'date' => $bookingData['booking_date'],
    //             'booking_number' => $userBooking->booking_number
    //         ],
    //         'recipients' => [
    //             [
    //                 'address' => [
    //                     'name' => $traveler_name,
    //                     'email' => $userBooking->email,
    //                 ],
    //             ],
    //         ],
    //     ]);

    //     try {
    //         $response = $promise->wait();
    //         return response()->json($response->getBody());
    //     } catch (\Exception $e) {
    //         return response()->json($e->getMessage());
    //     }

    // }

}
