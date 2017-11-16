<template lang="html">
  <div id="frontapp">
    <frontnav></frontnav>
    <div class="front">
      <router-view ></router-view>
    </div>
    <frontfooter></frontfooter>
  </div>
</template>

<script>
export default {
  methods:{
    redirectToFrontView: function(){
      this.$router.push({ name: 'frontview' });
      // var view  = ['sightseen','/getsightseen?page=',1,'get'];
      // bus.$emit('open-view',view);
    }
  },
  mounted:function(){
    this.redirectToFrontView();
  }
}
</script>

<style lang="css">
</style>
