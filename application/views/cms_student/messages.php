<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
</div>

 <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>


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
                                <th>Name</th>
                                <!-- <th>From</th>
                                <th>To</th>
                                <th>Date</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($instructors): ?>
                            <?foreach ($instructors as $key => $v):?>
                                <tr class="gradeC">
                                    <td><?=$v->l_name.', '.$v->f_name?></td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                    <td>
                                        <a href="<?=site_url('cms_student/view_conversation/'.$v->acid)?>"><i class = "fa fa-eye"> View Message </i></a>
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