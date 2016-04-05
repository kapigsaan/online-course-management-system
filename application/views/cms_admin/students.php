
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Students</h1>
    </div>
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
    <div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_admin/classes')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>
    
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
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
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($list): ?>
                            <? foreach ($list as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->username?></td>
                                    <td><?=$v->l_name.', '.$v->f_name.'. '.$v->m_name?></td>
                                    <td><?=$v->userStatus?> &nbsp;&nbsp;
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