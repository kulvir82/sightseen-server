<template lang="html">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><a href="javascript:;" v-on:click="redirectToSightseen()">Sight Seen</a></li>
          <li><a href="logout" >Logout</a></li>
          <li><a href="javascript:;" v-on:click="redirectToAddSightseen()">Add Sightseen</a></li>
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
</style>
