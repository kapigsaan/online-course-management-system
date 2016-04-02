
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Classes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

 <div class="row">
    <div class="col-lg-12">
        <p><?=$system_message;?></p>
        <form action="" method = "post" role="form">
            <div class="form-group">
                <label>Add Class</label>
                <input class="form-control" name = "class" placeholder="Enter text" required>
                <input style = "margin-top:10px;" type = "submit" class = "btn btn-primary" value = "Submit">
            </div>
        </form>
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
                                <th>Class</th>
                                <th>Manage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($classes): ?>
                            <? foreach ($classes as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->class?></td>
                                    <td>
                                        <a href="<?=site_url('cms_teacher/students/'.$v->id)?>"><i class = "fa fa-group"> Students </i></a> | 
                                        <a href="<?=site_url('cms_teacher/manage_class/'.$v->id)?>"><i class = "fa fa-file-text"> Forums </i></a> | 
                                        <a href="<?=site_url('cms_teacher/materials/'.$v->id)?>"><i class = "fa fa-folder-open"> Course Materials </i></a> 
                                    </td>
                                    <td>
                                        <a href="<?=site_url('cms_teacher/edit_class/'.$v->id)?>"><i class = "fa fa-edit"> Edit </i></a> | 
                                        <a href="<?=site_url('cms_teacher/delete_class/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a> 
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