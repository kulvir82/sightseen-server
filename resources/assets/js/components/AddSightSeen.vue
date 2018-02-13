<template lang="html">
  <div id="addsightseen">
  	<table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px">
  	    <tr>
  	        <td id="listpage_button_bar"><table align="left" height="60" width="100%" border="0" ><tr>
  	          <td valign="middle"><span id="pageTitle">Add Sight Seen</span></td>
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
    								<td><input type="text" name="title"  id="title" required/><div v-if="errorMessage =='title'" class="errorMessage">
    								  {{ 'enter the title' }}
    								</div>
    							<span id="search_it_error" style="color:red;margin-left: 11px;"></span></td>
    						</tr>
    						<tr>
    							<td nowrap class="input_form_caption_td">Country: </td>
    							<td>
    								<select name="country" id="country" class="country_list" v-model="country" @change="getCities(country)" required>

    									<option value="">Select Countries</option>
    							 		<option v-for="country in countries"  :value="country.id ">{{ country.country_name }}</option>
    								</select><div v-if="errorMessage == 'country'" class="errorMessage">
    								  {{ 'enter the country' }}
    								</div>
    							</td>
    						 </tr>
      					 <tr>
      						<td nowrap class="input_form_caption_td">City: </td>
      						<td>
      							<select  id="city" name="city" required>
      								<option value="" selected>Select City</option>
                      <option v-for="city in cities" :value="city.id">{{ city.city_name}}</option>
      							</select><div v-if="errorMessage == 'city'" class="errorMessage">
      								  {{'enter the city'}}
      							</div>
      						 </td>
      					 </tr>
    							<tr>
    								<td nowrap class="input_form_caption_td">Price: </td>
    								<td><input type="number"  id="price" name="price" min="0" max="999999999" required/>&nbsp;&nbsp;USD (Per pax)<div v-if="errorMessage == 'price'" class="errorMessage">
    								  {{'enter the price'}}
    								</div></td>
    							</tr>
                  <tr>
                    <td nowrap class="input_form_caption_td">Discount: </td>
                    <td>
                      <input :value="0" type="number" id="discount" name="dsicount" min="0" max="999999999" required/>&nbsp;&nbsp;in %
                    </td>
                  </tr>
                  <tr>
                    <td nowrap class="input_form_caption_td">Location Pickup: </td>
                    <td>
                      <input type="radio" id="pickupYes" name="pickup" value="1" required/>Yes
                      <input type="radio" id="pickupNo" name="pickup" value="0" checked required/>No
                    </td>
                  </tr>
                  <tr>
                    <td nowrap class="input_form_caption_td">Latitude: </td>
                    <td>
                      <input type="text" id="latitude" name="latitude" required/>
                    </td>
                  </tr>
                  <tr>
                    <td nowrap class="input_form_caption_td">Longitude: </td>
                    <td>
                      <input type="text" id="longitude" name="longitude" required/>
                    </td>
                  </tr>
    							<tr>
    								<td nowrap class="input_form_caption_td">Information: </td>
    								<td><vue-editor id="information" v-model="infocontent"></vue-editor><div v-if="errorMessage == 'information'" class="errorMessage">
    								  {{'enter the information'}}
    								</div></td>
    							</tr>
    							<tr>
    								<td nowrap class="input_form_caption_td">Description: </td>
    								<td><vue-editor id="description" v-model="descontent"></vue-editor><div v-if="errorMessage == 'description'" class="errorMessage">
    								  {{'enter the description'}}
    								</div></td>
    							</tr>
    							<tr>
                    <td nowrap class="input_form_caption_td"><label for="uploadFile" class="travel_buttons1">Select Images</label><br><input type="file" id="uploadFile" name="file" v-on:change="previewThumbnail" style="visibility:hidden;"></td>
                    <td>
                      <div class="images">
                        <div class="sight_images">
                          <img v-if="this.images.image1 != ''"  id="image1" >
                          <button v-if="this.images.image1 != ''" type="button" name="button" v-on:click="removeImage(value1)">remove</button>
                        </div>
                      </div>
                      <div class="images">
                        <div class="sight_images">
                          <img  v-if="this.images.image2 != ''"  id="image2">
                          <button v-if="this.images.image2 != ''" type="button" name="button" v-on:click="removeImage(value2)">remove</button>
                        </div>
                      </div>
                      <div class="images">
                        <div class="sight_images">
                          <img v-if="this.images.image3 != ''"  id="image3">
                          <button v-if="this.images.image3 != ''" type="button" name="button" v-on:click="removeImage(value3)">remove</button>
                        </div>
                      </div>
                      <div class="images">
                        <div class="sight_images">
                          <img v-if="this.images.image4 != ''"  id="image4">
                          <button v-if="this.images.image4 != ''" type="button" name="button" v-on:click="removeImage(value4)">remove</button>
                        </div>
                      </div>
                      <div v-if="errorMessage == 'images'" class="errorMessage">
      								  {{'add the image'}}
      								</div>
                    </td>
    							</tr>
              	<tr>
                  <td valign="top" width="10"></td>
                  <td height="50"><input class="travel_buttons1" value="Save" v-on:click="createSightSeen" type="submit">&nbsp;&nbsp;&nbsp;
  								<input type="reset" name="btnreset" class="travel_buttons1" value="Cancel" onclick="history.back(-1)"></td>
  							</tr>
    					</table>
  					</div>
  				</td>
  			</tr>
  	</table>
  </div>
