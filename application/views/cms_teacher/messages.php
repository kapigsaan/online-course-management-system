<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
</div>

<!-- /.row -->
<!-- <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow" >
            <div class="panel-heading" style="padding:0px;margin:0px;padding-left:15px;">
                <time class="time" datetime="2013-02-08"><?php echo date('D F d, Y  H:i a',strtotime($v->created_at)); ?></time>
                <time style = "float:right;margin-right:5px;">#<?=$num?></time>
            </div>
            <div class="panel-body" style="padding:0px;margin:0px;">
        		<div class="col-md-2" style="background-color:#faebcc">
        			<h3><?=$v->username?></h3>
        			<p><?=$v->type?></p>
        		</div>
        		<div class="col-md-10">
        			<p><?=nl2br($v->comment)?></p>
        		</div>
            </div>
        </div>
    </div>
</div> -->

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
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
                                <th>Subject</th>
                                <th>From</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($messages): ?>
                            <? foreach ($messages as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->subject?></td>
                                    <td><?=$v->from?></td>
                                    <td><?php echo date('F d, Y',strtotime($v->created_at)); ?></td>
                                    <td>
                                        <a href="<?=site_url('cms_teacher/view_forum/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-eye"> View </i></a> | 
                                        <a href="<?=site_url('cms_teacher/edit_forum/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-return"> Reply </i></a> | 
                                        <a href="<?=site_url('cms_teacher/delete_forum/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a> 
                                    </td>
                                </tr>
                            <? endforeach ?>
                        <?php else:?>
                            No Message
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>