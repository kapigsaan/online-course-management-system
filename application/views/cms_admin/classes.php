
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Classes</h1>
    </div>
    <!-- /.col-lg-12 -->
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
                                <th>Class</th>
                                <th>Created By</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($classes): ?>
                            <? foreach ($classes as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->class?></td>
                                    <td><?=$v->l_name.', '.$v->f_name .' '.$v->m_name?></td>
                                    <td>
                                        <a href="<?=site_url('cms_admin/students/'.$v->id)?>"><i class = "fa fa-group"> Students </i></a> | 
                                        <a href="<?=site_url('cms_admin/forums/'.$v->id)?>"><i class = "fa fa-file-text"> Forums </i></a> | 
                                        <a href="<?=site_url('cms_admin/materials/'.$v->id)?>"><i class = "fa fa-folder-open"> Course Materials </i></a> | 
                                        <a href="<?=site_url('calendars/index/'.$v->id)?>"><i class = "fa fa-newspaper-o"> News Bulletin </i></a>
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