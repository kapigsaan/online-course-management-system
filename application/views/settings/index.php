<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Settings
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('custodian');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Settings</li>
  </ol>
</section>

<!-- Main content -->
<div id="page-wrapper">
	<div class="row">
		<?php if($system_message): ?>
		<div class="col-lg-12">
			<?=$system_message;?>
		</div>
		<?php endif; ?>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="">
			<div class="table-responsive">
			  <table class="table" cellpadding="4" cellspacing="4">
				<tr>
				  <th colspan='2' class="table_td">Redirect Inquiry
          <br/> Note: For more than 1 email address, separate email address with comma.
          </th>
				</tr>
				<tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Email Address: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtInq" type="text" value="<?=$settings?$settings:'';?>" class="form-control"></td>
				</tr>
				<tr>
				  <th colspan='2' class="table_td">Instagram Page Link</th>
				</tr>
				<tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Instagram Page URL: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtInurl" type="text" value="<?=$sets?$sets->in_url:'';?>" class="form-control"></td>
				</tr>
        <tr>
				  <th colspan='2' class="table_td">Facebook Page Link</th>
				</tr>
				<tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">FB Page URL: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtFburl" type="text" value="<?=$sets?$sets->fb_url:'';?>" class="form-control"></td>
				</tr>
				<tr>
				  <th colspan='2' class="table_td">Twitter Account</th>
				</tr>
        <tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Twitter Page URL: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtTwurl" type="text" value="<?=$sets?$sets->tw_url:'';?>" class="form-control"></td>
				</tr>
				<tr>
				  <th colspan='2' class="table_td">Official Email</th>
				</tr>
        <tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Official Email Being Used: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtOemail" type="text" value="<?=$sets?$sets->official_email:'';?>" class="form-control"></td>
				</tr>
				<tr>
				  <th colspan='2' class="table_td">Google+ Page Link</th>
				</tr>
        <tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Google+ Page URL: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtGplus" type="text" value="<?=$sets?$sets->gplus_url:'';?>" class="form-control"></td>
				</tr>
		<tr>
				  <th colspan='2' class="table_td">Skype Account</th>
				</tr>
		<tr>
			<td class="table_td col-xs-3" style="border-top:0px;">Skype Page URL: </td>
			<td class="table_td col-md-9" style="border-top:0px;"><input name="txtEnroll" type="text" value="<?=$sets?$sets->enroll_url:'';?>" class="form-control"></td>
		</tr>
		<tr>
				  <th colspan='2' class="table_td">Youtube Page Link</th>
				</tr>
        <tr>
			<td class="table_td col-xs-3" style="border-top:0px;">Youtube Page URL: </td>
			<td class="table_td col-md-9" style="border-top:0px;"><input name="txtStudent" type="text" value="<?=$sets?$sets->student_url:'';?>" class="form-control"></td>
		</tr>
      <!--   <tr>
				  <th colspan='2' class="table_td">Google+ Page Link</th>
				</tr>
        <tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Google Map: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><textarea name="txtGmap" class="form-control"><?=$sets?$sets->gplus_map:'';?></textarea></td>
				</tr> -->
       <!--  <tr>
				  <th colspan='2' class="table_td">College System Enrollment Link</th>
				</tr>
        
        <tr>
				  <th colspan='2' class="table_td">College System Faculty Login Link</th>
				</tr>
        <tr>
				  <td class="table_td col-xs-3" style="border-top:0px;">Faculty Login Page URL: </td>
				  <td class="table_td col-md-9" style="border-top:0px;"><input name="txtFaculty" type="text" value="<?=$sets?$sets->faculty_url:'';?>" class="form-control"></td>
				</tr> -->
				<tr>
				  <td class="table_td col-xs-3">&nbsp;</td>
				  <td class="table_td col-md-9"><input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary"></td>
				</tr>
			  </table>
			</div>
			</form>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</section><!-- /.content -->