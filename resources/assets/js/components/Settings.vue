<template>
	<div>
		<table width="70%" border="0" cellspacing="0" cellpadding="2" align="center" class="tax_table input_table">
			<tr>
				<td>
					<p class="tax_msg">
						{{ tax_msg }}
					</p>
				</td>
				<td></td>
			</tr>	
			<tr>
				<td nowrap class="input_form_caption_td">Country: </td>
				<td>	
					<select name="country"  id="country" class="form-control country_list" v-model="country_id" required @change="getTax()">
						<option value="">Select Countries</option>
			 			<option v-for="country in countries"  :value="country.id ">{{ country.country_name }}</option>
					</select>
				</td>
			</tr>
			<tr>
				<td nowrap class="input_form_caption_td">Tax:</td>
				<td><input type="number" class="form-control" v-model="tax" name="tax" id="tax"></td>
			</tr>
			<tr class="button_row">
				<td></td>
				<td>
					<input type="button" class="travel_buttons1" name="save_tax" id="save_tax" value="Save" @click="saveTax()">
				</td>
			</tr>
		</table>
	</div>
</template>
<script>
	export default {
		data (){
			return {
				countries: null,
				tax: 0,
				country_id: '',
				tax_msg: ''
			}
		},
		methods: {
			getcountries () {
      			this.$http.get('/getcountries').then(function(response){
          			this.countries  = response.data;
        		});
	    	},
	    	saveTax (){
	    		if(this.tax != 0 && this.country_id != ''){
		    		this.$http.post('/addTax',{'country_id': this.country_id, 'tax': this.tax}).then(function(response){
	          			this.tax_msg = "Tax Successfully Saved"
	          			this.country_id = ''
	        			this.tax = 0
	        		});
		    		setTimeout( () =>{
		    			this.tax_msg = '';
		    		},3000);
		    	}
	    	},
	    	getTax (){
	    		if(this.country_id != ''){
		    		this.$http.get('/getTax/'+this.country_id).then(function(response){
	        			this.tax = response.data
		        	});
		    	}
	    	}
	  	},
		created (){
		    this.getcountries();
	    }
	}
</script>
<style>
	.tax_table{
		margin-top: 2rem;
	}
	.button_row td{
		padding-top: 2rem;
	}
</style>