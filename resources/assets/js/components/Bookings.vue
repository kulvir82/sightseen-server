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
          <tr v-for="(booking, index) in bookings">
              <td class="form_header2">{{ index | indexCount(pagination.current_page) }}</td>
              <td class="form_header2">{{ booking.user.username }}</td>
              <td class="form_header2">{{ booking.total_sale_amount }}</td>
              <td class="form_header2">{{ booking.totaldiscount }}</td>
              <td class="form_header2">{{ booking.tax_amount }}</td>
              <td class="form_header2">{{ booking.status }}</td>
              <td class="form_header2">{{ booking.payment_status }}</td>
              <td class="form_header2">
                 <a title="View" href="javascript:void(0)" @click="redirectToBookingDetail(booking.id)">View</a>
              </td>
          </tr>
        </tbody>
      </table>
      <div class="paginationstyle" id="gallerypaginate" >
        <vue-pagination
            :pagination="pagination"
            @paginate="getBookings()"
            :offset="4">
        </vue-pagination>
      </div>
	</div>	
</template>

<script>
	export default{
    props: ['data'],
		data (){
			return {
				bookings: null,
        pagination:{
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
			}
		},
		methods: {
			getBookings (){
				this.$http.get('/bookings?page='+this.pagination.current_page).then(function(response){
					this.bookings = response.data;
          this.pagination = response.data;
				});
			},
      redirectToBookingDetail (booking_id){
        var view  = ['bookingdetail','/getbookingdetail/'+booking_id,'','get'];
        bus.$emit('open-view',view);
      }
		},
    filters: {
      indexCount (index, page) {
        let count = (page - 1) * 10
        return index + count + 1
      }
    },
		created (){
      // console.log(this.data);
			this.bookings= this.data.data;
      this.pagination = this.data;
		}
	}
</script>

<style>
	
</style>