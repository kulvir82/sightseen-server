<template >
  <nav v-if="headerdata" class="navbar navbar-expand-lg bg-header fixed-top" id="mainNav" >
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Maple Labs</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto heading-image">
          <li class="nav-item"><h4 class="heading-color">Explore</h4></li>
          <li class="nav-item "><div class="nav-link"><img class="img-fluid" :src="'/images/frontimages/'+headerdata[0]" alt=""></div></li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" v-on:click="">My Bookings</a>
          </li>
          <li class="nav-item">
            <!-- Modal Component -->
            <b-modal id="modal1" size="lg" >
              <div class="products" v-for="data in cartData">
                <div class="row border rounded text-center margin-sm padding-sm">
                  <div class="col-md-3 h6 padding-xs">
                    <span class="align-middle">{{data.title}}</span>
                  </div>
                  <div class="col-md-2 h6 padding-md">
                    <span class="align-middle">{{data.price}}</span>
                  </div>
                  <div class="col-md-3">
                    <div class="row padding-xs">
                      <div class="col-md-6 col-sm-6 h6 ">
                        <span class="align-middle">From</span>
                      </div>
                      <div class="col-md-6 col-sm-6 ">
                        <date-picker :date="date" :limit="limit" :option="option" ></date-picker>
                      </div>
                      </div>
                      <div class="row padding-xs">
                        <div class="col-md-6 col-sm-6 h6 ">
                          <span class="align-middle">To</span>
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                          <date-picker :date="date" :limit="limit"></date-picker>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <b-btn >Check Out</b-btn>
            </b-modal>
            <b-btn class="nav-link js-scroll-trigger" v-on:click="getcartdata(headerdata[2])" v-b-modal.modal1><span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span><span v-if="headerdata[1]" >{{ headerdata[1] }}</span></b-btn>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a v-if="login"class="nav-link js-scroll-trigger" v-on:click="">Logout</a>
            <a v-else class="nav-link js-scroll-trigger" id="show-modal" @click="showModal = true">Login</a>
          </li>
        </ul>
      </div>
    </div>
  <!-- use the modal component, pass in the prop -->
  <modal v-if="showModal" @close="showModal = false">
    <!--
      you can use custom content here to overwrite
      default content
    -->
    <div slot="header">
      <div class="phoneheading">
        <h6>Please Enter Your Phone Number</h6>
      </div>
      <div class="otpheading">
        <h6>Please Enter OTP</h6>
      </div>
    </div>
    <div slot="body">
      <div class="phone">
        <input type="number" name="PhoneNumber" id="phnum">
      </div>
      <div class="onetimepwd">
        <input type="number" name="onetimepassword" id="pincode" max="4">
      </div>
      <div class="btn otp-btn">
        <button type="button" v-on:click="sendmessage()"  name="login">Send OTP</button>
      </div>
      <div class="btn conti-btn">
        <button type="button" v-on:click="verifypincode()" name="register">Continue</button>
      </div>
    </div>
  </modal>
  </nav>

  <nav v-else class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Maple Labs</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#download">Download</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#features">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="right">
      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">Admin</button>
    </div>
  </nav>
</template>
<script>
import Modal from './Modal.vue';
import myDatepicker from 'vue-datepicker'

export default {
  components:{
    modal:Modal,
    'date-picker': myDatepicker
  },
  data:function(){
    return{
      headerdata:null,
      login:null,
      showModal: false,
      userdata:null,
      check:true,
      cart:null,
      cartData:null,

      date: {
        time: '' // string
      },
      limit:[
        type =>'fromto',
        from =>'',
        to => ''
      ],
    }

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
    verifypincode:function () {
        var pin = $('#pincode').val();
        this.$http.post('/verifypincode',{pin:pin}).then(function(response){
      });
    },
    getcartdata:function(){
       this.userdata = this.$cookies.get(this.headerdata[2]);
       this.$http.post('/productsdata',{product_ids:this.userdata}).then(function(response){
       this.cartData = response.data;
       console.log(this.cartData);
     });
    },

  },
  mounted:function(){
    bus.$on('change-header', function(result){
        this.headerdata = result;
      }.bind(this));
    }
  }
</script>

<style lang="css">
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
</style>
