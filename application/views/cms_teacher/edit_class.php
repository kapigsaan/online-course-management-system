
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Class</h1>
    </div>
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                Class Update Form
            </div>
            <div class="panel-body">
                
            <form action="" method = "post">
                <?php if ($class): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name = "class" placeholder="Enter text" value = "<?=$class?>" required>
                        </div>    
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <input type = "submit" class = "btn btn-primary" name = "update-classsubmit" value = "Update Class" />
                            <a href="<?=site_url('cms_teacher/classes')?>" class = "btn btn-danger" >Cancel</a>
                        </div>
                    </div>
                <?php endif ?>
            </form>

            </div>
            <div class="panel-footer">
                
            </div>
        </div>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($classes): ?>
                            <? foreach ($classes as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->class?></td>
                                    <td>
                                        <a href="<?=site_url('cms_teacher/edit_class/'.$v->id)?>"><i class = "fa fa-edit"> Edit </i></a> 
                                        <a href="<?=site_url('cms_teacher/manage_class/'.$v->id)?>"><i class = "fa fa-cogs"> Manage </i></a> 
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