</template>

<script>
import { mixin } from "../mixins/mixin"
import { VueEditor } from 'vue2-editor'
export default {
 name:'addsightseen',
  mixins: [mixin],
 components: {
      VueEditor
   },
 data: function() {
   return{
      errorMessage:null,
      infocontent:'',
      descontent:'',
      message:null,
      value1:'image1',
      value2:'image2',
      value3:'image3',
      value4:'image4',
      images:{
        image1:'',
        image2:'',
        image3:'',
        image4:''
      }
   }
 },
  methods:{
    createSightSeen () {
      if($('#title').val() == ''){
        this.errorMessage = 'title';
      }else if($('#country').val() == '') {
        this.errorMessage = 'country';
      }else if ($('#city').val() == '') {
        this.errorMessage = 'city';
      }else if ($('#price').val() == '') {
        this.errorMessage = 'price';
      }else if (this.infocontent == '') {
        this.errorMessage = 'information';
      }else if (this.descontent == '') {
        this.errorMessage = 'description';
      }else if (this.images.image1 == '') {
        this.errorMessage = 'images';
      }else{
        var form_data = new FormData();
        form_data.append('file[0]', this.images.image1);
        form_data.append('file[1]', this.images.image2);
        form_data.append('file[2]', this.images.image3);
        form_data.append('file[3]', this.images.image4);
        form_data.append('title', $('#title').val());
        form_data.append('city_id', $('#city').val());
        form_data.append('country_id', $('#country').val());
        form_data.append('information', this.infocontent);
        form_data.append('description', this.descontent);
        form_data.append('price', $('#price').val());
        form_data.append('discount', $('#discount').val());
        form_data.append('pickup', $("input[name=pickup]:checked").val());
        form_data.append('latitude',$("input[name=latitude]").val());
        form_data.append('longitude',$("input[name=longitude]").val());
        this.$http.post('/createsightseen',form_data).then(function (response) {
          this.redirectToSightseen();
        });
      }
    },
    removeImage  (image) {
      if(image == 'image1'){
          this.images.image1 = '';
          form_data.delete("file[0]");
      }
      if(image == 'image2'){
          this.images.image2 = '';
          form_data.delete("file[1]");
      }
      if(image == 'image3'){
          this.images.image3 = '';
          form_data.delete("file[2]");
      }
      if(image == 'image4'){
          this.images.image4 = '';
          form_data.delete("file[3]");
      }
    },
    previewThumbnail (event) {
      var input = event.target;
      var reader = new FileReader();
      if(input.files && input.files[0]) {
        if(this.images.image1 == ''){
          this.images.image1 = $('#uploadFile').prop('files')[0]
          reader.onload = function(e) {
            $('#image1').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
        else{
          if(this.images.image2 == ''){
              this.images.image2 = $('#uploadFile').prop('files')[0];
              reader.onload = function(e) {
                $('#image2').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
          else {
            if(this.images.image3 == ''){
                this.images.image3 = $('#uploadFile').prop('files')[0];
                reader.onload = function(e) {
                  $('#image3').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else{
              if(this.images.image4 == ''){
                  this.images.image4 = $('#uploadFile').prop('files')[0];
                  reader.onload = function(e) {
                    $('#image4').attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
              }
            }
          }
        }
      }
    },

  },
  created (){
    
  }
}
</script>

<style lang="css">
.errorMessage{
  color: #FF0000;
}
</style>
