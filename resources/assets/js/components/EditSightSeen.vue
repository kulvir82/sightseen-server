<template lang="html">
  <div id="editsightseen" v-if="sightseen && refreshedImages">
  	<table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px">
  		<tr>
  			<td id="listpage_button_bar">
  				<table align="left" height="60" width="100%" border="0" >
  					<tr>
  						<td valign="middle"><span id="pageTitle">Update Sight Seen</span></td>
  						<td align="right">
                <a href="javascript:;" v-on:click="redirectToSightseen()" class="travel_buttons">Back</a>
  						</td>
  					</tr>
  				</table>
  			</td>
  		</tr>
  	</table>
  	<table border="0" cellspacing="0" cellpadding="0" class="page_width">
  		<tr>
  			<td id="content_center_td" valign="top" align="center">
  				<div id="content_div">
  					<table width="70%" border="0" cellspacing="0" cellpadding="2" align="center" class="input_table">
                <tr>
    							<td colspan="2" id="errormsg" align="center" style="color:red;" ></td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Title: </td>
    							<td><input type="text" name="title" :value="sightseen.title" id="title" /><span id="search_it_error" style="color:red;"></span></td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Country: </td>
    							<td>
    								<select name="country" class="country_list" id="country" v-model="country" @change="getCities(country)">
    									<!-- <option value="" >Select Country</option> -->
    									<option v-for="country in countries" :value="country.id">{{ country.country_name }}</option>
    								</select>
    							</td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">City: </td>
    							<td>
    								<select id="city" name="city" v-model="city">
    									<!-- <option value="" >Select City</option> -->
                      <option v-for="city in cities" :value="city.id">{{ city.city_name}}</option>
    								</select>
    							</td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Price: </td>
    							<td><input type="number" name="price" min="0" max="999999999" id="price" :value="sightseen.price" />&nbsp;&nbsp;USD (Per pax)</td>
    						</tr>
                <tr>
                    <td nowrap class="input_form_caption_td">Discount: </td>
                    <td>
                      <input type="number" id="discount" name="dsicount" :value="sightseen.discount" min="0" max="999999999" required/>&nbsp;&nbsp;in %
                    </td>
                  </tr>
                <tr>
                  <td nowrap class="input_form_caption_td">Location Pickup: </td>
                  <td>
                    <input type="radio" id="pickupYes" name="pickup" :value="1" v-model="sightseen.pickup">Yes
                    <input type="radio" id="pickupNo" name="pickup" :value="0" v-model="sightseen.pickup">No
                  </td>
                </tr>
                <tr>
                    <td nowrap class="input_form_caption_td">Latitude: </td>
                    <td>
                      <input type="text" id="latitude" name="latitude" v-model="sightseen.latitude" required/>
                    </td>
                  </tr>
                  <tr>
                    <td nowrap class="input_form_caption_td">Longitude: </td>
                    <td>
                      <input type="text" id="longitude" name="longitude" v-model="sightseen.longitude" required/>
                    </td>
                  </tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Information: </td>
    							<td><vue-editor id="information" v-model="sightseen.information"></vue-editor></td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Description: </td>
    							<td><vue-editor id="description" v-model="sightseen.description"></vue-editor></td>
    						</tr>
                <tr>
                  <td nowrap class="input_form_caption_td">Images:</td>
                  <td>
                    <div class="images" v-if="refreshedImages.image1">
                      <div class="sight_images">
                        <img :src="refreshedImages.image1" alt="">
                        <button type="button" name="button" v-on:click="removeImage(sightseen.id,refreshedImages.image1,image1)">remove</button>
                      </div>
                    </div>
                    <div class="images" v-if="refreshedImages.image2">
                      <div class="sight_images">
                        <img :src="refreshedImages.image2" alt="">
                        <button type="button" name="button" v-on:click="removeImage(sightseen.id,refreshedImages.image2,image2)">remove</button>
                      </div>
                    </div>
                    <div class="images" v-if="refreshedImages.image3">
                      <div class="sight_images">
                        <img :src="refreshedImages.image3" alt="">
                        <button type="button" name="button" v-on:click="removeImage(sightseen.id,refreshedImages.image3,image3)">remove</button>
                      </div>
                    </div>
                    <div class="images" v-if="refreshedImages.image4">
                      <div class="sight_images">
                        <img :src="refreshedImages.image4" alt="">
                        <button type="button" name="button" v-on:click="removeImage(sightseen.id,refreshedImages.image4,image4)">remove</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td nowrap class="input_form_caption_td">Update Images</td>
                  <td>
                    <div class="">
                        <input type="file" name="file" id="fileInput" v-on:change="updateImages()">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td height="50"><input type="hidden" name="hiddenid" id="hiddenId" :value="sightseen.id"/>
                    <input type="button" name="btnsubmit" class="travel_buttons1" v-on:click="updateSightSeen()" value="Update" />&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="btnreset" class="travel_buttons1" value="Cancel" onclick="history.back(-1)">
                  </td>
                </tr>
              </table>
  				</div>
  			</td>
  		</tr>
  	</table>
  </div>
</template>
<script>
import { VueEditor } from 'vue2-editor'
import { mixin } from "../mixins/mixin"
export default {
  name:'editsightseen',
  mixins: [mixin],
  props:['data'],
  components: {
       VueEditor
    },
  data:function() {
    return{
      url: '/updateimages',
      image1:'image1',
      image2:'image2',
      image3:'image3',
      image4:'image4',
      refreshedImages:null,
      sightseen:this.data,
      current_page:null,
    }
  },
  methods:{
    refreshImages:function () {

      $.ajax({
            method:'POST',
            url: '/refreshimages',
            data:{id:this.data.id},
            success: (response) => {
              this.refreshedImages = response;
            },
            error:function(exception){}
        });
    },
    updateImages:function () {
      var id = $('#hiddenId').val();
      var file_data = $('#fileInput').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      form_data.append('id',id);
      $.ajax({
            method:'POST',
            url: '/updateimages',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: (response) => {
              this.refreshImages();
            },
            error:function(exception){alert('Exception:'+exception);}
        });
    },

    removeImage:function (id,image,column) {
      var r = confirm("do you want to remove image ");
      if (r == true) {
        this.$http.post('/removeimages',{id:id,image:image,column:column}).then(function (response) {
          this.refreshImages();
        });
      } else {
          txt = "You pressed Cancel!";
      }

    },
    updateSightSeen: function(){
      var id = $('#hiddenId').val();
      var title = $('#title').val();
      var country_id = $('#country').val();
      var city_id = $('#city').val();
      var price = $('#price').val();
      var discount = $('#discount').val();
      var pickup = $("input[name=pickup]:checked").val();
      var info = this.sightseen.information;
      var description = this.sightseen.description;
      var latitude = this.sightseen.latitude;
      var longitude = this.sightseen.longitude;
      this.$http.post('/updatesightseen',{id:id,price:price,country_id:country_id,title:title,city_id:city_id,pickup:pickup,info:info,description:description,discount: discount,latitude: latitude,longitude: longitude}).then(function (response) {
        this.redirectToSightseen();
      });
    },
  },
  created (){
    this.city = this.sightseen.city_id;
    this.cities = this.sightseen.cities;
    this.country = this.sightseen.country_id;
    this.refreshImages();
  },
}
</script>

<style lang="css">
</style>
