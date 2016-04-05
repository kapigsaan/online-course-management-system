
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forums</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_admin/classes')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>
</div>

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
                                <th>Topics</th>
                                <th>Created By</th>
                                <th>Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($list): ?>
                            <? foreach ($list as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->topics?></td>
                                    <td><?=$v->username?></td>
                                    <td><?php echo date('F d, Y',strtotime($v->created_at)); ?></td>
                                    <td>
                                        <a href="<?=site_url('cms_admin/view_forum/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-eye"> View </i></a>
                                    </td>
                                </tr>
                            <? endforeach ?>
                        <?php else:?>
                            No Accounts
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>