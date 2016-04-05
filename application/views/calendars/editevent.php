<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update News Bulletin</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<p><?=$system_message;?></p>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<a href="<?=site_url('calendars/index/'.$class)?>" class = "btn btn-danger"><i class = "fa fa-hand-o-left"> Back </i> </a>	
				<p></p>
			</div>
		</div>
	</div>
<?=form_open('calendars/editevent/'.$class)?>
	<div class="row">
		<?php if ($event): ?>
		<div class="col-md-12">
			<input type="hidden" name = "codec" value = "<?=$batch_id?>">
            <div class="col-md-6">
                <label>Start of event</label>
                <input id = "date_start" type="text" class = "form-control" value = "<?=$astart?>" name = "start" required><br>
            </div>
            <div class="col-md-6">
                <label>End of event</label>
                <input id = "date_end" type="text" class = "form-control" value = "<?=$aend?>" name = "end" required><br>
            </div>
            <div class="col-md-12">
                <label>Name of event</label>
                <input type="text" class = "form-control" value = "<?=$atitle?>" name = "title" required><br>
                <label>Decsription/Other message</label>
                <textarea class = "form-control" name = "desc" style="height:250px;"><?=$adesc?></textarea>
                <label>Color</label><br>
                <div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-default" checked><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-default">default</a>
                </div><div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-primary"><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-primary">color 1</a>
                </div><div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-danger"><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-danger">color 2</a>
                </div><div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-warning"><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-warning">color 3</a>
                </div><div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-info"><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-info">color 4</a>
                </div><div class="col-md-2 col-sm-4" style="padding:0px;margin:0px">
                    <input type="radio" name="optradio" value = "btn-success"><a href="#" style = "min-width:100px;" class = "btn btn-mini btn-success">color 5</a>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <br>
                        <input type="submit" class = "btn btn-danger" name = "delete_event" value = "Delete Event">
                        <input type="submit" class = "btn btn-primary" name = "updatecalendar" value = "Update Bulletin">
                    </div>
                </div>
            </div>
        </div> 
		<?php else:?>
		    <h2>You need to choose an event to edit.</h2>
		<?php endif ?>
	</div>  
<?=form_close()?> 