<template lang="html">
  <div class="support">
    <div class="container h-100 margin-top-xl padding-top-xl padding-bottom-xl">
      <div class="row h-100">
        <div class="col-md-6">
          <div class="support_wrap padding-md headingcolor">
            <h2>Soupport Title</h2>
            <div class="support_desc padding-md">
              <p><strong>Go4SightSeeing </strong>is fast and fun way to explore and book unique Sight Seen, Shows, Activities and Experiences at the Lowest Prices Guaranteed.With just a few clicks, get ready to enjoy the Siam Nimrat show no big queues to get tickets , enjoy Santosa isLand under water park and other attractions.So Just click book and go to your favourite destination.</p>
            </div>
            <div class="helpline">
              <ul class="india-group">
                <li><strong>India Office</strong>:</li>
                <li><strong>Call us for support</strong>: +919875950679</li>
                <li><strong>Timings</strong>: Available from 10 AM to 5 PM</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form_wrapper padding-md headingcolor">
            <h2>Contact Us Through Email</h2>
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
        this.$http.post('usersendmail',{username:this.username,emailid:this.emailid,message:this.message,resource:'SupportPage'}).then(function(response){
            this.errormessage == null;
            this.sendmessage == this.response.data;
        });
      }
    }
  }

}
</script>

<style lang="css">
</style>
