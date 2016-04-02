<div class="panel">
	<p><a href="<?=site_url('cms_admin');?>" class="btn btn-success"><strong>Exit</strong></a></p>
</div>

<?php
foreach($map as $key=>$val):
echo nl2br(read_file("system_logs/".$val));
endforeach;
?>