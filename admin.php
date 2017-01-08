<?php


$authorization=true;//сменить на false
const USER_LOGIN="login";
const USER_PASSWORD="password";
$ext=array("json");
$uploaded=false;
if (!empty($_POST["ent_test"])) {
$uploaded=true;
}

if(!empty($_POST["submit_user_data"])){
  $login=($_POST['login']);
  $password=($_POST['password']);

  if (USER_LOGIN==$login && $password==USER_PASSWORD) {
    $authorization=true;
  }
}


if(!empty($_FILES))
{

  $test_file='\f_proc\\'.$_FILES['test']['name'];

  $uploaddir = 'C:\OpenServer\domains\localhost\f_proc\\';
  $uploadfile = $uploaddir . basename($_FILES['test']['name']);
  $file_ext=substr($test_file,strpos($test_file,'.')+1);

  if(!in_array($file_ext, $ext)){die('НЕДОПУСТИМОЕ РАСШИРЕНИЕ ФАЙЛА');};

  if (move_uploaded_file($_FILES['test']['tmp_name'],$uploadfile))
  {
    $uploaded=true;

    echo "Файл успешно загружен";
    //=======================
  /*  $path=$uploadfile;
    var_dump(file_exists($path));
    if (file_exists($path)) {

    $j_str=  file_get_contents($path);

    $outstr=json_decode($j_str,true);
    var_dump($outstr);
    };*/
    //=========================


}
  else { die('НЕ УДАЛОСЬ ЗАГРУЗИТЬ'); };
}

if (!empty($_POST["ent_test"]))
{
  //=======================
  $path='C:\OpenServer\domains\localhost\f_proc\\2.json';
  if (file_exists($path)) {

  $j_str=  file_get_contents($path);

  $outstr=json_decode($j_str,true);
  //var_dump($outstr);
  $test_start=true;
  };
  //=========================



}

if (!empty($_POST["end_test"]))
{
  $points=0;
  //=======================
  $path='C:\OpenServer\domains\localhost\f_proc\\2.json';
  if (file_exists($path)) {

  $j_str=  file_get_contents($path);

  $outstr=json_decode($j_str,true);

  };
   //=========================

foreach ($_POST as $key => $value) {
  if (is_int($key)){
  if  ($outstr[1][$key]["A"]==$value){ $points++;}
 }



}
echo "Вы набрали ".$points." балла";
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>"Домашнее задание к лекции 2.2 «Обработка форм»"</title>
</head>
<body>

  <?php
  //кусок загрузки

  if ($authorization && !$uploaded){?>
  <form action="admin.php" method="post" enctype="multipart/form-data">
  <input name="test" type="file" >
  <button type="submit" name="submit_file" value="ok">Отправить</button>
  <?php
   }
  elseif (!$authorization){  ?>

  <form action="admin.php" method="post">
  <input name="login" type="text" placeholder="login">
  <input name="password" type="text" placeholder="password">
  <button type="submit" name="submit_user_data" value="ok">Отправить</button>
  </form>
<?php

}; ?>

<?php if ($uploaded && !$test_start){

  ?>
  Перейти к выполнению теста?
  <form action="admin.php" method="post">
  <button type="submit" name="ent_test" value="ok">Да</button>
<?php

}?>

<?php if ($test_start){?>
  <form action="admin.php" method="post">
  <button type="submit" name="end_test" value="ready">Готово</button>
<?php
  foreach ($outstr as $key => $value)
  {
    foreach ($value as $k => $v)
    {
      if(is_array($v))
      {

          echo $v["Q"];
          echo "</br>";
          foreach ($v["Version"] as $kkk => $vvv)
           {?>
             <p><input name="<?php echo $k;?>" type="radio" value="<?php echo $vvv;?>"> <?php echo $vvv; ?></p>
             <?php
           }
           echo "</br>";

      }
    }
  }



}?>

</form>

</body>
</html>
