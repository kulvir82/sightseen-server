<template lang="html">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="my_nav">
          <li><a href="javascript:;" @click="redirectToSightseen()">Sight Seen</a></li>
          <li><a href="javascript:;" @click="redirectToAddSightseen()">Add Sightseen</a></li>
          <li><a href="javascript:;" @click="">Records</a></li>
          <li><a href="javascript:;" @click="">Bookings</a></li>
          <li><a href="logout">Logout</a></li>
        </ul>
      </div>
    </nav>
</template>

<script>
export default {

  methods:{
    redirectToSightseen: function(){
      // this.$router.push({ name: 'sightseen' });
      var view  = ['sightseen','/getsightseen?page=',1,'get'];
      bus.$emit('open-view',view);
    },
    redirectToAddSightseen: function(){
      // this.$router.push({ name: 'addsightseen'});
      var view  = ['addsightseen','','','get'];
      bus.$emit('open-view',view);
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
      background-color: #4CAF50;
  }
</style>
