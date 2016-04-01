
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Forums</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-md-12">
    	<p></p>
    	<a href="<?=site_url('cms_teacher/classes')?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>
    	<p></p>
    <p></p>
    </div>
    <p><?=$system_message;?></p>
</div>


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-primary">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <?php if ($class): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?=$class->topics?></h2>
                            <p><?=nl2br($class->forum_desc)?></p>
                        </div>    
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <!-- /.panel -->
        <?$num = 1?>
        <?php if ($list): ?>
            <?foreach ($list as $key => $v):?>
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
                <?$num++?>
            <?endforeach;?>
        <?php endif ?>
    </div>

    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-success">
            <div class="panel-heading">
            Add Comment
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
