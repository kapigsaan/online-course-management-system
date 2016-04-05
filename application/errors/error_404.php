<?
  $config =& get_config();
  $base_url = isset($config['base_url']) ? $config['base_url'] == '' ? NULL : $config['base_url'] : NULL;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>404 Page not found</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href='http://fonts.googleapis.com/css?family=Amarante' rel='stylesheet' type='text/css'>
<style type="text/css">
body{
  background:url(bg.png);
  margin:0;
}
.wrap{
  margin:0 auto;
  width:1000px;
}
.logo{
  text-align:center;
} 
.logo p span{
  color:lightgreen;
} 
.sub a{
  color:white;
  background:rgba(0,0,0,0.3);
  text-decoration:none;
  padding:5px 10px;
  font-size:13px;
  font-family: arial, serif;
  font-weight:bold;
} 
.footer{
  color:#555;
  position:absolute;
  right:10px;
  bottom:10px;
  font-weight:bold;
  font-family:arial, serif;
} 
.footer a{
  font-size:16px;
  color:#ff4800;
} 
</style>
</head>


<body>
 <img src="<?=$base_url;?>label.png"/> 
 <div class="wrap">
    <div class="logo">
    <img src="<?=$base_url;?>woody-404.png"/>
      <div class="sub">
        <p>Something wrong with the link you are trying to access.</p>
        <p><a href="<?=$base_url;?>">Go Back to Home</a></p>
      </div>
     </div>
  </div>
  
  
  <div class="footer">
   <strong>Copyright &copy; <?=date('Y');?> <?php echo $config['footer_title']?></strong> All rights reserved.
  </div>
  
</body>