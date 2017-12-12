<template>
	<div id="bookingdetail">
    <div class="row" style="margin: 1rem 0;text-align: right;">
      <a href="javascript:;" v-on:click="redirectToBookings()" class="travel_buttons">Back</a>
    </div>
		<table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" class="listing_table" id="sortabletable">
        <tbody>
          <tr>
            <td class="form_header" align="left">
              SightSeen Name
            </td>
            <td class="form_header" align="left">
              No. of Person
            </td>
            <td class="form_header" align="left">
              Cost Per Person
            </td>
            <td class="form_header" align="left">
              Discount
            </td>
            <td class="form_header" align="left">
              Total
            </td>
            <td class="form_header" align="left">
              Booking Time
            </td>
            <td class="form_header" align="left">
              Pickup Location
            </td>
          </tr>
          <tr v-for="booking in bookings">
              <td class="form_header2">{{ booking.sight_seen_name }}</td>
              <td class="form_header2">{{ booking.no_of_pax }}</td>
              <td class="form_header2">{{ booking.cost_per_person }}</td>
              <td class="form_header2">{{ booking.discount }}</td>
              <td class="form_header2">{{ booking.total }}</td>
              <td class="form_header2">{{ booking.booking_time }}</td>
              <td class="form_header2">{{ booking.location }}</td>
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
				bookings: null,
			}
		},
		methods: {
      redirectToBookings (){
        var view  = ['bookings','/bookings','','get'];
        bus.$emit('open-view',view);
      }
		},
		created (){
			this.bookings = this.data;
		}
	}
</script>

<style>
	
</style>