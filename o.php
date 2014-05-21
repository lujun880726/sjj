<?php
set_time_limit(0);
$url = 'http://ditu.o.cn/poi/shanghai-hpq-gongsiqiye/more';
$data = file_get_contents($url);
$tmp = explode('<li><a href="', $data);

unset($tmp[0]);

foreach($tmp as $val)
	{
		$tmmp = explode('"', $val);

		$rowUrl = 'http://ditu.o.cn' . $tmmp[0] ;
		$dataRow = file_get_contents($rowUrl);
		$name = trim(getStr($dataRow,'<h1 class="tit" itemprop="name">','</h1>' ));
		$add = trim(getStr($dataRow,'</label><span>','</span>' ));
		file_put_contents('o.txt', $name . '	'. $add . "\r\n", FILE_APPEND);

		if (rand(1, 20) == 1) 
			{
			sleep(1);
			}
	}

die('ok');

function getStr($data,$fStr,$eStr)
{
	$tmp = explode($fStr,$data);
	$pos = strpos($tmp[1],$eStr);
	return substr($tmp[1],0,$pos);
}