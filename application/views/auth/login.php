
<?Php
  $CI =& get_instance();
    $CI->load->library('totals');
  $title = $CI->totals->title();
?>

<form action="" method="post" role="form">
    <p><?=$system_message;?></p>
    <?php if (validation_errors()): ?>
      <div class="alert alert-danger">
        <?php echo validation_errors()?>
      </div>
    <?php endif ?>
    <fieldset>
        <div class="form-group">
            <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" required>
        </div><!-- 
        <div class="form-group">
            <select name = "type" class="form-control" required>
              <option value = "admin">Admin</option>
              <option value = "instructor">Instructor</option>
              <option value = "student">Student</option>
            </select>
        </div> -->
        <!-- <div class="checkbox">
            <label>
                <input name="remember" type="checkbox" value="Remember Me">Remember Me
            </label>
        </div> -->
        <!-- Change this to a button or input when using this as a form -->
        <input type="hidden" name="fit" value="<?=$form_token;?>"/>
        
        <div class = "row">
          <div class = "col-md-12 c_image">
            <div class = "col-md-3"></div>
            <div class = "the_im col-md-6 text-right">
              <?= $data['image']; ?>
            </div>
            <div class = "col-md-3"></div>
          </div>
        </div>
        <div class = "row">
          <div class = "col-md-2"></div>
          <div class = "col-md-8">
            <center><label>Enter text above: </label></center>
            <?php
            $data_captcha = array(
            'name' => 'captcha',
            'class' => 'form-control',
            'color' => 'white',
            'placeholder' => 'captcha',
            'id' => 'captcha',
            'required' => 'required'
            );
            echo form_input($data_captcha, '' ,'');
            ?>   
            <p></p> 
        </div>
        <p></p>
        <div class = "col-md-2"></div>
      </div>
        <input type="submit" class="btn btn-lg btn-success btn-block" name="backstage_login" value="Log In">
    </fieldset>

    <div class="separator text-center">
      <div class="clearfix"></div>
      <br />
      <div>
          <h1><i class="fa fa-paw" style="font-size: 26px;"></i>
            <?php if ($title): ?>
                <?php if ($title->name == ""): ?>
                    Company Name
                <?php else:?>
                    <?=$title->name?>
                <?php endif ?>
            <?php else:?>
                Company Name
            <?php endif ?>
          </h1>


        <!--  <p class = "text-center">©2015 All Rights Reserved.</p> -->
      </div>
  </div>

</form>
