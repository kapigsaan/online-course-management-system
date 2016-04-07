
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Messaging</h1>
    </div>
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
                <div class="panel-body" style="padding:0px;margin:0px;">
        			<div class="col-md-12" style="background-color:#faebcc">
        				<p><?=$messages->message?></p>
        			</div>
                </div>
                <div class="pannel-footer">
                <?php if ($accounts): ?>
                    <? foreach ($accounts as $k => $ac): ?>
                        <?php if ($ac->acid == $messages->from): ?>
                            <?=$ac->l_name.', '.$ac->f_name?>
                        <?php endif; ?>
                    <? endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        <?php endif ?>
    </div>

    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-red">
            <div class="panel-heading">
            Reply
            </div>
            <div class="panel-body">
            	<form action="" method="post">
            		<textarea class = "form-control" name = "comment" style="height:250px" required></textarea>
            		<p></p>
            		<input type = "submit" name = "submit-comment" class = "btn btn-primary" style="float:right;" value = "Submit Comment">
            	</form>
            </div>
        </div>
    </div>
</div>
