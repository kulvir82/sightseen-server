
  @extends('layouts.welcome')

  @section('content')
    <div id="sightseen">
      <table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px" class="input_table_new">
        <tr>
          <td id="listpage_button_bar" width="100%" colspan="3">
        		<table align="left" height="60" width="100%" border="0" >
        			<tr>
                <td valign="middle" align="left"><span id="pageTitle">Manage Sight Seen</span></td>
      					<td align="right"><a href="{{url('addSightSeen')}}"  class="travel_buttons">Add Sight Seen</a></td>
        			</tr>
        		</table>
          </td>
        </tr>
          <tr>
            <td align="left" width="60%">
              {!!  Form::open(['route' => 'searchSightSeen', 'method' => 'get', 'classs' => 'search_sightseen']) !!}
            	 <select name="country" class="country_list" onclick="" onchange="changeCities()">
            		 <option value="">Select Country</option>
                 @foreach($countries as $country)
            			<option value="{{ $country->id }}">{{ $country->country_name}}</option>
            		 @endforeach
            	 </select>
            	 <select  id="city" name="city" onchange="" >
                 <option value="">Select City</option>
            	 </select>
              <input type="submit" name="report_search"  class="travel_buttons1" autocomplete="off">
              {!! Form::close() !!}
           </td>
        	 <td align="left" width="20%"><a class="travel_buttons" href="{{ url('/sightseen') }}">All Records</a></td>
             <td align="right" class="fontGreen">Total Records:</td>
             <td class="fontGreen">{{$sightseen->total()}}</td>
      	  </tr>
      </table>
        <table width="100%" cellspacing="1" cellpadding="2" border="0" align="center" class="listing_table" id="sortabletable">
          <tbody>
            <tr>
              <td class="form_header" align="left">
                Sr.No.
              </td>
              <td class="form_header" align="left">
                Title
              </td>
              <td class="form_header" align="left">
                Price (USD)
              </td>
              <td class="form_header" align="left" style="width: 347px;">
                Description
              </td>
              <td class="form_header" style="padding-left: 31px;width: 130px;" align="left">
                Action
              </td>
        		</tr>
            @php $i = 1; @endphp
            @foreach ($sightseen as $sight)
        		<tr>
        				<td class="form_header2">{{$i}}</td>
        				<td class="form_header2">{{$sight->title}}</td>
        				<td class="form_header2">{{$sight->price}}</td>
        				<td class="form_header2">{{$sight->description}}</td>
                <td class="form_header2">
        	         <a title="Edit"  href="{{ url('/editSightSeen', array('id'=>$sight->id)) }}">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
        	         <a  title="Delete" onclick="return confirm('Are you sure?')" id="delete" href="{{ url('/deleteSightSeen', array('id'=>$sight->id)) }}">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;
        	         <a  title="View" href="{{ url('/viewSingleSight', array('id'=>$sight->id)) }}">View</a>
        	      </td>
        		</tr>
        		<tr class="row0">
        			<td colspan="4" style="text-align:center; !important;"></td>
        		</tr>
            @php $i++; @endphp
            @endforeach
          </tbody>
        </table>
        <div class="paginationstyle" id="gallerypaginate" >
          {{ $sightseen->links() }}
        </div>
      </div>
  @endsection
