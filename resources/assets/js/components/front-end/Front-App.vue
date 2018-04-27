<template lang="html">
  <div id="frontapp">
    <front-nav></front-nav>
    <div class="front">
      <router-view></router-view>
    </div>
    <front-footer></front-footer>
  </div>
</template>

<script>
import FrontNav from './Front-Nav.vue';
import FrontFooter from './Front-Footer.vue';
export default {
  components: {
    FrontNav,
    FrontFooter
  },
  methods:{
  
  },
  mounted:function(){
    
  }
}
</script>

<style lang="css">
</style>
