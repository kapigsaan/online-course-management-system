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
                                <th>Use</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($classes): ?>
                                <?foreach ($classes as $key => $v):?>
                                    <tr>
                                        <td><?=$v->class?></td>
                                        <td>asd</td>
                                        <td>asd</td>
                                        <td>
                                            asd
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


