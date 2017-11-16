<template lang="html">
  <div id="singlesightseen" v-if="singleSight">
      <table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px">
          <tr>
              <td id="listpage_button_bar"><table align="left" height="60" width="100%" border="0" ><tr>
                          <td valign="middle" align="left"><span id="pageTitle">View Sight Seen</span></td>
      					<td align="right">
      						<a  onclick="history.back(-1)" class="travel_buttons">Back</a>
      					</td>
                      </tr>
                  </table>
              </td>

          </tr>
      </table>
      <div id="content_div">
        <table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" id="sortabletable">
          <tbody>
            <tr>
              <td class="form_header2" align="left">Title</td>
              <td class="form_header2">{{ singleSight.title }}</td>
            </tr>
            <tr>
              <td class="form_header2" align="left">Country</td>
              <td class="form_header2">{{ singleSight.countryName }}</td>
            </tr>
          	<tr>
          		<td class="form_header2" align="left">City</td>
          		<td class="form_header2">{{ singleSight.cityName }}</td>
          	</tr>
          	<tr>
          		<td class="form_header2" align="left">Price</td>
          		<td class="form_header4">{{ singleSight.price }}</td>
          	</tr>
          	<tr>
          		<td class="form_header2" align="left" valign="top">Information</td>
          		<td class="form_header4 blackColor" v-html="singleSight.information"></td>
          	</tr>
          	<tr>
          		<td class="form_header2" align="left" valign="top">Description</td>
          		<td class="form_header4 blackColor" v-html="singleSight.description"></td>
          	</tr>
          	<tr>
          		<td class="form_header2" align="left">Image1</td>
          		<td class="form_header4"><img v-if="singleSight.image1" :src="'/uploads/images/'+singleSight.image1" height="100px" width="100px" /></td>
          	</tr>
          	<tr>
          		<td class="form_header2" align="left" >Image2</td>
          		<td class="form_header4"><img v-if="singleSight.image2" :src="'/uploads/images/'+singleSight.image2" height="100px" width="100px" /></td>
          	</tr>
        		<tr>
          		<td class="form_header2" align="left">Image3</td>
          		<td class="form_header4"><img v-if="singleSight.image3" :src="'/uploads/images/'+singleSight.image3" height="100px" width="100px" /></td>
            </tr>
            <tr>
          		<td class="form_header2" align="left">Image4</td>
          		<td class="form_header4"><img v-if="singleSight.image4" :src="'/uploads/images/'+singleSight.image4" height="100px" width="100px" /></td>
          	</tr>
         </tbody>
      </table>
    </div>
</div>
</template>
<script>
export default {
  name:'singlesightseen',
  props: ['data'],
  data: function() {
    return{
       singleSight:this.data,
    }
  },

}
</script>

<style lang="css">
</style>
