
@extends('layouts.welcome')

@section('content')
<div id="addsightseen">
	<table width="98%" border="0" cellspacing="0" cellpadding="0" style ="margin-left:10px;margin-top:5px">
	    <tr>
	        <td id="listpage_button_bar"><table align="left" height="60" width="100%" border="0" ><tr>
	                    <td valign="middle"><span id="pageTitle">Add Sight Seen</span></td>
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
					{!!  Form::open(['route' => 'saveSightSeen', 'method' => 'POST', 'id' => 'passForm', 'files' => 'true']) !!}
					<table width="70%" border="0" cellspacing="0" cellpadding="2" align="center" class="input_table">
						<tr>
							<td colspan="2" id="errormsg" align="center" style="color:red;" ></td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Title: </td>
								<td><input type="text" name="title" id="title" />
							<span id="search_it_error" style="color:red;margin-left: 11px;"></span></td>
						</tr>
						<tr>
							<td nowrap class="input_form_caption_td">Country: </td>
							<td>
								<select name="country" class="country_list" onchange="changeCities()">

									<option value="">Select Countries</option>
								@foreach($countries as $country)
							 		<option value="{{{ $country->id }}}">{{ $country->country_name }}</option>
							  @endforeach
								</select>
							</td>
						 </tr>
						<tr>
							<td nowrap class="input_form_caption_td">City: </td>
								<td>
								<select  id="city" name="city" >
									<option value=""  selected>Select City</option>
								</select>
						 	</td>
							</tr>
							<tr>
								<td nowrap class="input_form_caption_td">Price: </td>
								<td><input type="number" name="price" min="0" max="999999999" />&nbsp;&nbsp;USD (Per pax)</td>
							</tr>
							<tr>
								<td nowrap class="input_form_caption_td">Information: </td>
								<td><textarea id="information" name="information" rows="12" ></textarea></td>
							</tr>
							<tr>
								<td nowrap class="input_form_caption_td">Description: </td>
								<td><textarea id="description" name="description" rows="12" ></textarea></td>
							</tr>
							<tr>
								<td nowrap class="input_form_caption_td">Image: </td>
								<td>
									<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="icon-jfi-paperclip"></i> Upload Images</a>
								</td>
							</tr>
							<tr>
                <td valign="top" width="10"></td>
                <td height="50"><input class="travel_buttons1" value="Save" type="submit">&nbsp;&nbsp;&nbsp;
								<input type="reset" name="btnreset" class="travel_buttons1" value="Cancel" onclick="history.back(-1)"></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
	</table>
	{!! Form::close() !!}
</div>
@endsection

<!-- <script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'information' );
</script> -->
