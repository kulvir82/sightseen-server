<template lang="html">
  <div class="frontview">
    <header class="masthead masthead-bg">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-8 my-auto">
            <div class="header-content mx-auto">
            <h1 class="mb-5"><span class="sighttitle">Go4</span><span class="sighttitlecont">SightSeeing</span> is fast and fun way to explore and book unique Sight Seen, Shows, Activities and Experiences at the Lowest Prices Guaranteed.</h1>
            </div>
          </div>
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/dashboardiphone6.jpg'" class="img-fluid" alt="">
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 text-center">
            <h2 class="heading">Explore Sight Seeing Here</h2>
            <h1>👇🏽</h1>
          </div>
        </div>
      </div>
    </header>

    <section class="booking destination-background ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="section-heading ">Select Your Destination</h2>
          </div>
          <div class="col-md-12 text-center">

          </div>
          <div class="col-md-8 mx-auto ">
            <div class="row" v-if="popularSightSeens">
              <div class="col-sm-12 text-center">
                <div class="top-destinations">
                  <h3>Choose From Top Destinations</h3>
                </div>
              </div>
              <div v-for="sightseen in popularSightSeens" class="col-sm-5 col-xs-12 popularsightseen" :style="{ 'background-image': 'url(' + sightseen.image1 + ')' }">
                <!-- <div class="sightimage">
                  <img class="img-fluid" src="https://bookmysightseen.s3.ap-southeast-1.amazonaws.com/sightseenimages/gallery2.jpg">
                </div> -->
                <span class="popularsightlink">
                  <router-link :to="{ name: 'frontsightseenlist', params: { country: countries.thailand } }">
                    <div class="sightseeninfo_wrap">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="sightseen_name">
                            <strong class="h6 ">{{ sightseen.title }}</strong>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="text-left">
                            <strong class="h6 ">{{ sightseen.price }} Per Person</strong>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="text-right">
                            <strong class="h6 ">{{ sightseen.country_name }}</strong>
                          </div>
                        </div>
                      </div>
                    </div>
                  </router-link>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-4 mx-auto">
            <div class="row" v-if="countries.thailand">
              <div class="col-sm-12 text-center">
                <div class="select-counteries">
                  <h3>Choose From Countries</h3>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 text-center ">
                  <div class="top_countries">
                    <router-link class="badge-link" :to="{ name: 'frontsightseenlist', params: { country: (countries.thailand) } }"><img class="img-fluid" :src="'images/frontimages/thailand3x.png'" alt=""></router-link>
                  </div>
                  <div class="top_countries">
                    <router-link class="badge-link" :to="{ name: 'frontsightseenlist', params: { country: (countries.singapore) } }"><img class="img-fluid" :src="'images/frontimages/singapore3x.png'" alt=""></router-link>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 text-center">
                  <div class="top_countries">
                    <router-link class="badge-link" :to="{ name: 'frontsightseenlist', params: { country: (countries.dubai) } }" ><img class="img-fluid" :src="'images/frontimages/dubai3x.png'" alt=""></router-link>
                  </div>
                  <div class="top_countries">
                    <router-link class="badge-link " :to="{ name: 'frontsightseenlist', params: { country: (countries.malaysia) } }"><img class="img-fluid" :src="'images/frontimages/malaysia3x.png'" alt=""></router-link>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <section class="download bg-primary text-center" id="download">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 class="section-heading">Discover what all the buzz is about!</h2>
            <p>Our app is available on any mobile device! Download now to get started!</p>
            <div class="badges">
              <a class="badge-link" href="#"><img src="{{asset("images/frontimages/google-play-badge.svg")}}" alt=""></a>
              <a class="badge-link" href="#"><img src="{{asset("images/frontimages/app-store-badge.svg")}}" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <section class="features" id="features">
      <div class="container">
        <div class="headingcolor text-center">
          <h2>Book your favourite Sight Seeing or Show with just CLICK of a Button!</h2>
          <p class="text-muted"></p>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white s8bannerimg " style="padding-bottom: 0;">
                <!-- <div class="device">
                  <div class="screen"> -->
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/BmssBannerAndroid.jpg'" class="img-fluid" alt="BmssBannerAndroid.jpg"></a>
                  <!-- </div>
                  <div class="button">
                    You can hook the "home button" to some JavaScript events or just remove it
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="container-fluid">
              <div class="row">
                <div class="get_app_text">
                  <h1>Download <span class="sighttitle">Go4</span><span class="sighttitlecont">SightSeeing</span> now</h1>
                  <h1>on</h1>
                  <h1>IOS and Android Phone.</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <a href="https://play.google.com/store/apps/details?id=maple.com.go4ss.citydiscovery&hl=en" target="_blank">
                      <img :src="'images/frontimages/android_download.png'" alt="android_download.png"/>
                    </a>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <a href="https://itunes.apple.com/us/app/go4sightseeing/id1327255721?ls=1&mt=8" target="_blank">
                      <img :src="'images/frontimages/ios_download.png'" alt="ios_download.png"/>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <img :src="'images/frontimages/banner-startbooking_bg.jpg'" alt="ios_download.png"/>
       <div class="container">
         <div class="row justify-content-start">
           <div class=" col-md-6 cta-content">
            <div class="cta_text_stop padding-top-lg">
              Stop Waiting...
            </div>
            <div class="cta_text_start">
              Start Booking!
            </div>
          </div>
         </div>
       </div>
      <!-- <div class="overlay">
        <img :src="'images/frontimages/banner-startbooking.png'" alt="ios_download.png"/>
      </div> -->
    </section>

    <section class="contact bg-primary" id="contact">
      <div class="container">
        <h2>We
          <i class="fa fa-heart"></i>
          new friends!</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="https://twitter.com/Go4SightSeeing">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="https://www.facebook.com/Go4SightSeeing/">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item social-google-plus">
            <a href="https://plus.google.com/104221511420505410319">
              <i class="fa fa-google-plus"></i>
            </a>
          </li>
        </ul>
      </div>
    </section>
  </div>
