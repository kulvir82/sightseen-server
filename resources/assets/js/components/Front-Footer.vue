<template lang="html">
  <footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#aboutus" v-on:click="redirectToAboutUs()" >About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contactus" v-on:click="redirectToContactUs()">Contact Us</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-4">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#termsconditions" v-on:click="redirectToTermsConditions()">Terms & Conditions</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#support"  v-on:click="redirectToSupport()">Support</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-4">

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <p>&copy; 2017 bookmysightseen.com. All Rights Reserved.</p>
          <ul class="list-inline">
            <li class="list-inline-item">
              <a href="#">Support</a>
            </li>
            <li class="list-inline-item">
             <a v-on:click="redirectToTermsConditions">Terms & Conditions</a>
            </li>
           </ul>
        </div>
        <div class="col-lg-4 row powered_by">
          <div class="col-sm-6">
          <h4>Powered By</h4>
          </div>
          <div class="col-sm-6">
            <img :src="'/images/frontimages/maplelabslogo.png'"/>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {

  data:function(){
    return{

    }
  },
  methods:{
    redirectToAboutUs:function(){
      this.$router.push({ name: 'aboutus'});
    },
    redirectToContactUs:function(){
      this.$router.push({ name: 'contactus'});
    },
    redirectToTermsConditions:function(){
      this.$router.push({ name: 'termsconditions'});
    },
    redirectToSupport:function(){
      this.$router.push({ name: 'support'});
    },
  }

}
</script>

<style lang="css">
</style>
