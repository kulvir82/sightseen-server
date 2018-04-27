<template lang="html">
  <div class="">
    <section class="sightlist">
      <div class="container">
        <div class="row">
          <div class="select_country">
            <select v-model="selected" @change="getSightSeenFromCountry">
              <option disabled="" :value="''">Select Country</option>
              <option v-for="country in countries" :value="country.id">{{ country.country_name }}</option>
            </select>
          </div>
          <div class="select_city">
            <select id="selectedcity" @change="getSightSeenFromCity">
              <option :value="''" selected>Select City</option>
              <option v-for="city in cities" :value="city.id">{{ city.city_name }}</option>
            </select>
          </div>
        </div>
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
      sightseenlist:[],
      countries: [],
      cities:[],
      selected: '',
    }
  },
  methods:{
    getSightSeenFromCountry (){
      this.cities = '';
      this.getCityList();
      this.$http.post('/getsightseenfromcountry',{country:this.selected}).then(function(response){
        this.sightseenlist = response.data;
      });
    },
    getSightSeenFromCity (){
      var city = $('#selectedcity').val()
      this.$http.post('/getsightseenfromcity',{city:city}).then(function(response){
        this.sightseenlist = response.data;
      });
    },
    getCountryList (){
      this.$http.get('/getcountries').then(function(response){
        this.countries  = response.data;
      });
    },
    getCityList(){
      this.$http.post('/getcities',{country:this.selected}).then(function(response){
        this.cities  = response.data;
      });
    }
  },
  created (){
    this.selected = this.$route.params.country
    this.getCountryList();
  },
  mounted:function(){
  }
}
</script>

<style lang="css">
section{
    padding: 50px 0  !important;
  }
.sightlist{
  margin-top: 40px;
}
.select_country{
  padding: 10px;
}
.select_city{
  padding: 10px;
}
.list{
  width: 100%;
}
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
