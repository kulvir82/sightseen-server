<template lang="html">
  <div class="">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">New Age is an app landing page that will help you beautifully showcase your new mobile app, or anything else!</h1>
              <a href="#download" class="btn btn-outline btn-xl js-scroll-trigger">Start Now for Free!</a>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/demo-screen-1.jpg'" class="img-fluid" alt="">
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 text-center">
            <h2 class="heading">Book Sight Seen Here</h2>
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
          <h2>Unlimited Features, Unlimited Fun</h2>
          <p class="text-muted">Check out what you can do with this app theme!</p>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img :src="'images/frontimages/demo-screen-1.jpg'" class="img-fluid" alt="">
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 my-auto">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-screen-smartphone text-primary"></i>
                    <h3>Device Mockups</h3>
                    <p class="text-muted">Ready to use HTML/CSS device mockups, no Photoshop required!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-camera text-primary"></i>
                    <h3>Flexible Use</h3>
                    <p class="text-muted">Put an image, video, animation, or anything else in the screen!</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-present text-primary"></i>
                    <h3>Free to Use</h3>
                    <p class="text-muted">As always, this theme is free to download and use for any purpose!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-lock-open text-primary"></i>
                    <h3>Open Source</h3>
                    <p class="text-muted">Since this theme is MIT licensed, you can use it commercially!</p>
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
          <h2>Stop waiting.<br>Start building.</h2>
          <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger">Let's Get Started!</a>
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
            <a href="#">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="#">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item social-google-plus">
            <a href="#">
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
.destination-background{
  background: #d3d3d3;
}
</style>
