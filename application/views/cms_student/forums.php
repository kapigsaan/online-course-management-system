
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forums</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

 <div class="row">
    <div class="col-lg-12">
        <p><?=$system_message;?></p>
        <form action="" method = "post" role="form">
            <div class="form-group">
                <label>Add Topic</label>
                <input class="form-control" name = "topic" placeholder="Enter text" required>
                <label>Description</label>
                <textarea class="form-control" name = "forum_desc" style = "height:250px;"></textarea>
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
                                <th>Topics</th>
                                <th>Start Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($list): ?>
                            <? foreach ($list as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->topics?></td>
                                    <td><?php echo date('F d, Y',strtotime($v->created_at)); ?></td>
                                    <td>
                                        <a href="<?=site_url('cms_student/view_forum/'.$v->id)?>"><i class = "fa fa-eye"> View </i></a>
                                        <?php if ($my_forum == $v->created_by): ?>
                                             | 
                                            <a href="<?=site_url('cms_student/edit_forum/'.$v->id)?>"><i class = "fa fa-edit"> Edit </i></a> | 
                                            <a href="<?=site_url('cms_student/delete_forum/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a> 
                                        <?php endif ?>
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