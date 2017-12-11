function changeCities()
{
 var country=$('.country_list').val();
	 if(country){	
	 $.ajax({

		 url: 'getCityList/'+country,
		 type:'get',
		 success: (response)=>{
			 var cities = response;
			 for(j=document.getElementById('city').options.length-1;j>=1;j--)
			 {
				 document.getElementById('city').remove(j);
			 }

			 for (i=0;i<cities.length;i++)
			 {
				 var optn = document.createElement("OPTION");
				 optn.text = cities[i].city_name;
				 optn.value = cities[i].id;
				 document.getElementById('city').options.add(optn);
			 }

			 $('#status').fadeOut('slow');//fade out the loader
		 },
	     error:function(exception){

	     }

	});
	}
}
