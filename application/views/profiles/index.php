<!-- Content Header (Page header) -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Company Profiles</h1>
    </div>
    <p></p>
    <p><?=$system_message;?></p>
    <p></p>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
		<div class="col-lg-12">
			<form method="post" action="" enctype="multipart/form-data">
			<div class="table-responsive">
			  <table class="table" cellpadding="4" cellspacing="4">
				<tr>
				  <td class="table_td col-xs-3">Company's Name: </td>
				  <td class="table_td col-md-9"><input name="txtCompname" type="text" value="<?=$prof?$prof->name:'';?>" class="form-control"></td>
				</tr>
				<tr>
				  <td class="table_td col-xs-3">Address: </td>
				  <td class="table_td col-md-9"><input name="txtAdd" type="text" value="<?=$prof?$prof->address:'';?>" class="form-control"></td>
				</tr>
        <tr>
				  <td class="table_td col-xs-3">Telephone Number: </td>
				  <td class="table_td col-md-9"><input name="txtTel" type="text" value="<?=$prof?$prof->tel:'';?>" class="form-control"></td>
				</tr>
   <!--      <tr>
				  <td class="table_td col-xs-3">Fax Number: </td>
				  <td class="table_td col-md-9"><input name="txtFax" type="text" value="<?=$prof?$prof->fax:'';?>" class="form-control"></td>
				</tr>
        <tr>
				  <td class="table_td col-xs-3">Globe: </td>
				  <td class="table_td col-md-9"><input name="txtGlobe" type="text" value="<?=$prof?$prof->globe:'';?>" class="form-control"></td>
				</tr>
        <tr>
				  <td class="table_td col-xs-3">Smart: </td>
				  <td class="table_td col-md-9"><input name="txtSmart" type="text" value="<?=$prof?$prof->smart:'';?>" class="form-control"></td>
				</tr>
        <tr>
				  <td class="table_td col-xs-3">Sun: </td>
				  <td class="table_td col-md-9"><input name="txtSun" type="text" value="<?=$prof?$prof->sun:'';?>" class="form-control"></td>
				</tr> -->
      <!--   <tr>
				  <td class="table_td col-xs-3">Website Logo: </td>
				  <td class="table_td col-md-9"><input name="txtWebsite" type="text" value="<?=$prof?$prof->website:'';?>" class="form-control"></td>
				</tr> -->
				<!-- start image here -->
				<?php if($imagefile) { $file_info = pathinfo($imagefile);?>
					<tr><td class="table_td">Website Logo:</td><td>*Note: logo should be .png and .jpg only </td></tr>
					<tr>
						<td>
			              <img style = "height:50px;" class="img-thumbnail" src="<?php echo site_url($imagefile); ?>" alt="Image"/>
			              <input type="hidden" name="websitex" value="<?php echo $imagefile?>" />
						</td>
						<td>
							<a href="<?=site_url('profiles/delete_image');?>" onclick="return confirm('Are you sure you want to delete this image?')">delete image</a>
						</td>
					</tr>
				<?php }else{ ?>
					<tr>
						<td class="table_td">Website Logo:</td>
						<td class="table_td">
							<input type="file" name="userfile"  />
						</td>
					</tr>
				<?php } ?>
				<!-- end -->
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