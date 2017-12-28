<template>
	<div id="bookings">
    <table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px" class="input_table_new">
      <tr>
        <td align="left" width="60%">
           <select name="country" id="country" v-model="country" class="country_list" @change="getCities(country)">
              <option value="">Select Country</option>
              <option v-for="country in countries" :value="country.id">{{country.country_name}}</option>
           </select>
           <select id="city" name="city" v-model="city">
             <option value="">Select City</option>
             <option v-for="city in cities" :value="city.id">{{ city.city_name}}</option>
           </select>
           <select id="booking_status" v-model="selected_status">
            <option value="">Select Status</option>
            <option v-for="status in ['Pending','Confirmed','Canceled']" :value="status">{{ status }}</option>
           </select>
          <input type="submit" name="report_search"  class="travel_buttons1" @click="searchBookings()" autocomplete="off">
       </td>
       <td align="left" width="20%"><a class="travel_buttons" href="javascript:;" @click="refreshBookings()">All Records</a></td>
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
              <td class="form_header2">
                <select @change="changeBookingStatus(booking.id, $event)">
                  <option v-for="status in ['Confirmed','Canceled','Pending']" :selected="status==booking.status">{{ status}}</option>
                </select>
              </td>
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
  import { mixin } from "../mixins/mixin"
	export default{
    props: ['data'],
    mixins: [mixin],
		data (){
			return {
				bookings: [],
        pagination:{
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
        isFilter: false
			}
		},
		methods: {
      searchBookings ()
      {
        this.isFilter = true;
        this.getBookings();
      },
			getBookings (){
        let query = '';
        if(this.isFilter)
          query = "&country="+this.country+"&city="+this.city+"&status="+this.selected_status;

				this.$http.get('/bookings?page='+this.pagination.current_page+query).then(function(response){
					this.bookings = response.data.data;
          this.pagination = response.data;
				});
        this.setPageState(this.pagination.current_page);
        localStorage.setItem("lastcomponent", JSON.stringify(['bookings','/bookings?page='+this.pagination.current_page+query,"",'get']));
			},
      redirectToBookingDetail (booking_id){
        this.setPageState(this.pagination.current_page);
        var view  = ['bookingdetail','/getbookingdetail/'+booking_id,'','get'];
        bus.$emit('open-view',view);
      },
      changeBookingStatus(booking_id, e){
        var form_data = new FormData();
        form_data.append('status', e.srcElement.value);
        form_data.append('booking_id', booking_id);
        this.$http.post('/updatebooking',form_data).then(response => {
          alert(response.data);
        });
      },
      refreshBookings () {
        this.pagination.current_page = 1;
        this.country = '';
        this.city = '';
        this.isFilter = false;
        this.getBookings();
      },
		},
    filters: {
      indexCount (index, page) {
        let count = (page - 1) * 10
        return index + count + 1
      }
    },
		created (){
			this.bookings= this.data.data;
      this.pagination = this.data;
     
      if(localStorage.getItem('pagestate')){
        let storage_data = JSON.parse(localStorage.getItem('pagestate'));
        if(storage_data.length > 0){
          this.country = storage_data[1];
          this.city = storage_data[2];
          this.selected_status = storage_data[3];
        }
      }
		}
	}
</script>

<style>
	
</style>