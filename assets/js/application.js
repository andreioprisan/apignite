var apibuilder_action="run";

$(function() {
	//$('#apibuilder_method_table .required_edit').hide();
	
	switch2mode(apibuilder_action);
});


function switch2mode(mode)
{
	if (mode == "edit")
	{
		// hide parameter valued on edit
		$('#apibuilder_method_table .value_header').hide();
		$('#apibuilder_method_table .value_row').hide();
		// hide param name edit
		$('#apibuilder_method_table .name_read').hide();
		$('#apibuilder_method_table .name_edit').show();
		// hide param type edit
		$('#apibuilder_method_table .type_read').hide();
		$('#apibuilder_method_table .type_edit').show();
		// show required checkboxes
		$('#apibuilder_method_table .required_read').hide();
		$('#apibuilder_method_table .required_edit').show();
		// show value input box
		$('#apibuilder_method_table .value_edit').show();
		// show description input box
		$('#apibuilder_method_table .description_read').hide();
		$('#apibuilder_method_table .description_edit').show();
		
		$('#mainsubmitbutton').hide();
		$('#apibuilder_addparam').show();
		
		// show delete row buttons
		$('#apibuilder_method_table .editonly_header').show();
		$('#apibuilder_method_table .editonly_row').show();
		
	} else {
		$('#apibuilder_method_table .value_header').show();
		$('#apibuilder_method_table .value_row').show();
		// hide param name edit
		$('#apibuilder_method_table .name_edit').hide();
		$('#apibuilder_method_table .name_read').show();
		// hide param type edit
		$('#apibuilder_method_table .type_read').show();
		$('#apibuilder_method_table .type_edit').hide();
		// hide required checkboxes, show text only
		$('#apibuilder_method_table .required_edit').hide();
		$('#apibuilder_method_table .required_read').show();
		// show value input box
		$('#apibuilder_method_table .value_edit').show();
		// show description input box
		$('#apibuilder_method_table .description_read').show();
		$('#apibuilder_method_table .description_edit').hide();
		
		$('#mainsubmitbutton').show();
		$('#apibuilder_addparam').hide();
		
		// hide detele buttons
		$('#apibuilder_method_table .editonly_header').hide();
		$('#apibuilder_method_table .editonly_row').hide();
		
		$('#paramcounttext').hide();
	}
	
	apibuilder_action = mode;
}

function apibuilder_deleterow(mid)
{
	$('#'+mid+'').fadeOut();
	$('#'+mid+'').empty();
	
	var data = new Object;
	data.mid = mid;
	$.ajax({
		url: '/apis/deleteAPICall',
		data: data,
		type: 'POST',
		success: function ( data ) {
		}
	});
	
	
//	console.log($('#'+mid));
}

function apibuilder_edit_submit()
{
	$('#apibuilder_method_table tr').not(':first').each(function(index) {
		var method_param = $(this).attr('id');
		var data_update = new Object;
		var required_html;
		
		data_update.id = method_param;
		data_update.name = $('#'+method_param+' .name_edit').val();
		data_update.type = $('#'+method_param+' .type_edit').val();
		if ($('#'+method_param+' .required_edit').is(':checked'))
			data_update.required = "1";
		else
			data_update.required = "0";
			
		//data_update.value = $('#'+method_param+' .value_edit').val();
		data_update.description = $('#'+method_param+' .description_edit').val();
			
		apibuilder_gui_update(data_update);
			
		$('#'+method_param+' .name_read').html(data_update.name);
		$('#'+method_param+' .type_read').html(data_update.type);
		if (data_update.required == "1")
		{
			required_html = '<span class="label label-important" style="font-size:15px">yes</span>';
		} else {
			required_html = '<span class="label label-info" style="font-size:15px">no</span>';
		}
		$('#'+method_param+' .required_read').html(required_html);
		$('#'+method_param+' .description_read').html(data_update.description);
		
	})
	
}

