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
        <div class="address">
          <div class="">
            <i class="fa fa-map-marker"></i>
          </div>
          <div class="">
            <i class="fa fa-phone"></i>
          </div>
          <div class="">
            <i class="fa fa-fax"></i>
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
      sendmessage:null
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
</style>
