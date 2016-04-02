<?
	$config =& get_config();
	$base_url = isset($config['base_url']) ? $config['base_url'] == '' ? NULL : $config['base_url'] : NULL;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>An Error Occured.</title>
		<link rel="stylesheet" href="<?=$base_url;?>assets/css/error/bootstrap/bootstrap.min.css"/>
		<link rel="stylesheet" href="<?=$base_url;?>assets/css/error/bootstrap/bootstrap-theme.min.css"/>
		<link rel="stylesheet" href="<?=$base_url;?>assets/css/error/error_404.css"/>
	</head>
	<body>
		<div id="wrap">
			<!-- Begin page content -->
			<div class="container">
					<div class="page-header">
						<h2>Browser Not Supported.</h2>
					</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="well" style="margin:20px">
						<p>Sorry For the inconvenience, The system does not support your current browser. We are doing everything we can to fix this issue, meanwhile please use other browsers like <a href="https://www.google.com/intl/en/chrome/browser/#eula" target="_blank"><b>Google Chrome</b></a> or <a href="http://www.mozilla.org/en-US/firefox/new/" target="_blank"><b>Mozilla Firefox</b></a>.</p>
					</div>
				</div>
			</div>
		</div>

		<div id="footer" class="shadow">
			<div class="container">
				<p class="text-muted credit">Copyright &copy; Jnz - Yui@rin <?=date('Y');?></p>
			</div>
		</div>
	</body>
</html>