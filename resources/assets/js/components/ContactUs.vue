<template lang="html">
  <div class="container h-100 margin-top-xl padding-top-xl padding-bottom-xl">
    <div class="row h-100">
      <div class="col-md-6">
        <h2>Email us </h2>
        <div v-if="errormessage == 'Name'" class="text-danger d-inline">{{errormessage}} </div><div v-if="errormessage == 'Email'" class="text-danger d-inline">{{errormessage}} </div><div v-if="errormessage == 'Message'" class="text-danger d-inline">{{errormessage}} </div><div v-if="errormessage" class="text-danger d-inline">Feild is Empty</div>
        <div class="contactusform ">
          <div class="name padding-md">
            <input class="form-control"  type="text" name="name" placeholder="Name" v-model="username" required>
          </div>
          <div class="emale padding-md">
            <input class="form-control" type="email" name="email" placeholder="Email" v-model="emailid" required>
          </div>
          <div class="message padding-md">
            <textarea class="form-control" name="message" rows="8" cols="80" placeholder="Message" v-model="message" required></textarea>
          </div>
          <div class="submitbtn padding-md">
            <input class="btn btn-primary" v-on:click="sendSupportMail()" type="submit" name="submit" value="Submit">
          </div>
        </div>
        <div v-if="sendmessage == 'successful'" class="text-success">
          Message send {{sendmessage}}.
        </div>
        <div v-if="sendmessage == 'unsucessfull'" class="text-success">
          Message send {{sendmessage}}.
        </div>
      </div>
      <div class="col-md-6 ">
        <h2>Location</h2>
        <div class="address col-md-12">
          <div class="location">
            <strong><i class="fa fa-map-marker"></i></strong> Maple Labs 563, Stonehenge Drive Ancaster, <br>
                &nbsp;&nbsp; ON Canada ZIP L9K1T4
          </div>
          <div class="phone">
            <strong><i class="fa fa-phone"></i></strong> +1(289)505-8058
          </div>
          <div class="email">
            <strong><i class="fa fa-envelope"></i></strong> info@maplelabs.ca
          </div>
          <div class="helpline">
            <ul class="india-group">
              <li><strong>India Office</strong>:</li>
              <li><strong>Call us for support</strong>: +919875950679</li>
              <li><strong>Timings</strong>: Available from 10 AM to 5 PM</li>
            </ul>
          </div>
        </div>
        <div class="maps col-md-12 padding-top-md">
          <gmap-map style="width: 100%; height: 300px; position: relative;"
                  :center="center"
                  :zoom="12"
              >
              <gmap-marker
                :position="markerposition"
              ></gmap-marker>
              <gmap-info-window :position="markerposition">
                Maple Labs 563, Stonehenge Drive Ancaster , ON Canada ZIP L9K1T4
              </gmap-info-window>
            </gmap-map>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data:function(){
    return{
      username:null,
      emailid:null,
      message:null,
      errormessage:null,
      sendmessage:null,
      center: {lat: 43.222435,lng: -79.938504},
      markerposition: {lat: 43.222435,lng: -79.938504},
    }
  },
  methods:{
    sendSupportMail:function(){
      if(this.username == null){
        this.errormessage = 'Name';
      }else if (this.emailid == null) {
        this.errormessage = 'Email';
      }else if (this.message == null) {
        this.errormessage = 'Message';
      }else {
        this.$http.post('usersendmail',{username:this.username,emailid:this.emailid,message:this.message,resource:'ContactUs'}).then(function(response){
            this.errormessage == null;
            this.sendmessage == this.response.data;
        });

      }
    }
  }
}
</script>

<style lang="css">
.india-group{
  list-style: none;
  padding: 0px !important;
}
</style>