</template>

<script>

export default {
  data:function(){
    return{
      popularSightSeens: null,
      countries: {
        'malaysia' : null,
        'singapore' : null,
        'thailand' : null,
        'dubai' : null,
      },
      tweets:null
    }
  },
  created (){
    this.getPopularSightSeen();
    this.getcountries();
  },
  methods:{
    getTweets(){
      this.$http.get('/userTimeline').then(function(response){
        this.tweets = response.data;
      });
    },
    getcountries () {
      this.$http.get('/getcountries').then(function(response){
        this.countries.malaysia  = response.data[0].id;
        this.countries.singapore  = response.data[1].id;
        this.countries.thailand  = response.data[2].id;
        this.countries.dubai  = response.data[3].id;
      });
    },
    getPopularSightSeen (){
      this.$http.get("/getPopularSightSeen").then(function(response){
        this.popularSightSeens = response.data;
      });
    }
  },
  mounted:function(){
    //this.getTweets();
  }
}
</script>

<style lang="css">
  section{
    padding: 50px 0  !important;
  }
  section.features .section-heading
  {
    margin-bottom: 0px !important;
  }
  .destination-background{
    background: #F9F0EC;
  }
  header.masthead .header-content{
    max-width: 100%;
  }
  .masthead-bg{
   background-image:url("/images/frontimages/top-banner-bg.png") !important;
  }
  .get_app_text{
    text-align: center;
    margin-top: 20px;
    width: 100%;
  }
  .get_app_text h1{
    color: #f00;
  }
  .section-heading h2{
    color: #f5c109;
  }
  .device-mockup.iphone6_plus > .device > .screen,
  .device-mockup.iphone6_plus.portrait > .device > .screen {
    top: 11% !important;
    bottom: 11% !important;
    left: 5.97%;
    right: 5.97%;
  }
  .feature-item{
    padding-top: 70px   !important;
  }
  section.cta .cta-content{
    font-size: 3vw !important;
    position: absolute !important;
    top: 10%;
    left: 10%;
    color: #fff;
    letter-spacing: 2px;
  }
  section.cta .cta-content .cta_text_start{
    padding-top: 2%;
    padding-left: 6%;
  }
  section.cta{
    padding: 0  !important;
    background-image: none !important;
  }
  section.cta img{
    width: 100%;
  }
  .popularsightseen{
    height: 200px;
    margin-bottom: .5rem;
    margin-right: 1%;
    margin-left:  6%;
    background-size: cover;
    background-position: center;
  }
  .sightseeninfo_wrap{
    background: rgba(0,0,0,0.5);
    color: #fff;
    width: 100%;
    position: absolute;
    bottom: 0;
    padding: 1rem;
    right:0;
  }
  .top_countries{
    margin-bottom: 1rem;
  }
  .s8bannerimg{
    text-align: center;
  }
  .s8bannerimg img{
    max-width:270px;
  }
  .tweets img{
    border-radius: 10px;
    height: 130px;
  }
  .popularsightlink{
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left: 0;
    z-index: 1;
  }
  .tweet_text p{
    font-size: 30px;
  }
</style>
