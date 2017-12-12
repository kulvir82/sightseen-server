<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Thujohn\Twitter\Facades\Twitter;
class TwitterController extends Controller
{
  public function getTweets()
  {
    $tweets = Twitter::getUserTimeline(['screen_name' => 'BookmySeen', 'count' => 4, 'format' => 'json']);
    return $tweets;
  }
}
