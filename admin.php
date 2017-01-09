<?php
mb_internal_encoding("UTF-8");
const USER_LOGIN="login";
const USER_PASSWORD="password";
$ext=array("json");
$uploaded=false;
//Инициализация list.php
$file='list.php';

if (!file_exists($file)){file_put_contents($file,"Загруженные файлы</br>");};

if(!empty($_POST["submit_user_data"])){
  $login=($_POST['login']);
  $password=($_POST['password']);

  if (USER_LOGIN==$login && $password==USER_PASSWORD) {
	$uploaded=true;
  }
}


if(!empty($_FILES))
{


	$name_f=$_FILES['test']['name']."</br>";
	if ($list=file_get_contents($file))
	{
      $file_name=substr($_FILES['test']['name'],0,strpos($_FILES['test']['name'],'.'));

      $tv=mb_strpos($list,$file_name);
      if(!$tv)
      {
        $uploaddir =__DIR__.'\files\\';
        $uploadfile = $uploaddir . basename($_FILES['test']['name']);
        $file_ext=substr($_FILES['test']['name'],strpos($_FILES['test']['name'],'.')+1);
        if(!in_array($file_ext, $ext)){die('НЕДОПУСТИМОЕ РАСШИРЕНИЕ ФАЙЛА');};

        if (move_uploaded_file($_FILES['test']['tmp_name'],$uploadfile))
        {
          echo "Файл успешно загружен</br>";
        }
        else { die('НЕ УДАЛОСЬ ЗАГРУЗИТЬ'); };

        if (file_put_contents($file, $name_f, FILE_APPEND))echo "Файл ".$_FILES['test']['name']." сохранен в list.php";
      }
      else {
              echo "Файл уже был загружен";
           }

	}
  else {echo "Не удается получить данные из list.php";};
  $uploaded=true;
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

  if ($uploaded){?>
  <form action="admin.php" method="post" enctype="multipart/form-data">
  <input name="test" type="file" >
  <button type="submit" name="submit_file" value="ok">Отправить</button>
  <?php
   }
  elseif (!$uploaded){  ?>

  <form action="admin.php" method="post">
  <input name="login" type="text" placeholder="login">
  <input name="password" type="text" placeholder="password">
  <button type="submit" name="submit_user_data" value="ok">Отправить</button>
  </form>
<?php

}; ?>


</body>
</html>
