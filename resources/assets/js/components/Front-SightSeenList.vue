<template lang="html">
  <div class="">
    <section class="sightlist ">
      <div class="container">
        <div class="row">
          <div class="list" v-for="sight in sightseenlist">
            <div class="row border border-secondary rounded sightgap">
              <div class=" col-md-3 text-center">
                <div class="sightimage">
                  <img class="img-fluid" :src="sight.image1" :alt="sight.title">
                </div>
                <div class="max-auto title-price">
                  <div class="row">
                    <div class="col-sm-12">
                      <strong class="h6 ">{{sight.title}}</strong>
                    </div>
                    <div class="col-sm-12">
                      <strong class="h6 ">${{sight.price}} Per Person</strong>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9 col-sm-9"><div class="info" v-html="sight.information"></div></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data:function(){
    return{
      sightseenlist:null,
      country:null,
      cart:null,
      product_ids:[],
      unique_code:null,
      i:0,
    }
  },
  methods:{
    getSightSeenFromCountry:function(){
        this.country = this.$route.params.country;
        bus.$emit('change-header',[this.country.img]);
        this.$http.post('/getsightseenfromcountry',{country:this.country.code}).then(function(response){
        this.sightseenlist = response.data;
      });
    },
    addToCart:function(sightid){
        this.product_ids.push([sightid]);

        var products = this.product_ids.length;
        if(!this.$cookies.isKey('UserToken') ){
          this.unique_code = this.makeid();
          this.$cookies.set('UserToken',this.unique_code,{ expires: '1M' });
        }

          var token = this.$cookies.get('UserToken');
          this.$cookies.set(token,this.product_ids,{expires:'1M'});
          this.$http.get('/addtocart',{sightid:sightid}).then(function(response){
          bus.$emit('change-header',[ this.country.img , products ]);
          });


      // this.$http.post('/',{sightId:sightid,userId:token}).then(function(response){
      //
      // });
    },
    makeid:function() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for (var i = 0; i < 8; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));
      console.log(text);
      return text;
    }
  },
  mounted:function(){
    this.getSightSeenFromCountry();
  }
}
</script>

<style lang="css">
.info p{
  font-size: 15px;
  line-height: 15px;
  color: #0000FF;
}
.info strong {
  font-size: 18px;
  line-height: 18px;
  color: #0000FF;
}
.info ul ol {
  font-size: 15px;
  line-height: 15px;
  color: #0000FF;
}
.sightimage{
  display:inline-block;
  position:relative;
}
.sightimage button{
  position:absolute;
  bottom:100px;
  right:30px;
}
.title-price{
  background: #A9A9A9;
  color: #ffffff;
}
.sightgap{
  margin: 10px;
  padding: 10px;
}
</style>
