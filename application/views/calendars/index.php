<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">News Bulletin</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<p><?=$system_message;?></p>

<div id = "calendar-form" class="row" hidden>
    <?=form_open('')?>
        <div class="col-md-12">
            <div class="col-md-6">
                <label>Start of event</label>
                <input id = "date_start" type="text" class = "form-control" name = "start" required><br>
            </div>
            <div class="col-md-6">
                <label>End of event</label>
                <input id = "date_end" type="text" class = "form-control" name = "end" required><br>
            </div>
            <div class="col-md-12">
                <label>Name of event</label>
                <input type="text" class = "form-control" name = "title" required><br>
                <label>Decsription/Other message</label>
                <textarea class = "form-control" name = "desc" style="height:250px;"></textarea>
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
                        <a href="javascript:;" class = "btn btn-danger" id = "cancel">Cancel</a>
                        <input type="submit" class = "btn btn-primary" name = "updatecalendar" value = "Add and Update Callendar">
                    </div>
                </div>
            </div>
        </div>        
    <?=form_close()?> 
</div>

<a href="javascript:;" id = "show-calendar-form" class = "btn btn-primary">Add News or Events</a>

 <div class="row">
    <div class="col-lg-12">
        
        <center><h2>Calendar</h2></center>
        <div class="text-center">
            <?=$cal?>

            <?$links?>
        </div>
    </div>
</div>


<style>
#qwe{
	margin-left:-15px !important;
}
.calendar {
    font-family: Arial, Verdana, Sans-serif;
    width:100%;
    min-width: 500px;
    border-collapse: collapse;
    overflow: scroll;
}

.calendar tbody tr:first-child th {
    color: #505050;
    margin: 0 0 10px 0;
}

.day_header {
    font-weight: normal;
    text-align: center;
    color: #757575;
    font-size: 15px;
}

.calendar td {
    width: 14%; /* Force all cells to be about the same width regardless of content */
    border:1px solid #CCC;
    height: 100px;
    vertical-align: top;
    font-size: 10px;
    padding: 0;
}

.calendar td:hover {
    background: #9a9a9a;
}

.day_listing {
    display: block;
    text-align: right;
    font-size: 12px;
    color: #2C2C2C;
    padding: 5px 5px 0 0;
}

div.today {
    background: #bce8f1;
    height: 100%;
} 
p.zxcv{
    white-space:normal;
    word-wrap: break-word !important;
    max-width: 120px !important;
    padding-bottom: 0px !important;
    margin-bottom: 0px !important;
}

</style>