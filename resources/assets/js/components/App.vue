<template lang="html">
  <div id="app">
    <navigation></navigation>
    <div class="sight_seen_view">
      <!-- <router-view ></router-view> -->
      <component :is="currentView" :data="data"></component>
    </div>
  </div>
</template>

<script>
import SightSeen from './SightSeen.vue';
import AddSightSeen from './AddSightSeen.vue';
import EditSightSeen from './EditSightSeen.vue';
import SingleSight from './SingleSight.vue';
import Bookings from './Bookings.vue';
export default {
    name: 'app',
    components: {
      sightseen: SightSeen,
      addsightseen: AddSightSeen,
      editsightseen: EditSightSeen,
      singlesight: SingleSight,
      bookings: Bookings
    },
    data:function() {
      return {
        data: null,
			  currentView: null
      }
    },
    mounted:function() {
        bus.$on('open-view',function(result){
    			// $(".loading_div").show();
    			if(result[3]=='get'){
    				if (result[1]=='') {
              this.currentView = result[0];
    				}
            else {
              this.$http.get(result[1]+result[2]).then(function(response){
      					// $(".loading_div").hide();
      					this.data = response.data;
      					this.currentView = result[0];
      				});
            }
    			}
    			else{
    				this.$http.post(result[1],{id: result[2]}).then(function(response){
    					// $(".loading_div").hide();
    					this.data = response.data;
    					this.currentView = result[0];
    				});
    			}

    			localStorage.setItem("lastcomponent", JSON.stringify(result));
    		}.bind(this));
        setTimeout(function(){
			     if(localStorage.getItem('lastcomponent')){
  			       let storage_data = JSON.parse(localStorage.getItem('lastcomponent'));
  			       if(storage_data.length > 0){
  				         bus.$emit('open-view', storage_data);
  			       }
  		     }
		    },50);
    }
}
</script>

<style lang="css">
</style>
