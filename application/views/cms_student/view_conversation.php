
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
</div>

<div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_student/messages')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <?php if ($messages): ?>
            <div class="panel panel-primary col-md-" >
                <div class="panel-heading" style="padding:0px;margin:0px;padding-left:15px;">
                    <time class="time" datetime="2013-02-08"><?php echo date('D F d, Y  H:i a',strtotime($messages->created_at)); ?></time>
                </div>
                <div class="panel-body" >
        			<div class="col-md-12" >
        				<p><?=$messages->message?></p>
        			</div>
                </div>
                <div class="pannel-footer text-right">
                <?php if ($accounts): ?>
                    <? foreach ($accounts as $k => $ac): ?>
                        <?php if ($ac->acid == $messages->from): ?>
                            FROM : <?=$ac->l_name.', '.$ac->f_name?>
                        <?php endif; ?>
                    <? endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    <?php if ($messages->from == $me): ?>
    <?php else:?>
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-red">
                <div class="panel-heading">
                Reply
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <input type = "hidden" name = "msg-to" value = "<?=$messages->from?>" required/>
                        <input type = "text" name = "subject" placeholder = "Subject" required/>
                        <p></p>
                        <textarea class = "form-control" name = "reply" style="height:250px" required></textarea>
                        <p></p>
                        <input type = "submit" name = "btn-reply-messages" class = "btn btn-primary" style="float:right;" value = "Send">
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
