<template lang="html">
  <div class="container h-100 margin-top-xl padding-top-lg">
    <div class="row h-100 padding-top-xl padding-bottom-lg">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="aboutus headingcolor">
            <h2>Some Words<strong>About Us</strong></h2>
            <p>
              <strong>Go4SightSeeing </strong>is fast and fun way to explore and book unique Sight Seen, Shows, Activities and Experiences at the Lowest Prices Guaranteed.With just a few clicks, get ready to enjoy the Siam Nimrat show no big queues to get tickets , enjoy Santosa isLand under water park and other attractions.So Just click book and go to your favourite destination.
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="aboutusimage ">
            <img class="img-fluid" :src="'/images/frontimages/about-us-img-2.jpg'" alt="">
          </div>
        </div>
    </div>
    <div class="row h-100 padding-top-xl padding-bottom-xl">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="specialaimage">
          <img class="img-fluid" :src="'/images/frontimages/about-us-img-1.jpg'" alt="">
        </div>
        <div class="specialaimage-text">
          <ul>
            <li>Book Your Favourite</li>
            <li>Show/Sightseen</li>
            <li>with</li>
            <li>Just a CLICK</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="specialcontent headingcolor">
          <h2>What is special and great about <span class="sighttitle">Go4</span>SightSeeing</h2>
          <ul>
            <li>Easy way to explore new shows , sight seen, locations which click of button you can book it. </li>
            <li>Easy cancellation no charges if cancel 48 hours before show.</li>
            <li>Lowest price guaranteed.</li>
            <li>Easy confirmation and paperless e-tickets for many popular attractions</li>
            <li>Secure and easy booking and safe payment with credit cards or debit cards.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="css">
.aboutusimage{
  max-width: 500px;
}
.aboutusimage img{
  border-radius: 5px;
}
.specialaimage{
  max-width: 500px;
  position: relative;
}
.specialaimage img{
  border-radius: 5px;
}
.specialaimage-text{
  position: absolute;
  top: 60px;
  left: 5px;
  color: #ffffff;
  text-align: center;
}
.specialaimage-text ul{
  list-style:none;
}
</style>
