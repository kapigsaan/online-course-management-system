
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Course Outline</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
</div>

<!-- /.row -->
<div class="row">
	<div class="col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Outline
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
                        	<?php if ($course_outline): ?>
                    			<?foreach ($course_outline as $key => $v):?>
                    				<tr>
                    					<td><?=$v->caption?></td>
                    					<td><?=$v->file?></td>
                    					<td><?=$v->file_size?></td>
                    					<td>
		                        			<a href="<?php echo assets_url('downloads/outline/'.$v->file); ?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-eye"> View </i></a> | 
                                            <a href="<?=site_url('cms_student/download/outline/'.$v->file)?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-download"> Download </i></a>
		                        			<!-- <a href="<?=site_url('cms_teacher/delete_outline/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a> -->
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
