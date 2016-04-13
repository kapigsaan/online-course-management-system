
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
     <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
</div>

<div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_teacher/messages')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <?php if ($messages): ?>
            <?foreach ($messages as $key => $v):?>
                <?php if ($v->from == $me): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-green " >
                                <div class="panel-heading" style="padding:0px;margin:0px;padding-left:15px;">
                                    <time class="time" datetime="2013-02-08"><?php echo date('D F d, Y  H:i a',strtotime($v->created_at)); ?></time>
                                </div>
                                <div class="panel-body" >
                                    <div class="col-md-12" >
                                        <p><?=nl2br($v->message)?></p>
                                    </div>
                                </div>
                                <div class="pannel-footer text-right">
                                    <div style="padding-right:10px;padding-left:10px;">
                                        <?php if ($accounts): ?>
                                            <? foreach ($accounts as $k => $ac): ?>
                                                <?php if ($ac->acid == $v->from): ?>
                                                    <?=$ac->l_name?>
                                                <?php endif; ?>
                                            <? endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? else: ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary " >
                                <div class="panel-heading" style="padding:0px;margin:0px;padding-left:15px;">
                                    <time class="time" datetime="2013-02-08"><?php echo date('D F d, Y  H:i a',strtotime($v->created_at)); ?></time>
                                </div>
                                <div class="panel-body" >
                                    <div class="col-md-12" >
                                        <p><?=nl2br($v->message)?></p>
                                    </div>
                                </div>
                                <div class="pannel-footer text-right">
                                    <div style="padding-right:10px;padding-left:10px;">
                                        <?php if ($accounts): ?>
                                            <? foreach ($accounts as $k => $ac): ?>
                                                <?php if ($ac->acid == $v->from): ?>
                                                    <?=$ac->l_name?>
                                                <?php endif; ?>
                                            <? endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?endforeach?>
        <?else:?>
            NO Conversation Yet.. 
        <?php endif ?>
    </div>

	<div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-red">
            <div class="panel-heading">
            Message
            </div>
            <div class="panel-body">
            	<form action="" method="post">
            		<p></p>
            		<textarea class = "form-control" name = "reply" style="height:250px" required></textarea>
            		<p></p>
            		<input type = "submit" name = "btn-reply-messages" class = "btn btn-primary" style="float:right;" value = "Send">
            	</form>
            </div>
        </div>
    </div>

</div>
