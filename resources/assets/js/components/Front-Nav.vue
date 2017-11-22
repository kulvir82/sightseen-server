<template >
  <nav v-if="headerdata" class="navbar navbar-expand-lg bg-header fixed-top text-center" id="mainNav" >
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
            <b-modal v-if="cartData" id="modal1" size="lg" hide-footer >
              <!-- <div class="heading">
                <div class="row border text-center padding-sm">
                  <div class="col-md-3 h5 padding-xs">
                    <span>Destination</span>
                  </div>
                  <div class="col-md-2 h5 padding-xs">
                    <span>Persons</span>
                  </div>
                  <div class="col-md-3 h5 padding-xs">
                    <span>Book Date</span>
                  </div>
                  <div class="col-md-1 h5 padding-xs">
                    <span>Price</span>
                  </div>
                </div>
              </div> -->
            <div class="scroll-class">
              <div class="products" v-for="data,index in cartData"  :id="'product'+data.id">
                <div class="row border rounded text-center margin-top-sm margin-xs ">
                  <div class="col-md-3 h6 padding-xs">
                    <div class="small">
                      <span class="align-middle">{{data.title}}</span>
                    </div>
                    <div class="small">
                      <span>Cost: </span><span class="align-middle">{{data.price}} USD</span><span> Per Person</span>
                    </div>
                  </div>
                  <div class="col-md-3 small">
                    <select name="numberofpax" v-bind:id="'numberofpaxfor'+data.id" v-on:change="getPriceForAll(data.price,data.id,index)">
                      <option :value="1" selected>1</option>
                      <option v-for="item in 19"  :value="val + item++">{{ item }}</option><span>Person</span>
                    </select><span>Person</span>
                  </div>
                  <div class="col-md-3 small">
                    <div class="row padding-xs">
                      <datetime :id="'date'+data.id"
                        :value="date"
                        type="date"
                        input-format="DD-MM-YYYY"
                        wrapper-class="my-wrapper-class"
                        input-class="my-input-class"
                        placeholder="Select date"
                        :min-date="date"
                        monday-first
                        auto-close
                        required ></datetime>
                      </div>
                    </div>
                    <div class="col-md-2 h6 padding-md small">
                      <div class="" :id="'total-'+data.id">
                        <span class="total"></span>
                        <span>USD</span>
                      </div>
                    </div>
                    <div class="col-md-1 h6 padding-md small">
                      <b-button class="text-center rounded-circle" size="sm" v-on:click="removefromcart(data.id)">X</b-button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row border border-bottom-0 rounded small">
                <div class="col-md-2 padding-top-md">
                  <b-button size="sm" type="submit" v-on:click="checkoutCartData()">Checkout</b-button>
                </div>
                <div class="col-md-4 padding-top-md">
                    <b-button size="sm">Continue Shoping</b-button>
                </div>
                <div class="col-md-6 text-right padding-top-xs">
                  <div class="col-md-6">
                    <div class="">
                      <span>Tax</span>
                    </div>
                    <div class="">
                      <span>Total Amount</span>
                    </div>
                  </div>
                  <div class="col-md-3">

                  </div>
                </div>
              </div>
            </b-modal>
            <b-btn class="nav-link js-scroll-trigger" v-on:click="getcartdata()" v-b-modal.modal1><span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span><span v-if="headerdata[1]" >{{ headerdata[1] }}</span><span v-else >{{ cartlength }}</span></b-btn>
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
    }

  },
  created ()
  {
    let d = new Date();
    this.date = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
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
