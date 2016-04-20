
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Change Password</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php if ($system_message): ?>
    <p><?=$system_message?></p>
<?php endif ?>

<?php if (validation_errors()): ?>
	<div class = "alert alert-danger">
		<?php echo validation_errors()?>		
	</div>
<?php endif ?>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
        	<form action="" method="post">
	            <div class="panel-body">
	            	<div class="col-md-12">
	            		<div class="col-md-2"><label>Username : </label></div>
	            		<div class="col-md-8">
	            			<span style = "font-size:20px;font-weight:bold"><?=$profile->username?></span>
	            			<p></p>
	            		</div>
	            		<div class="col-md-2"></div>
	               	</div>

	            	<div class="col-md-12">
	            		<div class="col-md-2"><label>Old Password : </label></div>
	            		<div class="col-md-8">
	            			<input type="password" name = "old_pass" class = "form-control" placeholder = "Password" required/>
	            			<p></p>
	            		</div>
	            		<div class="col-md-2"></div>
	               	</div>

	               	<div class="col-md-12">
	            		<div class="col-md-2"><label>Password : </label></div>
	            		<div class="col-md-8">
	            			<input type="password" name = "password" class = "form-control" placeholder = "Password" required/>
	            			<p></p>
	            		</div>
	            		<div class="col-md-2"></div>
	               	</div>
	               	<div class="col-md-12 text-right">
	               		<p></p>
	               		<div class="col-md-2"></div>
	               		<div class="col-md-8">
	               			<input type="submit" class = "btn btn-primary" name = "btn-submit-changepass" value = "Submit" />
	               		</div>
	               	</div>
            	</div>
            </form>
        </div>
    </div>
</div>