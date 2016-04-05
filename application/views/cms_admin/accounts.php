
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Accounts</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
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
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>UserType</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($list): ?>
                            <? foreach ($list as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->username?></td>
                                    <td><?=$v->l_name.', '.$v->f_name.'. '.$v->m_name?></td>
                                    <td><?=$v->type?></td>
                                    <td><?=$v->userStatus?> &nbsp;&nbsp;
                                       <!--  <?if($v->userStatus == "active"):?>
                                            <a href="<?=site_url('cms_admin/change_status/accounts/inactive/'.$v->acid)?>"><i style = "float:right;" class = "fa fa-lock"></i></a>
                                        <?else:?>
                                            <a href="<?=site_url('cms_admin/change_status/accounts/active/'.$v->acid)?>"><i style = "float:right;" class = "fa fa-unlock"></i></a>
                                        <?endif;?> -->
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