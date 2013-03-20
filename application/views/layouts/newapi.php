<div class="row-fluid">
	<div class="span6">
		<div class="hero-unit" style="width:100%">
				<div style="margin-bottom:20px; display:inline"><i class="icon-screenshot icon-large" style="margin-right:-4px; font-size: 26px;"></i> &nbsp;&nbsp;<font style="font-size:25px">Scan your App Codebase</font></div> 
			<br><br>

			<div style="display:inline; font-size:16px;"><span class="label label-info" style="font-size: 16px;">Language</span> <span class="label label-inverse" style="font-size: 13px;">PHP 5.3.6</span></div>
			<div style="display:inline; font-size:16px"><span class="label label-info" style="font-size: 16px;">Framework</span>  <span class="label label-inverse" style="font-size: 13px;">CodeIgniter 2.1</span><br></div><br>
			<div style="display:inline; font-size:16px"><span class="label label-info" style="font-size: 16px;">Version</span> <span class="label label-important" style="font-size: 13px;"><?= md5(date('m/d/y h:i a'))?></span></div>
			<div style="display:inline; font-size:16px"><span class="label label-info" style="font-size: 16px;">Date</span> <span class="label label-important" style="font-size: 13px;"><?= date('m/d/y h:i a')?></span></div>
			
			<br/><br/>
			
			<table class="table table-bordered table-striped">
			    <thead>
			      <tr>
			        <th width="5%"></th>
			        <th width="5%">functions</th>
			        <th>file</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">27</span>
					</td>
			        <td>
			          <code>/application/controllers/apis.php</code>
			        </td>
			      </tr>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">4</span>
					</td>
			        <td>
			          <code>/application/controllers/artists.php</code>
			        </td>
			      </tr>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">9</span>
					</td>
			        <td>
			          <code>/application/controllers/home.php</code>
			        </td>
			      </tr>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">12</span>
					</td>
			        <td>
			          <code>/application/controllers/oauth2.php</code>
			        </td>
			      </tr>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">58</span>
					</td>
			        <td>
			          <code>/application/controllers/parser.php</code>
			        </td>
			      </tr>
			      <tr>
			        <td>
						<input type="checkbox">
			        </td>
					<td>
						<span class="badge badge-important">6</span>
					</td>
			        <td>
			          <code>/application/controllers/songs.php</code>
			        </td>
			      </tr>

			    </tbody>
			  </table>
			
			<br><br>
			<!-- 200 2500 3300 -->
			<a href="#" onclick="$('#resultstab_0').hide(); $('#resultstab_1').delay(200).fadeIn(); $('#resultstab_1').delay(1500).fadeOut('fast'); $('#resultstab').delay(2300).fadeIn('slow');" class="btn btn-primary btn-large">Build API</a>
			</p>
		</div>
	</div>
	<div class="span5" style="margin-left: 8%">
		<div class="hero-unit" style="width:100%;" id="resultstab0">
			<div id="resultstab_0">
					<div style="margin-bottom:20px; display:inline"><i class="icon-cogs icon-large" style="margin-right:-4px; font-size: 22px;"></i> &nbsp;&nbsp;<font style="font-size:25px">"Build API" first</font></div> 
			</div>
			<div id="resultstab_1" style="display: none">
				<div style="margin-bottom:20px; display:inline"><i class="icon-search icon-large" style="margin-right:-4px; font-size: 22px;"></i> &nbsp;&nbsp;<font style="font-size:25px">Parsing Code</font></div> 
				<br><br>
				<div style="display:inline; font-size:36px"><span class="label label-info" style="font-size: 16px;">please wait</span></div>
			</div>
			<div id="resultstab" style="display: none">
				<div style="margin-bottom:20px; display:inline"><i class="icon-cogs icon-large" style="margin-right:-4px; font-size: 22px;"></i> &nbsp;&nbsp;<font style="font-size:25px">Preview API</font></div> 
				<br><br>
				<div style="display:inline; font-size:16px"><span class="label label-info" style="font-size: 16px;">Version</span> <span class="label label-important" style="font-size: 13px;"><?= md5(date('m/d/y h:i a'))?></span></div>
				<br>
				<br>
				<div class="well sidebar-nav">
					<ul class="nav nav-list" style="position:relative; right:5px; width:100%; top:-25px">
						<li class="nav-header" style="font-size: 15px; position:relative; left:-20px; color:crimson;">Method List</li>
						<li class="nav-header" style="font-size: 15px; position:relative; left:-20px">Artists</li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/a03c812ecc35da23971a1f451de9849b"><span class="label label-success" style="position:relative; top: -3px; margin-right: 17px; left:0px">get</span> /artists <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">2 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/0d82a4f2413175c58554b5c724c08a45"><span class="label label-warning" style="position:relative; top: -3px; margin-right: 16px">put</span> /artists <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">2 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/44713712e2293932416913b228ffda82"><span class="label label-important" style="position:relative; top: -3px; margin-right: 2px;">delete</span> /artists <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">2 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li class="nav-header" style="font-size: 15px; position:relative; left:-20px">Songs</li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/f2cdf054d7815cd0bcca1a57b8c324b0"><span class="label label-success" style="position:relative; top: -3px; margin-right: 17px; left:0px">get</span> /songs <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">4 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/46ea753a9446b2536c2071730949db0e"><span class="label label-warning" style="position:relative; top: -3px; margin-right: 16px">put</span> /songs <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">4 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/d00b32a5540331965afc202cc2e83620"><span class="label label-info" style="position:relative; top: -3px; margin-right: 10px">post</span> /songs <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">4 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
						<li style="position:relative; left: -20px"><a href="/apis/builder/method/1f8743b587364416d10e326ce159fea8"><span class="label label-important" style="position:relative; top: -3px; margin-right: 2px;">delete</span> /songs <span class="badge" style="position: relative; top: -3px; display: inline; font-size:11px; float:right" id="">4 parameters</span> <i class="icon-trash icon-white" style="float:right"></i></a></li>
					</ul>
					<a style="float:right"><span class="badge badge-inverse" style="position: relative; top: -3px; display: inline; " id="paramcounttext">2 parameters</span></a>
					<a href="/apis/builder/method/a03c812ecc35da23971a1f451de9849b" class="btn btn-success btn-large" style="float:right">Save & Start Building API</a>
				</div>
						
			</div>

			</p>
		</div>
		
	</div>
</div>
