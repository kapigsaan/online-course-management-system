<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Classes</h1>
    </div>
    <!-- /.col-lg-12 -->
    <p></p>
</div>
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
<p></p>

 <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Classes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-accounts">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($classes): ?>
                                <?php $cls = NULL ?>
                                <?foreach ($classes as $key => $v):?>
                                    <?php if ($myclasses): ?>
                                        <?$cls = $myclasses($v->id)?>
                                    <?php endif ?>
                                    <tr>
                                        <td><?=$v->class?></td>
                                        <td>
                                            <?php if ($cls): ?>
                                                <?php if ($cls->join): ?>
                                                    Joined
                                                <?php endif ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($cls): ?>
                                                <?php if ($cls->status): ?>
                                                    <i class = "fa fa-check">Class in Use</i>
                                                <?php endif ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($cls): ?>
                                                <?php if ($cls->join): ?>
                                                    <?php if ($cls->status): ?>
                                                        <a class="btn btn-success" href="<?=site_url('cms_student/use_class/'.$v->id)?>">Use Class</a> |
                                                    <?php endif ?>
                                                <? else: ?>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_<?=$v->id?>">Join Class</button>
                                                <?php endif ?>
                                            <?else:?>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_<?=$v->id?>">Join Class</button>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?endforeach?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>

<?php if ($classes): ?>

    <?foreach ($classes as $key => $v):?>

        <div class="modal fade" id="modal_<?=$v->id?>" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Join Class <?=$v->class?></h5>
                    </div>

                    <div class="modal-body">
                        <!-- The form is placed inside the body of modal -->
                        <form action="<?=site_url('cms_student/index')?>" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Code</label>
                                <div class="col-xs-5">
                                    <input type="hidden" class="form-control" name="class_id" value = "<?=$v->id?>"/>
                                    <input type="hidden" class="form-control" name="right_code" value = "<?=$v->code?>"/>
                                    <input type="text" class="form-control" name="code" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-5 col-xs-offset-3">
                                    <input type="submit" name = "submit-code" class="btn btn-primary" value = "Join"/>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?endforeach?>

<?php endif ?>