
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Students</h1>
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
                        <input type = "text" class = "form-control" name = "fname" placeholder = "First Name"/>
                    </div>
                    <div class="col-md-4">
                        <input type = "text" class = "form-control" name = "mname" placeholder = "Middle Name"/>
                    </div>
                    <div class="col-md-4">
                        <input type = "text" class = "form-control" name = "lname" placeholder = "Last Name"/>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
                        <input type = "submit" class = "btn btn-primary" name = "add-instructorsubmit" value = "Add Instructor" />
                        <a href="javascript:;" id = "canc" class = "btn btn-danger" >Cancel</a>
                    </div>
                </div>
            </form>

            </div>
            <div class="panel-footer">
                
            </div>
        </div>

        <!-- /.panel -->
        <!-- <a href="javascript:;" id = "show-instructor-form" class = "btn btn-primary">Add Student</a> -->
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
                                <th>UserType</th>
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
                                    <td><?=$v->type?></td>
                                    <td><?=$v->userStatus?> &nbsp;&nbsp;
                                        <?if($v->userStatus == "active"):?>
                                            <a href="<?=site_url('cms_admin/change_status/student/inactive/'.$v->acid)?>"><i style = "float:right;" class = "fa fa-lock"></i></a>
                                        <?else:?>
                                            <a href="<?=site_url('cms_admin/change_status/student/active/'.$v->acid)?>"><i style = "float:right;" class = "fa fa-unlock"></i></a>
                                        <?endif;?>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('cms_admin/view_student/'.$v->acid)?>"><i class = "fa fa-eye"> View Student </i></a>
                                        <!-- <a href="<?=site_url('cms_admin/edit_instructor/'.$v->acid)?>"><i class = "fa fa-edit"> Edit </i></a>
                                        <a href="<?=site_url('cms_admin/delete_instructor/'.$v->acid)?>"><i class = "fa fa-trash-o"> Delete </i></a> -->
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