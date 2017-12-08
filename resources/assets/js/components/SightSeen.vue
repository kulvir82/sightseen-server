<template lang="html">
  <div id="sightseen" v-if="sightseen">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px" class="input_table_new">
      <tr>
        <td id="listpage_button_bar" width="100%" colspan="3">
          <table align="left" height="60" width="100%" border="0" >
            <tr>
              <td align="left"><span id="pageTitle">Manage Sight Seen</span></td>
              <td>
                <!-- <div class="searchbox">
                  <div class="searchInner">
                    <input type="text" name="search" class="searchInput" value="">
                    <button type="button" name="searchButton" v-on:click="searchSight()">Sight Name</button>
                  </div>
                </div> -->
              </td>
              <td align="right"><a href="javascript:;" v-on:click="redirectToAddSightseen()" class="travel_buttons">Add Sight Seen</a></td>
            </tr>
          </table>
        </td>
      </tr>
        <tr>
          <td align="left" width="60%">
             <select name="country" id="country" class="country_list" onchange="changeCities()">
               <option value="">Select Country</option>
                <option v-for="country in countries" :value="country.id">{{country.country_name}}</option>
             </select>
             <select  id="city" name="city">
               <option value="">Select City</option>
             </select>
            <input type="submit" name="report_search"  class="travel_buttons1" v-on:click="searchSight()" autocomplete="off">
         </td>
         <td align="left" width="20%"><a class="travel_buttons" href="javascript:;" v-on:click="refreshSightSeen()">All Records</a></td>
           <td align="right" class="fontGreen">Total Records:</td>
           <td class="fontGreen">{{pagination.total}}</td>
        </tr>
    </table>
      <table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" class="listing_table" id="sortabletable">
        <tbody>
          <tr>
            <td class="form_header" align="left">
              Sr.No.
            </td>
            <td class="form_header" align="left">
              Title
            </td>
            <td class="form_header" align="left">
              Price (USD)
            </td>
            <td class="form_header" align="left" style="width: 347px;">
              Description
            </td>
            <td class="form_header" style="padding-left: 31px;width: 130px;" align="left">
              Action
            </td>
          </tr>
          <tr v-for="sight in sightseen">
              <td class="form_header2">{{sight.id }}</td>
              <td class="form_header2">{{sight.title | truncate(50)}}</td>
              <td class="form_header2">{{sight.price}}</td>
              <td class="form_header2 overflowhide" v-html="$options.filters.truncate(sight.description,70)"></td>
              <td class="form_header2">
                 <a  title="Edit"  href="javascript:;" v-on:click="redirectToEditSightseen(sight.id)">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
                 <a  title="Delete" v-on:click="deleteSightSeen(sight.id)" id="delete" href="javascript:;">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;
                 <a  title="View" href="javascript:;" v-on:click="redirectTosingleSightseen(sight.id)">View</a>
              </td>
          </tr>
        </tbody>
      </table>
      <div class="paginationstyle" id="gallerypaginate" >
        <vue-pagination
            :pagination="pagination"
            @paginate="getSightSeen(pagination.current_page)"
            :offset="4">
        </vue-pagination>
      </div>
    </div>
</template>

<script>
export default {
  name:'sightseen',
  props: ['data'],
  data: function() {
      return{
        sightseen:this.data.data,
        sightseenLinks:null,
        countries:null,
        pagination:{
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
        limit1:45,
        limit2:55
      }
  },
  methods:{
    refreshSightSeen () {
      this.getSightSeen();
      this.getcountries();
    },
    searchSight (){
      var country = $('#country').val();
      var city = $('#city').val() ? $('#city').val():false;
       this.$http.post('/searchsightseen',{country:country,city:city}).then(function(response){
        this.sightseen = response.data.data;
        this.pagination = response.data;
      });
    },
    getSightSeen () {

        this.$http.get("/getsightseen?page="+this.pagination.current_page).then(function(response){
          this.sightseen = response.data.data;
          this.pagination = response.data;
        });
        var result  = ['sightseen','/getsightseen?page=',this.pagination.current_page,'get'];
        localStorage.setItem("lastcomponent", JSON.stringify(result));
    },
    getcountries () {
      this.$http.get('/getcountries').then(function(response){
        this.countries  = response.data;
      });
    },
    deleteSightSeen (id){
      var r = confirm("Are you sure you want to delete this sight seen?");
      if (r == true) {
        this.$http.get('/deletesightseen/'+id).then(function(response){
          this.refreshSightSeen();
        });
      }
      else {
          txt = "You pressed Cancel!";
      }
    },
    redirectToAddSightseen (){
      var view  = ['addsightseen','','','get']
      bus.$emit('open-view',view)
    },
    redirectToEditSightseen (sightId){
      var view  = ['editsightseen','/editsightseen?id=',sightId,'get']
      bus.$emit('open-view',view)
    },
    redirectTosingleSightseen (sightId){
      var view  = ['singlesight','/singlesight?id=',sightId,'get']
      bus.$emit('open-view',view)
    }
  },
  filters: {
  	truncate (string, value) {
    	return string.substring(0, value);
    }
  },
  created (){
    this.getcountries();
    this.pagination = this.data;
  }
}
</script>
<style lang="css">
  .overflowhide{
    overflow: hidden;
  }
</style>
