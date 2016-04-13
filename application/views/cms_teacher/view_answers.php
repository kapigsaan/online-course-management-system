<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Answers</h1>
    </div>
    <p></p>
    <p><?=$system_message;?></p>
    <p></p>
    <!-- /.col-lg-12 -->
</div>


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
    <p></p>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-accounts">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Date Submitted</th>
                                <th>Caption</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if ($answers): ?>
                    			<?foreach ($answers as $key => $v):?>
                    				<tr>
                    					<td><?=$v->l_name.', '.$v->f_name?></td>
                    					<td><?=$v->subm?></td>
                    					<td><?=$v->caption?></td>
                    					<td><?=$v->file?></td>
                    					<td><?=$v->file_size?></td>
                    					<td>
		                        			<a href="<?=assets_url('downloads/answers/'.$v->file); ?>" title="<?=$v->caption;?>" target="_blank"><i class = "fa fa-download"> Download </i></a>
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