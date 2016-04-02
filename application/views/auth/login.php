
<?Php
  $CI =& get_instance();
    $CI->load->library('totals');
  $title = $CI->totals->title();
?>

<form action="" method="post" role="form">
    <p><?=$system_message;?></p>
    <fieldset>
        <div class="form-group">
            <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" required>
        </div>
        <div class="form-group">
            <select name = "type" class="form-control" required>
              <option value = "admin">Admin</option>
              <option value = "instructor">Instructor</option>
              <option value = "student">Student</option>
            </select>
        </div>
        <!-- <div class="checkbox">
            <label>
                <input name="remember" type="checkbox" value="Remember Me">Remember Me
            </label>
        </div> -->
        <!-- Change this to a button or input when using this as a form -->
        <input type="hidden" name="fit" value="<?=$form_token;?>"/>
        <input type="submit" class="btn btn-lg btn-success btn-block" name="backstage_login" value="Log In">
    </fieldset>

    <div class="separator">
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

          <p>©2015 All Rights Reserved. jnz_yui@rin</p>
      </div>
  </div>

</form>
