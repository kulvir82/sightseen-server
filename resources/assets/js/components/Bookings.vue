<template>
	<div id="bookings">
		<table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" class="listing_table" id="sortabletable">
        <tbody>
          <tr>
            <td class="form_header" align="left">
              Sr.No.
            </td>
            <td class="form_header" align="left">
              Username
            </td>
            <td class="form_header" align="left">
              Total Price (USD)
            </td>
            <td class="form_header" align="left">
              Discount
            </td>
            <td class="form_header" align="left">
              Tax Amount
            </td>
            <td class="form_header" align="left">
              Status
            </td>
            <td class="form_header" align="left">
              Payment Status
            </td>
            <td class="form_header" align="left">
              Action
            </td>
          </tr>
          <tr v-for="booking in bookings">
              <td class="form_header2"></td>
              <td class="form_header2">{{ booking.username }}</td>
              <td class="form_header2">{{ booking.total_amount }}</td>
              <td class="form_header2">{{ booking.discount_amount }}</td>
              <td class="form_header2">{{ booking.tax_amount }}</td>
              <td class="form_header2">{{ booking.status }}</td>
              <td class="form_header2">{{ booking.payment_status }}</td>
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
    props: ['data'],
		data (){
			return {
				bookings: this.data,
			}
		},
		methods: {
			getBookings (){
				this.$http.get('/bookings').then(function(response){
					this.bookings = response.data;
				});
			}
		},
		created (){
			// this.getBookings();
		}
	}
</script>

<style>
	
</style>