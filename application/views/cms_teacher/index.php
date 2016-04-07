
            <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>

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