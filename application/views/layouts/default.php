<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?= $title ?></title>
	<?php foreach($css as $link): ?>
	<link type="text/css" rel="stylesheet" href="/assets/css/<?= $link ?>.css" />
	<?php endforeach; ?>
	<?php foreach($js as $link): ?>
	<script type="text/javascript" src="/assets/js/<?= $link ?>.js"></script>
	<?php endforeach; ?>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29444973-1']);
	  _gaq.push(['_setDomainName', 'apignite.com']);
	  _gaq.push(['_setAllowLinker', true]);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
	    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="/" style="position: relative; left:-20px">APIgnite</a>
		<div class="nav-collapse">
		<?php if (isset($menu) && count($menu) > 0) { ?>
		
		<ul class="nav" style="position:absolute; left: -30%;">
			<?php 
			foreach ($menu as $menuitem_val) {
			
			if (isset($menuitem_val['username']))
				continue;

			if (isset($menuitem_val['calorietracker']))
				continue;

			if ($menuitem_val['align'] == "right")
				continue;
					
			if (isset($menuitem_val['name']) && isset($menuitem_val['val'])) {
				if (is_array($menuitem_val['val']))
				{ ?>
				<li class="dropdown" style="padding-right: 30px;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $menuitem_val['name'] ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php 
						foreach ($menuitem_val['val'] as $menuitem_dropdown) { ?>
							<?php if (!isset($menuitem_dropdown['val']) && !isset($menuitem_dropdown['name'])) {?>
								<li class="divider"></li>
							<?php } else { 
								?>
								<li><a href="<?= $menuitem_dropdown['val']?>"><?= $menuitem_dropdown['name']?></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				</li>
				<?php } else { ?>
						<li><a href="<?= $menuitem_val['val'] ?>"><?= $menuitem_val['name'] ?></a></li>
				<?php }
				}
			} ?>
		</ul>
		<?php 
		} ?>
		<ul class="nav pull-right">
			<?php 
			if ((isset($menuitem_val) && count($menuitem_val) > 0)) 
			{
				foreach ($menu as $menuitem_val) 
				{ 
				?>
				<?php if (isset($menuitem_val['align']) && $menuitem_val['align'] == "right") { ?>
					<?php if (isset($menuitem_val['username'])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">me <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Your Profile</a></li>
							<li class="divider"></li>
							<li><a href="#">Account Settings</a></li>
							<li><a href="/facebook_auth/logout">Log Out</a></li>
						</ul>
					</li>
					<?php } else { ?>
					<?php 
					if (isset($menuitem_val['login'])) { ?>
						<li><a href="<?= $menuitem_val['val'] ?>"><?= $menuitem_val['name'] ?></a></li>
					<?php } else { ?>
						<?php if (is_array($menuitem_val['val']))
						{ ?>
						<li class="dropdown" style="padding-right: 5px;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $menuitem_val['name'] ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php 
								foreach ($menuitem_val['val'] as $menuitem_dropdown) { ?>
									<?php if (!isset($menuitem_dropdown['val']) && !isset($menuitem_dropdown['name'])) {?>
										<li class="divider"></li>
									<?php } else { 
										?>
										<li><a href="<?= $menuitem_dropdown['val']?>"><?= $menuitem_dropdown['name']?></a></li>
									<?php } ?>
								<?php } ?>
							</ul>
						</li>
						<?php } else { ?>
								<li><a href="<?= $menuitem_val['val'] ?>"><?= $menuitem_val['name'] ?></a></li>
						<?php } ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			<?php } 
			} ?>
		</ul>
		</div>

    </div>
  </div>
</div>
<br>
<br>

<div class="container">
	<div class="content" style="min-height: 530px;">
		<?= $alertitemadd ?>

		<?= $start ?>

		<?= $dashboard ?>

		<?= $nikeplussync ?>
		<?= $nikeplusruns ?>
		
		<?= $nutritionsearch ?>
		
		<?= $login ?>

		<?= $nutrition ?>
		<?= $nutritionlog ?>
		<?= $nutritionfavorites ?>
		<?= $workout ?>
		<?= $workoutlog ?>
		<?= $workoutfavorites ?>

		<?= $privacy ?>
		<?= $tos ?>


	</div>



	
</div> 

<?= $content ?>

<footer>
      <div class="footer-content">
        <ul>
          <li class="">
            <a href="#">&copy; apignite 2012</a>
          </li>
        </ul>
		<div class="footer-pages">
			<a class="branding" href="/privacy">privacy</a>
			<a class="branding" href="/tos">terms</a>
		</div>
      </div>
    </footer>

</body>
</html>