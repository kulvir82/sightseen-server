export const mixin = {
	data ()
	{
		return {
			cities: [],
			countries: [],
			country: '',
			city: '',
			selected_status: '',
			booking_number: ''
		}
	},
	created ()
	{
		this.getcountries();
	},
	methods: {
		getCities (country)
		{
			// var country=$('.country_list').val();
		 	if(country){	
			 	this.$http.get('getCityList/'+country).then(response =>{
			 		this.cities = response.data;
			 	}, error => {

			 	});
		 	}
		},		
		getcountries (){
			this.$http.get('/getcountries').then(function(response){
        		this.countries  = response.data;
	    	});
		},
		setPageState (page)
		{
			let pagestate = [page,this.country,this.city,this.selected_status,this.booking_number];
      		localStorage.setItem('pagestate',JSON.stringify(pagestate));
		},
		redirectToSightseen: function(){
	      	if(localStorage.getItem('pagestate')){
		        let storage_data = JSON.parse(localStorage.getItem('pagestate'));
		        if(storage_data.length > 0){
		          let query = '';
		          if(storage_data[2])
		            query = "&country="+storage_data[1]+"&city="+storage_data[2];

		          var view  = ['sightseen','/getsightseen?page='+storage_data[0]+query,'','get'];
		          bus.$emit('open-view',view);
		        }
		    }
    	},
    	redirectToBookings: function(){
	      	if(localStorage.getItem('pagestate')){
				let storage_data = JSON.parse(localStorage.getItem('pagestate'));
				if(storage_data.length > 0)
				{
					let query = '';
		          	if(storage_data[1])
		            	query = "&country="+storage_data[1];
		            if(storage_data[2])
		            	query += "&city="+storage_data[2];
		            if(storage_data[3])
		            	query += "&status="+storage_data[3];
		            if(storage_data[4])
						query += "&booking_number="+storage_data[4];
					var view  = ['bookings','/bookings?page='+storage_data[0]+query,'','get'];
					bus.$emit('open-view',view);
				}
	      	}
    	},	 
	}
}