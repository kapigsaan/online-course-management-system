
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Activities</h1>
    </div>
    <p></p>
    <p><?=$system_message;?></p>
    <p></p>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <?php if ($classes): ?>
        	<form action="<?=site_url('cms_teacher/act')?>" method="post">
	        	<div class="col-lg-6">
	        	<!-- <h3>Select Class</h3> -->
	        	<select name = "class" class = "form-control" required>
	        		<option>
	        		<?foreach ($classes as $key => $v):?>
	        			<option value = "<?=$v->id?>"><?=$v->class?></option>
	        		<?endforeach?>
	        	</select>
	        	</div>
	        	<div class="col-lg-6">
	        		<input type="submit" value = "Go to Class" name = "changeclass-btn" class = "btn btn-success" />
	        	</div>
	        	<p></p>
        	</form>
        <?php else: ?>
        	You Have to create class first before you can add activity
        <?php endif ?>
    </div>
</div>
<p></p>
<?php if ($class): ?>
<p></p>
<?php if ($class_name): ?>
	<br/>
	<h3 class="text-center"><?=ucwords($class_name)?></h3>
	<br/>
<?php endif ?>

<p></p>
 <div class="row">
    <div class="col-lg-12">
        <?php echo form_open_multipart('cms_teacher/activity/'.$class);?>
			<div class="row">
    			<div class="col-md-3 text-center">
    				<input type = "text" name="caption" class = "form-control" placeholder = "Caption" />
    			</div>
    			<div class="col-md-4 text-center">
    				<input type = "file" name="file" class = "form-control" />
    			</div>
    			<div class="col-md-3 text-center">
    				<input type = "text" name="deadline" class = "form-control datepick" placeholder = "Deadline" />
    			</div>
    			<div class="col-md-2 text-center">
    				<input type = "submit" name="submit-activity" Value = "Upload" class = "form-control btn btn-primary" />
    			</div>
    			<p></p>
    		</div>
		<?php echo form_close(); ?>
    </div>
</div>

<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	    <p></p>
	        <div class="panel panel-default">
	            <!-- <div class="panel-heading">
	                DataTables Advanced Tables
	            </div> -->
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-accounts">
	                        <thead>
	                            <tr>
	                                <th>Caption</th>
	                                <th>File Name</th>
	                                <th>File Size</th>
	                                <th>Dead Line</th>
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
	                    					<td><?=date('F d, Y',$v->updated_at)?></td>
	                    					<td>
			                        			<a href="<?=assets_url('downloads/activities/'.$v->file); ?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-download"> Download </i></a>
			                        			<a class = "btn confirm" href="<?=site_url('cms_teacher/delete_activity/'.$v->id.'/'.$class)?>" title = "Click here to delete Activity"> <i class = "fa fa-trash-o"> Delete </i></a>
			                        			<a href="<?=site_url('cms_teacher/view_answers/'.$v->id); ?>" ><i class = "fa fa-eye"> View Ansers </i></a>
			                        		</td>
	                    				</tr>
	                    			<?endforeach?>
	                    		<?php endif ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
            </div>
            <div class="modal-body">
                Are you sure you want to Delete Avtivity?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary " id = "confirm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id = "closemodal">No</button>
            </div>
        </div>
    </div>
</div>

<?php endif ?>