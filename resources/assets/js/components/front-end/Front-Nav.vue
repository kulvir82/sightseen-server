<template>
  <nav v-else class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <router-link class="navbar-brand js-scroll-trigger" to="/">
        <img :src="'/images/frontimages/Go4ss_logo.png'" />
      </router-link>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto" v-if="countries.thailand">
          <li class="nav-item">
            <router-link class="nav-link js-scroll-trigger" :to="{ name: 'frontsightseenlist', params: { country: countries.thailand } }" >SightSeens</router-link>
          </li>
          <li class="nav-item">
              <router-link class="nav-link js-scroll-trigger" to="/contact-us">Contact Us</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link js-scroll-trigger" to="/about-us">About Us</router-link>
            </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>

export default {
  data:function(){
    return{
      countries: {
        'malaysia' : null,
        'singapore' : null,
        'thailand' : null,
        'dubai' : null,
      },
    }

  },
  created ()
  {
    this.getcountries ()
  },
  methods:{
    getcountries () {
      this.$http.get('/getcountries').then(function(response){
        this.countries.malaysia  = response.data[0].id;
        this.countries.singapore  = response.data[1].id;
        this.countries.thailand  = response.data[2].id;
        this.countries.dubai  = response.data[3].id;
      });
    }
  },
  mounted:function(){
  }     
}
</script>

<style lang="css">
#mainNav{
  background: rgba(0,0,0,0.8);
}
#mainNav.navbar-shrink {
    border-color: rgba(34,34,34,.1) !important;
    background-color: #000 !important;
}
ul.ml-auto li a{
  color: #fff !important;
}
.bg-header{
  background-color: #E8E8E8 !important;
  padding: 0 0 !important;
}

.bg-header a{
  color: rgba(255, 0, 0, 1.0) !important;
}
.onetimepwd{
  display: none;
}
.conti-btn{
  display: none;
}
.otpheading{
  display: none;
}
.heading-color{
  color: #CFB53B;
  margin: 15px;
}
.heading-image img{
  width:60px;
}
.scroll-class {
  height:60vh;
  overflow-y: scroll;
}
</style>
