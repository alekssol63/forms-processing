<?php
include 'functions.php';


	


$test_start=false;



if (!empty($_GET["num"]))
{	
	
	
	$outstr = get_data_from_file($_GET["num"]);
	$test_start=true;
	
	
	
	
};
 

if (!empty($_POST["end_test"]))
{
 
  $points=0;
  $outstr=get_data_from_file($_POST["end_test"]);
  
  if($outstr)
  {
	 
	foreach ($_POST as $key => $value) 
	{
		if (is_int($key))
		{
			if  ($outstr[1][$key]["A"]==$value){ $points++;}
		}
	}
	echo "Вы набрали ".$points." ".get_word($points);
  }
  else{ echo"Файл с таким именем не существует";}
	
}

?>







<?php if ($test_start){?>

<form action="test.php" method="post">
  
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
	  else{
		  echo "<h2>".$v."</h2></br>";
	  }
    }
  }
  
  ?>
<button type="submit" name="end_test" value="<?php echo $_GET["num"];?>">Готово</button>
 
</form>
  
<?php }
else{ ?>
<p>Введите номер теста. Например: ?num=1</p>
<?php };?>


