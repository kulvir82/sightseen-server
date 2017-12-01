<template lang="html">
  <div class="">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-8 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">BookMySightSeen is fast and fun way to explore and book unique Sight Seen, Shows, Activities and Experiences at the Lowest Prices Guaranteed.</h1>
            </div>
          </div>
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/dashboard_banner.jpg'" class="img-fluid" alt="">
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 text-center">
            <h2 class="heading">Explore Sight Seen Here</h2>
            <h1>👇🏽</h1>
          </div>
        </div>
      </div>
    </header>

    <section class="booking destination-background ">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="section-heading ">Select Your Destination</h2>
          </div>
          <div class="col-md-12 text-center">

          </div>
          <div class="col-md-6 mx-auto ">
            <div class="row">
              <div class="col-sm-12 text-center">
                <div class="top-destinations">
                  <h3>Choose From Top Destinations</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mx-auto">
            <div class="row">
              <div class="col-sm-12 text-center">
                <div class="select-counteries">
                  <h3>Choose From Countries</h3>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 text-center ">
                  <div class="">
                    <a class="badge-link" v-on:click="redirectToCountrySights(thailand)"><img class="img-fluid" :src="'images/frontimages/thailand3x.png'" alt=""></a>
                  </div>
                  <div class="">
                    <a class="badge-link" v-on:click="redirectToCountrySights(singapore)"><img class="img-fluid" :src="'images/frontimages/singapore3x.png'" alt=""></a>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 text-center">
                  <div class="">
                    <a class="badge-link" v-on:click="redirectToCountrySights(dubai)" ><img class="img-fluid" :src="'images/frontimages/dubai3x.png'" alt=""></a>
                  </div>
                  <div class="">
                    <a class="badge-link " v-on:click="redirectToCountrySights(malaysia)"><img class="img-fluid" :src="'images/frontimages/malaysia3x.png'" alt=""></a>
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
        <div class="section-heading text-center">
          <h2>Book your favourite Sight Seen or Show with just CLICK of a Button!</h2>
          <p class="text-muted"></p>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white" style="padding-bottom: 0;margin-left: 60px;">
                <!-- <div class="device">
                  <div class="screen"> -->
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/BmssBannerAndroid.png'" class="img-fluid" alt="BmssBannerAndroid.png">
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
                  <h1>Download BookMySightSeen now</h1>
                  <h1>on</h1>
                  <h1>IOS and Android Phone.</h1>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <img :src="'images/frontimages/android_download.png'" alt="android_download.png"/>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <img :src="'images/frontimages/ios_download.png'" alt="ios_download.png"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>Stop waiting.<br>Start booking.</h2>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact bg-primary" id="contact">
      <div class="container">
        <h2>We
          <i class="fa fa-heart"></i>
          new friends!</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="https://twitter.com/BookmySeen">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="https://www.facebook.com/Bookmysightseen-2022848227997448/
">
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
      thailand:{ 'code':313,'img':'thailand3x.png'},
      malaysia:{ 'code':173,'img':'malaysia3x.png'},
      singapore:{ 'code':430,'img':'singapore3x.png'},
      dubai:{ 'code2':43,'img':'dubai3x.png'}
    }
  },
  methods:{
    redirectToCountrySights:function(country) {
    this.$router.push({ name: 'frontsightseenlist', params: { country: country }});
    },
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
    background: #d3d3d3;
  }
  header.masthead .header-content{
    max-width: 100%;
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
  section.cta .cta-content h2{
    font-size: 50px !important;
  }
  section.cta{
    padding: 250px 0  !important;
  }
</style>
