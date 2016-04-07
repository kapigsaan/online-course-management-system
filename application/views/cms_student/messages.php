<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
</div>

<!-- /.row -->
<!-- <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow" >
            <div class="panel-heading" style="padding:0px;margin:0px;padding-left:15px;">
                <time class="time" datetime="2013-02-08"><?php echo date('D F d, Y  H:i a',strtotime($v->created_at)); ?></time>
                <time style = "float:right;margin-right:5px;">#<?=$num?></time>
            </div>
            <div class="panel-body" style="padding:0px;margin:0px;">
        		<div class="col-md-2" style="background-color:#faebcc">
        			<h3><?=$v->username?></h3>
        			<p><?=$v->type?></p>
        		</div>
        		<div class="col-md-10">
        			<p><?=nl2br($v->comment)?></p>
        		</div>
            </div>
        </div>
    </div>
</div> -->

 <div class="row">
    <div class="col-lg-12">
        <p><?=$system_message;?></p>
        <form action = "" method = "post" role="form">
            <div class="form-group">
                <label>Send Message</label>
                <input class="form-control" name = "subject" placeholder="Subject" required>
                <p></p>
                <textarea class = "form-control" name = "message" style="height:250px" required></textarea>
                <p></p>
                <div class="row">
                    <div class="col-md-2"><label>Sent To : </label></div>
                    <div class="col-md-4">
                        <select name = "msg-to" class = "form-control" required>
                            <?php if ($students): ?>

                                <? foreach ($students as $key => $v):  ?>
                                    <option value = "<?=$v->acid?>"><?=$v->l_name.', '.$v->f_name?></option>
                                <?endforeach; ?>

                            <?php endif; ?>
                        </select>    
                    </div>
                </div>
                <p></p>
                <input type = "submit" class = "btn btn-primary" name = "btn-submit-messages" value = "Send">
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
                                <th>Subject</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($messages): ?>
                            <? foreach ($messages as $key => $v): ?> 
                                <tr class="gradeC">
                                    <td><?=$v->subject?></td>
                                    <?php if ($v->from == $me): ?>
                                        <td>Me</td>
                                    <?php else:?>
                                        <?php if ($accounts): ?>
                                            <? foreach ($accounts as $k => $ac): ?>
                                                <?php if ($ac->acid == $v->from): ?>
                                                    <td><?=$ac->l_name.', '.$ac->f_name?></td>
                                                <?php endif; ?>
                                            <? endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($v->to == $me): ?>
                                        <td>Me</td>
                                    <?php else:?>
                                        <?php if ($accounts): ?>
                                            <? foreach ($accounts as $k => $ac): ?>
                                                <?php if ($ac->acid == $v->to): ?>
                                                    <td><?=$ac->l_name.', '.$ac->f_name?></td>
                                                <?php endif; ?>
                                            <? endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>  
                                    
                                    <td><?php echo date('F d, Y',strtotime($v->created_at)); ?></td>
                                    <td>
                                        <a href="<?=site_url('cms_student/view_conversation/'.$v->id)?>"><i class = "fa fa-eye"> View Message </i></a>
                                        <a href="<?=site_url('cms_student/delete_conversation/'.$v->id)?>"><i class = "fa fa-trash-o"> Delete </i></a> 
                                    </td>
                                </tr>
                            <? endforeach; ?>
                        <?php else:?>
                            No Message
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>