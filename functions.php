<?php
function get_word($points)
{
	if($points==0) $word="баллов";
	elseif($points==1)$word="балл";
	elseif($points>1&& $points<5)$word="балла";
	else{$word= "баллов";};
	return $word;
}

function get_data_from_file($num)
{
  $path=__DIR__.'\files\\'.$num.'.json';
  
  if (file_exists($path)) {
  $j_str=  file_get_contents($path);
 
  $outstr=json_decode($j_str,true);
   
  return $outstr;
}
}







?>