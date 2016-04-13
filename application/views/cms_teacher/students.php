
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Students</h1>
    </div>
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
    <div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_teacher/classes')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
        <?php echo validation_errors('<div class = "alert alert-danger">')?>
    <p></p>
    </div>
    
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <div id = "ins" class="panel panel-primary" hidden>
            <div class="panel-heading">
                Student's Form
            </div>
            <div class="panel-body">
                
            <form action="" method = "post">
                <div class="row">
                    <div class="col-md-6">
                        <p>*Note Username will be used as password and can be change later</p>
                        <input type = "text" class = "form-control" name = "username" placeholder = "Username & Password" required/>
                    </div>    
                </div>
                <p></p>
                <div class = "row">
                    <div class="col-md-4">
                        <input type = "text" class = "form-control" name = "f_name" placeholder = "First Name"/>
                    </div>
                    <div class="col-md-4">
                        <input type = "text" class = "form-control" name = "m_name" placeholder = "Middle Name"/>
                    </div>
                    <div class="col-md-4">
                        <input type = "text" class = "form-control" name = "l_name" placeholder = "Last Name"/>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
                        <input type = "submit" class = "btn btn-primary" name = "add-studentsubmit" value = "Add Student" />
                        <a href="javascript:;" id = "canc" class = "btn btn-danger" >Cancel</a>
                    </div>
                </div>
            </form>

            </div>
            <div class="panel-footer">
                
            </div>
        </div>

        <!-- /.panel -->
        <a href="javascript:;" id = "show-instructor-form" class = "btn btn-primary">Add Student</a>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($list): ?>
                            <? foreach ($list as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->username?></td>
                                    <td><?=$v->l_name.', '.$v->f_name.'. '.$v->m_name?></td>
                                    <td><?=$v->userStatus?> &nbsp;&nbsp;
                                        <?if($v->userStatus == "active"):?>
                                            <a href="<?=site_url('cms_teacher/change_status/inactive/'.$v->acid.'/'.$v->class_id)?>"><i style = "float:right;" class = "fa fa-lock"></i></a>
                                        <?else:?>
                                            <a href="<?=site_url('cms_teacher/change_status/active/'.$v->acid.'/'.$v->class_id)?>"><i style = "float:right;" class = "fa fa-unlock"></i></a>
                                        <?endif;?>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('cms_teacher/view_student/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-eye"> View </i></a> | 
                                        <a href="<?=site_url('cms_teacher/edit_student/'.$v->class_id.'/'.$v->id)?>"><i class = "fa fa-edit"> Edit </i></a> | 
                                        <a class = "btn confirm" title = "Click here to delete Student" href="<?=site_url('cms_teacher/delete_student/'.$v->class_id.'/'.$v->id.'/'.$v->acc_id)?>"><i class = "fa fa-trash-o"> Delete </i></a>
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

<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
            </div>
            <div class="modal-body">
                Are you sure you want to Delete Student?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary " id = "confirm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id = "closemodal">No</button>
            </div>
        </div>
    </div>
</div>