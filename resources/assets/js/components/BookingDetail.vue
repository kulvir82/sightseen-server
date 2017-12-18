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
            <td class="form_header" align="left">
              Voucher
            </td>
          </tr>
          <tr v-for="(booking,index) in bookings">
              <td class="form_header2">{{ booking.sight_seen_name }}</td>
              <td class="form_header2">{{ booking.no_of_pax }}</td>
              <td class="form_header2">{{ booking.cost_per_person }}</td>
              <td class="form_header2">{{ booking.discount }}</td>
              <td class="form_header2">{{ booking.total }}</td>
              <td class="form_header2">{{ booking.booking_time }}</td>
              <td class="form_header2">{{ booking.location }}</td>
              <td class="form_header2">
                <template v-if="booking.voucher">  
                  <img :src="booking.voucher" width="100" height="50"/>
                  <span>
                    <input class="voucher_file" type="file" name="file" id="file" @change="addVoucher(index, booking.id, $event)">
                    Edit
                  </span>
                </template>
                <template v-else>
                  <input class="voucher_file" type="file" name="file" id="file" @change="addVoucher(index, booking.id, $event)">
                  Add
                </template>
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
				bookings: [],
			}
		},
		methods: {
      redirectToBookings (){
        var view  = ['bookings','/bookings','','get'];
        bus.$emit('open-view',view);
      },
      addVoucher (index, id, e){
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        
        var image = new Image();
        var reader = new FileReader();
        var vm = this;

        reader.onload = (e) => {
          vm.bookings[index].voucher = e.target.result;
        };
        reader.readAsDataURL(files[0]);

        var form_data = new FormData();
        form_data.append('file', files[0]);
        form_data.append('booking_id', id);
        this.$http.post('/addvoucher',form_data).then(function (response){
          // alert(response.data);
        },
        function (error){
          alert(response.data);
          vm.bookings[index].voucher = '';
        });
      }
		},
		created (){
			this.bookings = this.data;
		}
	}
</script>

<style>
	.voucher_file{
    position: absolute;
    bottom: 0;
    width:50px;
    opacity: 0;
  }
  td.form_header2{
    position: relative;
  }
</style>