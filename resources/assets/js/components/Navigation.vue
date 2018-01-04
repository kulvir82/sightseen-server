<template lang="html">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="my_nav">
          <li><a href="javascript:void(0)" @click="redirectToSightseen($event)">Sight Seen</a></li>
          <li><a href="javascript:void(0)" @click="redirectToAddSightseen($event)">Add Sightseen</a></li>
          <li><a href="javascript:void(0)" @click="">Reports</a></li>
          <!-- <router-link tag="li" to="/bookings">
            <a>Bookings</a>
          </router-link> -->
          <li><a href="javascript:void(0)" @click="redirectToBookings($event)">Bookings</a></li>
          <li><a href="javascript:void(0)" @click="redirectToSettings($event)">Settings</a></li>
          <li><a href="javascript:void(0)" @click="logout()">Logout</a></li>
        </ul>
      </div>
    </nav>
</template>

<script>
export default {

  methods:{
    redirectToSightseen (event){
      $('ul.my_nav li a').removeClass("active");
      event.target.className = "active";
      var view  = ['sightseen','/getsightseen?page=',1,'get'];
      bus.$emit('open-view',view);
      localStorage.removeItem('pagestate');
    },
    redirectToAddSightseen (event){
      $('ul.my_nav li a').removeClass("active");
      event.target.className = "active";
      var view  = ['addsightseen','','','get'];
      bus.$emit('open-view',view);
      localStorage.removeItem('pagestate');
    },
    redirectToBookings (event){
      $('ul.my_nav li a').removeClass("active");
      event.target.className = "active";
      var view  = ['bookings','/bookings','','get'];
      bus.$emit('open-view',view);
      localStorage.removeItem('pagestate');
    },
    redirectToSettings (event){
      $('ul.my_nav li a').removeClass("active");
      event.target.className = "active";
      var view  = ['settings','','','get'];
      bus.$emit('open-view',view);
      localStorage.removeItem('pagestate');
    },
    logout (){
      localStorage.clear();
      window.location.href = '/logout';
    }
  }
}
</script>

<style lang="css">
  ul.my_nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #20397f;
    font-size: 1vw;
  }

  ul.my_nav li {
      float: left;
  }
  ul.my_nav li:last-child{
    float: right;
  }

  ul.my_nav li a {
      display: block;
      color: #fff;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
  }

  .my_nav li a:hover:not(.active) {
      background-color: #375192;
  }

  ul.my_nav .active {
      background-color: #000;
  }
</style>