function apibuilder_run_submit()
{
	$('#run_box').show();
	
	var methodid = $('#thismethodid').val();
	var all_params = new Object;
	
	$('#apibuilder_method_table tr').not(':first').each(function(index) {
		var method_param = $(this).attr('id');
		var data_update = new Object;
		var required_html;
		
		data_update.name = $('#'+method_param+' .name_edit').val();
		data_update.value = $('#'+method_param+' .value_edit').val();
		
		if (data_update.value != "" && data_update.value != null)
			all_params[data_update.name] = data_update.value;
	});
	
	var json_text = JSON.stringify(all_params, null, 2);
	
	$.ajax({
		url: '/apis/getmethodrequest/'+methodid,
		data: null,
		processData: false,
		dataType: "JSON",
		type: 'GET',
		success: function ( firstpass ) {
			$('#request_text').html(firstpass['urltext']+"\n"+json_text);
			
			doAjaxCall(firstpass, all_params);
		}
	});
	
}

function doAjaxCall(firstpass, all_params)
{
	console.log('url: '+firstpass['fullurl']);
	console.log('type: '+firstpass['type']);
	console.log('params: '+all_params);
	
	
	$.ajax({
		url: firstpass['fullurl'],
		data: all_params,
		type: firstpass['type'],
		success: function ( resultdata ) {
			$('#result_text').html(resultdata);
		}
	});
}

function apibuilder_gui_update(data)
{
	$.ajax({
		url: '/apis/updateAPICall',
		data: data,
//		processData: false,
		type: 'POST',
		success: function ( data ) {
			/*
			$('#apibuilder_bottom_bar').html("API method parameters updated successfully!");
			$('#apibuilder_bottom_bar').fadeIn();
			$('#apibuilder_bottom_bar').fadeOut();
			*/
		}
	});
}

function apibuilder_addrow()
{
	var next_paramid = parseInt($('#maxparamid_unique').val())+1;
	var thismethodid = parseInt($('#thismethodid').val());
	var tablerow = '<tr id="'+thismethodid+'_'+next_paramid+'">';
	tablerow += '<td class="name">';
	tablerow += '		<div class="name_read" style="display:none; padding:0;">paramname</div>';
	tablerow += '		<input name="required" type="input" class="name_edit" value="name" style="width: 90%; display: inline; ">';
	tablerow += '	</td>';
	tablerow += '	<td width="20%" class="type_row">';
	tablerow += '		<div class="type_read" style="display:none; padding:0;">int</div>';
	tablerow += '		<select class="type_edit" name="type" style="width: 140px; display: inline; ">';
	tablerow += '			<option value="int">integer</option>';
	tablerow += '			<option value="double">double</option>';
	tablerow += '			<option value="float">float</option>';
	tablerow += '			<option value="string">string</option>';
	tablerow += '			<option value="boolean">boolean</option>';
	tablerow += '			<option value="blob">data blob</option>';
	tablerow += '		</select>';
	tablerow += '	</td>';
	tablerow += '	<td class="required_row">';
	tablerow += '		<input name="required" type="checkbox" class="required_edit" value="0" style="display: inline; ">';
tablerow += '			<div class="required_read" style="display:none; padding:0;">';
tablerow += '				<span class="label label-info" style="font-size:15px">no</span>';
tablerow += '			</div>';
tablerow += '		</td>';
tablerow += '		<td class="description_row">';
tablerow += '			<div class="description_read" style="display:none; padding:0;">parameter description</div>';
tablerow += '			<input class="description_edit" type="text" size="20" name="description" value="parameter description" style="display: inline; ">';
tablerow += '		</td>';
tablerow += '		<td class="value_row"  style="display:none">';
tablerow += '			<input class="value_edit" type="text" size="20" name="value" value="">';
tablerow += '		</td>';
tablerow += '		<td class="editonly_row">';
tablerow += '			<a class="btn btn-danger" href="#" style="font-size:21px"  onclick="apibuilder_deleterow(\''+thismethodid+'_'+next_paramid+'\');"><i class="icon-trash icon-white"></i></a>';
tablerow += '		</td>';
tablerow += '	</tr>';
	
	$('#apibuilder_method_table').append(tablerow);
	$('#maxparamid_unique').val(parseInt($('#maxparamid_unique').val())+1);
	
}