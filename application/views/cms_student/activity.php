
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Activities</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
</div>

<div class="row" id = "show-upload-answer" hidden>
    <div class="col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Upload Answer
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <?php echo form_open_multipart('cms_student/activity/');?>
                    <div class="row">
                        <div class="col-md-6">
                            <input type = "hidden" id = "act-value" name = "act_id" class = "form-control" required/>
                            <input type = "text" name = "caption" class = "form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <input type = "file" name = "file" class = "form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <p></p>
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <input type = "submit" class = "btn btn-primary" name = "upload-act-ans" value = "Upload" />
                            <a href="javascript:;" id = "cans" class = "btn btn-danger" >Cancel</a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Activities
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-accounts">
                        <thead>
                            <tr>
                                <th>Caption</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if ($activities): ?>
                    			<?foreach ($activities as $key => $v):?>
                    				<tr>
                    					<td><?=$v->caption?></td>
                    					<td><?=$v->file?></td>
                    					<td><?=$v->file_size?></td>
                    					<td>
		                        			<a href="<?php echo assets_url('downloads/activities/'.$v->file); ?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-download"> Download </i></a> | 
		                        			<a href="javascript:;" url = "<?=$v->id?>" id = "upload-answer" ><i class = "fa fa-upload"> Upload Answer </i></a>
		                        		</td>
                    				</tr>
                    			<?endforeach?>
                    		<?php endif ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
