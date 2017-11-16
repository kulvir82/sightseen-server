
@extends('layouts.welcome')

@section('content')
<div id="editsightseen">
	<table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px">
		<tr>
			<td id="listpage_button_bar">
				<table align="left" height="60" width="100%" border="0" >
					<tr>
						<td valign="middle"><span id="pageTitle">Update Sight Seen</span></td>
						<td align="right">
							<a  onclick="history.back(-1)" class="travel_buttons">Back</a>
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
					{!!  Form::open(['route' => 'updateSightSeen', 'method' => 'post', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
					{{ csrf_field() }}
					<table width="70%" border="0" cellspacing="0" cellpadding="2" align="center" class="input_table">
						<tr>
							<td colspan="2" id="errormsg" align="center" style="color:red;" ></td>
						</tr>
						<tr>
							<td>
								<!-- <input type="hidden" name="hiddenid" value="{{--$editsightseen->id--}}"> -->
							</td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Title: </td>
							<td><input type="text" name="title" value="{{$editsightseen->title}}" id="title" /><span id="search_it_error" style="color:red;margin-left: 10px;"></span></td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Country: </td>
							<td>
								<select name="country" class="country_list" onchange="getchangedCities()">

									<option value="">Select Country</option>
									@foreach($countries as $country)
									@if($country->id == $editsightseen->country)
									<option value="{{{ $country->id }}}" selected>{{ $country->country_name }}</option>
									@else
									<option value="{{{ $country->id }}}">{{ $country->country_name }}</option>
									@endif
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">City: </td>
							<td>
								<select  id="city" name="city" >
									@foreach($cities as $city)
									@if($city['city_code'] == $editsightseen->city)
									<option value="{{$city['city_code']}}" selected>{{$city['city_name']}}</option>
									@else
									<option value="{{$city['city_code']}}">{{$city['city_name']}}</option>
									@endif
									@endforeach

								</select>
							</td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Price: </td>
							<td><input type="number" name="price" min="0" max="999999999" value="{{$editsightseen->price}}" />&nbsp;&nbsp;USD (Per pax)</td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Information: </td>
							<td><textarea id="information" name="information" rows="12" >{{$editsightseen->information}}</textarea></td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Description: </td>
							<td><textarea id="description" name="description" rows="12" >{{$editsightseen->description}}</textarea></td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Image: </td>
							<td>
								<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="icon-jfi-paperclip"></i> Upload Images</a>
							</td>
						</tr>
						<tr>
							<td valign="top" width="10">
								<div  class="upload_data" style="display:none;">
									@if($editsightseen->image1 != ""){{ $editsightseen->image1 }} @endif
									@if($editsightseen->image2 != ""){{ $editsightseen->image2 }} @endif
									@if($editsightseen->image3 != ""){{ $editsightseen->image3 }} @endif
									@if($editsightseen->image4 != ""){{ $editsightseen->image4 }} @endif
								</div>
								<div style="display:none;" id="upload_url" >{{ asset("uploads/images/") }}</div>
							</td>
							<td height="50"><input type="hidden" name="id" value="{{ $editsightseen->id }}"/>
								<input type="submit" name="btnsubmit" class="travel_buttons1" value="Update" />&nbsp;&nbsp;&nbsp;
								<input type="reset" name="btnreset" class="travel_buttons1" value="Cancel" onclick="history.back(-1)">
							</td>
						</tr>
					</table>
					{!! Form::close() !!}
				</div>
			</td>
		</tr>
	</table>
</div>
@endsection
