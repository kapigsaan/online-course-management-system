<style>
p
{
	background: #93C0FF;
	border:3px solid #95C2FF;
	padding:10;
	margin:10;
}
label{
	font-weight:bold;
	margin-top:5px;
}
</style>
<fieldset>
	<legend>Error</legend>
	<label>Severity</label>
	<p><?=$severity;?></p>
	<label>Message</label>
	<p><?=$message;?></p>
	<label>Filename</label>
	<p><?=$filepath;?></p>
	<label>Line Number</label>
	<p><?=$line;?></p>
</fieldset>