<template lang="html">
  <div id="usersdetail">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px" class="input_table_new">
      <tr>
        <td id="listpage_button_bar" width="100%" colspan="3">
          <table align="left" height="60" width="100%" border="0" >
            <tr>
            <td align="left"><span id="pageTitle">Users</span></td>
              <td>
                <div class="searchbox">
                  <div class="searchInner">
                    <input type="text" name="search" class="searchInput" v-model="search">
                    <button class="travel_buttons" type="button" name="searchButton" v-on:click="searchUser()">Search</button>
                  </div>
                </div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
		<table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" class="user_listing_table padding-top-xl" id="sortabletable">
        <tbody>
          <tr>
            <td class="form_header" align="left">
              User Name
            </td>
            <td class="form_header" align="left">
              Email
            </td>
            <td class="form_header" align="left">
              Phone No
            </td>
            <td class="form_header" align="left">
              Registered On
            </td>
            <td class="form_header" align="left">
              No of Bookings
            </td>
          </tr>
          <tr v-for="detail in details">
              <td class="form_header2">{{ detail.username }}</td>
              <td class="form_header2">{{ detail.email }}</td>
              <td class="form_header2">{{ detail.phone_number }}</td>
              <td class="form_header2">{{ detail.registerd_on }}</td>
              <td class="form_header2">{{ detail.number_of_bookings }}</td>
          </tr>
          <!-- <tr v-show="records">
            No Record
          </tr> -->
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

data(){
  return{
      details:[],
      pagination:{},
      records: false,
      search:null
  }
},
methods:{
  getUsersDetail(){
    this.$http.get('/usersdetail').then(function(response){
      this.details = response.data.data;
      this.pagination = response.data
      console.log(response);
    });
  },
  searchUser(){
    console.log(this.search);
    this.$http.post('/searchuserdetail?search='+this.search).then(function(response){
      console.log(response);
      this.details = response.data.data;
      // this.pagination = response.data;
    });
  }
},
created(){
  this.getUsersDetail();
}

}
</script>

<style lang="css">
</style>
