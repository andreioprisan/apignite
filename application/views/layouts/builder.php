<div class="row-fluid">
	<div class="span3">
		<div style="display:inline; font-size:16px"><span class="label label-info" style="font-size: 16px;">Version</span> <span class="label label-important" style="font-size: 13px;"><?= md5(date('m/d/y h:i a'))?></span></div><br><br>
		
		<div class="well sidebar-nav">
			<ul class="nav nav-list" style="position:relative; right:5px; width:100%; top:-25px">
				<li class="nav-header" style="font-size: 15px; position:relative; left:-20px; color:crimson;">Method List
				</li><?= $apisidemenu ?>
			</ul>
			<a href="#" class="btn btn-primary">Add Method</a>
		</div><!--/.well -->
	</div><!--/span-->
	<div class="span9">
		<form name="apibuilder" action="get" method="#" onsubmit="return false;">
		<input type="hidden" id="maxparamid_unique" value="<?= $maxparamid_unique ?>">
		<input type="hidden" id="thismethodid" value="<?= $thismethodid ?>">
		<div style="position: absolute; right: 33px; display:inline;">
			<div class="btn-group" data-toggle="buttons-radio">
			  <button class="btn btn-primary active" onclick="switch2mode('run'); apibuilder_edit_submit(); return false;" id="apibuilder_action" value="run">run</button>
			  <button class="btn btn-danger" onclick="switch2mode('edit'); return false;" id="apibuilder_action" value="edit">edit</button>
			</div>
		</div>
		<h2>
			Method
		</h2><br>
		<?= $apimethodslide ?>
		<h2>
			Parameters
		</h2><br>
		<table id="apibuilder_method_table" class="table table-bordered">
			<thead>
				<tr style="font-size:15px">
					<th class="name_header" width="40%">
						Name
					</th>
					<th class="type_header" width="15%">
						Type
					</th>
					<th class="required_header" width="3%">
						Required?
					</th>
					<th class="description_header" width="25%">
						Description
					</th>
					<th class="value_header" width="30%">
						Value
					</th>
					<th class="editonly_header" width="3%">
						
					</th>
				</tr>
			</thead>
			<tbody>
				<?php // var_dump($apiparams); ?>
				<?php foreach($apiparams as $param) {?>
				<tr id="<?= $param->method_id ?>_<?= $param->param_id ?>">
<!--					<input type="hidden" id="param" value="<?= $param->name ?>">-->
					<td class="name">
						<div class="name_read" style="display:inline; padding:0;"><?= $param->name ?></div>
						<input name="required" type="input" class="name_edit" value="<?= $param->name ?>" style="width: 90%; ">
					</td>
					<td width="20%" class="type_row">
						<div class="type_read" style="display:inline; padding:0;"><?= $param->type ?></div>
						<select class="type_edit" name="type" style="width: 140px">
							<?php $types = array(	'int' => 'integer',
													'double' => 'double',
													'float' => 'float',
													'string' => 'string',
													'boolean' => 'boolean',
													'blob' => 'data blob'
												);?>
							<?php foreach ($types as $tval => $ttext) { ?>
							<option value="<?= $tval ?>" <?php if ($param->type == $tval)  echo 'selected' ?>><?= $ttext ?></option>
							<?php } ?>
						</select>
					</td>
					<td class="required_row">
						<input name="required" type="checkbox" class="required_edit" value="<?= $param->required ?>" <?php if ($param->required == "1") { echo "checked"; }?>>
						<div class="required_read" style="display:inline; padding:0;">
						<?php if ($param->required == "1") { ?>
							<span class="label label-important" style="font-size:15px">yes</span>
						<?php } else { ?>
							<span class="label label-info" style="font-size:15px">no</span>
						<?php } ?>	
						</div>
					</td>
					<td class="description_row">
						<div class="description_read" style="display:inline; padding:0;"><?= $param->description ?></div>
						<input class="description_edit" type="text" size="20" name="description" value="<?= $param->description ?>">
					</td>
					<td class="value_row">
						<input class="value_edit" type="text" size="20" name="value" value="<?= $param->value ?>">
					</td>
					<td class="editonly_row">
						<a class="btn btn-danger" href="#" style="font-size:21px" onclick="apibuilder_deleterow('<?= $param->method_id ?>_<?= $param->param_id ?>');"><i class="icon-trash icon-white"></i></a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<input type="submit" id="mainsubmitbutton" class="btn-large btn-primary" value="Run!" onclick="apibuilder_run_submit();">
		</form>
		<a href="#" id="apibuilder_addparam" class="btn-large btn-primary" value="Add Parameter" onclick="apibuilder_addrow();" style="display: none">Add Parameter</a>
		<div id="apibuilder_bottom_bar" class="alert alert-success" style="font-size:18px; display:none"></div>

		<div id="run_box" style="display:none">
			<h2>Request</h2>
			<pre id="request_text">request details here</pre>
			<br/><br/>
			<h2>Result</h2>
			<pre id="result_text">result details here</pre>
		</div>
	</div><!--/span-->
</div>
