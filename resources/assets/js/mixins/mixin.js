export const mixin = {
	data ()
	{
		return {
			cities: [],
			countries: [],
			country: '',
			city: '',
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
			let pagestate = [page,this.country,this.city];
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
		          	if(storage_data[2])
		            	query = "&country="+storage_data[1]+"&city="+storage_data[2];
					
					var view  = ['bookings','/bookings?page='+storage_data[0]+"&country="+storage_data[1]+"&city="+storage_data[2],'','get'];
					bus.$emit('open-view',view);
				}
	      	}
    	},	 
	}
}