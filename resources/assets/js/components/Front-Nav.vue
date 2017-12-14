<template>
  <nav v-else class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <router-link class="navbar-brand js-scroll-trigger" href="#page-top" :to="'/'">
      <img :src="'/images/frontimages/bmsslogo_40.png'" />
      </router-link>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#sightseen" v-on:click="redirectToCountrySights(countries.thailand)">SightSeens</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contactus" v-on:click="redirectToContactUs()">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#aboutus" v-on:click="redirectToAboutUs()" >About Us</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import Modal from './Modal.vue';

export default {
  components:{
    modal:Modal,
  },
  data:function(){
    return{
      priceforall: [],
      headerdata:null,
      login:null,
      showModal: false,
      userdata:null,
      check:true,
      cartlength:null,
      cart:null,
      cartData:null,
      val:1,
      date: '',
      grandTotal:[],
      countries: {
        'malaysia' : null,
        'singapore' : null,
        'thailand' : null,
        'dubai' : null,
      },
    }

  },
  created ()
  {
    let d = new Date();
    this.date = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
    this.getcountries ()
  },
  methods:{
    sendmessage:function(){
        var phonenumber = $('#phnum').val();
        console.log(phonenumber);
        this.$http.post('/sendsms',{phnum:phonenumber}).then(function(response){
          console.log(response);
          $('.phone').hide();
          $('.otp-btn').hide();
          $('.phoneheading').hide()
          $('.conti-btn').show();
          $('.onetimepwd').show();
          $('.otpheading').show();
      });

    },
    getcountries () {
      this.$http.get('/getcountries').then(function(response){
        this.countries.malaysia  = response.data[0].id;
        this.countries.singapore  = response.data[1].id;
        this.countries.thailand  = response.data[2].id;
        this.countries.dubai  = response.data[3].id;
      });
    },
    redirectToCountrySights(country) {
      this.$router.push({ name: 'frontsightseenlist', params: { country: country }});
    },
    redirectToAboutUs:function(){
      this.$router.push({ name: 'aboutus'});
    },
    redirectToContactUs:function(){
      this.$router.push({ name: 'contactus'});
    },

    verifypincode:function () {
        var pin = $('#pincode').val();
        this.$http.post('/verifypincode',{pin:pin}).then(function(response){
      });
    },
    getcartdata:function(){
       this.userdata = this.$cookies.get('UserToken');
       var values = this.$cookies.get(this.userdata);
       this.$http.post('/productsdata',{product_ids:values}).then(function(response){
       this.cartData = response.data;
     });
    },
    getPriceForAll:function(price,sightid,index){
      var id = "numberofpaxfor"+sightid;
      var numberofpax = $("#"+id).val();
      var totalid = "total-"+sightid;
      var value = numberofpax * price
      $("span.total" ,'#'+totalid).text(value);
      this.cartData[index].number_of_pax = numberofpax;
    },
    savebookingdate:function(sightId,index){
      var id = "date"+sightId;
      var date = $("#"+id).val();
      this.cartData[index].bookingDate = date;
      console.log(this.cartData);
    },
    checkoutCartData:function(){

      this.userdata = this.$cookies.get('UserToken');
      var values = this.$cookies.get(this.userdata);
      var arrvalues = values.split(',');

    },
    removefromcart:function(itemtoRemove){
      this.userdata = this.$cookies.get('UserToken');
      var values = this.$cookies.get(this.userdata);
      var arrvalues = values.split(',');
      values = jQuery.grep(arrvalues, function(value) {
        return value != itemtoRemove;
      });
      var updateCart = values.join(", ");
      this.$cookies.set(this.userdata,updateCart,{expires:'1M'});
      this.headerdata[1] = values.length;
      this.getcartdata();
    },
    countCartItems:function(){
      this.userdata = this.$cookies.get('UserToken');
      var values = this.$cookies.get(this.userdata);
      var arrvalues = values.split(',');
      this.cartlength = arrvalues.length;
    }
  },
  mounted:function(){
      bus.$on('change-header', function(result){
        this.headerdata = result;
      }.bind(this));
      this.countCartItems();
    }
  }
</script>

<style lang="css">
#mainNav{
  background: rgba(0,0,0,0.8);
}
#mainNav.navbar-shrink {
    border-color: rgba(34,34,34,.1) !important;
    background-color: #000 !important;
}
ul.ml-auto li a{
  color: #fff !important;
}
.bg-header{
  background-color: #E8E8E8 !important;
  padding: 0 0 !important;
}

.bg-header a{
  color: rgba(255, 0, 0, 1.0) !important;
}
.onetimepwd{
  display: none;
}
.conti-btn{
  display: none;
}
.otpheading{
  display: none;
}
.heading-color{
  color: #CFB53B;
  margin: 15px;
}
.heading-image img{
  width:60px;
}
.scroll-class {
  height:60vh;
  overflow-y: scroll;
}
</style>
