<template>
	<div id="bookings">
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
          <tr v-for="">
              <td class="form_header2"></td>
              <td class="form_header2"></td>
              <td class="form_header2"></td>
              <td class="form_header2"></td>
              <td class="form_header2">
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <a  title="View" href="javascript:;" v-on:click="">View</a>
              </td>
          </tr>
        </tbody>
      </table>
	</div>	
</template>

<script>
	export default{
		data (){
			return {
				bookings: [],
			}
		},
		methods: {
			getBookings (){
				this.$http.get('/bookings').then(function(response){
					console.log(response.data);
					this.bookings = response.data;
				});
			}
		},
		created (){
			this.getBookings();
		}
	}
</script>

<style>
	
</style>