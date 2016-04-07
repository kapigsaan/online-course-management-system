
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Course Materials</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
    <div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_admin/classes')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>
</div>

<!-- /.row -->
<div class="row">
	<div class="col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Materials
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Course Syllabus</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab">Course Content / Materials</a>
                    </li>
                    <li><a href="#messages" data-toggle="tab">Course Outline</a>
                    </li>
                    <li><a href="#Videos" data-toggle="tab">Videos</a>
                    </li>
                    <li><a href="#images" data-toggle="tab">Images</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                    	<p></p>
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
		                        	<?php if ($list): ?>
	                        			<?foreach ($list as $key => $v):?>
	                        				<tr>
	                        					<td><?=$v->caption?></td>
	                        					<td><?=$v->file?></td>
	                        					<td><?=$v->file_size?></td>
	                        					<td>
				                        			<a href="<?php echo assets_url('downloads/syllabus/'.$v->file); ?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-download"> View </i></a>
				                        			<a href="<?=site_url('cms_teacher/delete_syllabus/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
				                        		</td>
	                        				</tr>
	                        			<?endforeach?>
	                        		<?php endif ?>
		                        </tbody>
		                    </table>
		                </div>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <p></p>
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
		                        	<?php if ($course_content): ?>
	                        			<?foreach ($course_content as $key => $v):?>
	                        				<tr>
	                        					<td><?=$v->caption?></td>
	                        					<td><?=$v->file?></td>
	                        					<td><?=$v->file_size?></td>
	                        					<td>
				                        			<a href="<?php echo assets_url('downloads/content/'.$v->file); ?>" title="<?=$download->caption;?>" target="_blank"><i class = "fa fa-download"> View </i></a>
				                        			<a href="<?=site_url('cms_teacher/delete_content/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
				                        		</td>
	                        				</tr>
	                        			<?endforeach?>
	                        		<?php endif ?>
		                        </tbody>
		                    </table>
		                </div>
                    </div>
                    <div class="tab-pane fade" id="messages">
                        <p></p>
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
				                        			<a href="<?php echo assets_url('downloads/outline/'.$v->file); ?>" title="<?=$download->caption;?>" target="_blank"><i class = "fa fa-download"> View </i></a>
				                        			<a href="<?=site_url('cms_teacher/delete_outline/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
				                        		</td>
	                        				</tr>
	                        			<?endforeach?>
	                        		<?php endif ?>
		                        </tbody>
		                    </table>
		                </div>
                    </div>
                    <div class="tab-pane fade" id="Videos">
                        <p></p>
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
		                        	<?php if ($videos): ?>
	                        			<?foreach ($videos as $key => $v):?>
	                        				<tr>
	                        					<td><?=$v->caption?></td>
	                        					<td><?=$v->file?></td>
	                        					<td><?=$v->file_size?></td>
	                        					<td>
				                        			<a href="<?php echo assets_url('downloads/videos/'.$v->file); ?>" title="<?=$download->caption;?>" target="_blank"><i class = "fa fa-download"> View </i></a>
				                        			<a href="<?=site_url('cms_teacher/delete_videos/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
				                        		</td>
	                        				</tr>
	                        			<?endforeach?>
	                        		<?php endif ?>
		                        </tbody>
		                    </table>
		                </div>
                    </div>
                    <div class="tab-pane fade" id="images">
                        <p></p>
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
		                        	<?php if ($images): ?>
	                        			<?foreach ($images as $key => $v):?>
	                        				<tr>
	                        					<td><?=$v->caption?></td>
	                        					<td><?=$v->file?></td>
	                        					<td><?=$v->file_size?></td>
	                        					<td>
				                        			<a href="<?php echo assets_url('downloads/images/'.$v->file); ?>" title="<?=$download->caption;?>" target="_blank"><i class = "fa fa-download"> View </i></a>
				                        			<a href="<?=site_url('cms_teacher/delete_images/'.$class.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
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
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
