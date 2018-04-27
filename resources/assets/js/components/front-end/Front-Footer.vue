<template lang="html">
  <footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <router-link class="nav-link js-scroll-trigger" to="/about-us" >About Us</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link js-scroll-trigger" to="contact-us">Contact Us</router-link>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-4">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link class="nav-link js-scroll-trigger" to="/terms-conditions">Terms & Conditions</router-link>
                  </li>
                  <li class="nav-item">
                    <router-link class="nav-link js-scroll-trigger" to="/support">Support</router-link>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-4">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link class="nav-link js-scroll-trigger" to="/privacy-policy">Privacy Policy</router-link>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <p>&copy; 2017 go4sightseeing.com. All Rights Reserved.</p>
          <ul class="list-inline">
            <li class="list-inline-item">
              <router-link to="/support">Support</router-link>
            </li>
            <li class="list-inline-item">
             <router-link to="terms-conditions">Terms & Conditions</router-link>
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
    
  }

}
</script>

<style lang="css">
</style>
