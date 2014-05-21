<?php
set_time_limit(0);
$urlF = 'http://map.baidu.com/mobile/webapp/place/list/qt=s&wd=%E4%B8%8A%E6%B5%B7%E9%BB%84%E6%B5%A6%E5%8C%BA%E5%85%AC%E5%8F%B8&c=289&src=0&pn=';

$urlend = '&rn=10/center_name=%E4%B8%8A%E6%B5%B7%3Fdgr&third_party=aladdin&showall=1/?dgr=2&third_party=aladdin&fromhash=1';


$i=1;
$a = true;
while(true)
{
	$url = $urlF . $i . $urlend;
	$data = str_replace('tit-len0','tit-len1',file_get_contents($url));
	$tmmp = explode('<span class="list-tit text-ellipsis tit-len1">', $data);
	unset($tmmp[0]);
	if ($tmmp) {
		foreach($tmmp as $val){
		$tmmmp = explode('</span>', $val);
			$name = trim($tmmmp[0]);

			$add = trim(getStr($val,'<p class="list-addr text-ellipsis">','</p>' ));
			file_put_contents('b.txt', $name . '	'. $add . "\r\n", FILE_APPEND);
		}
	}
	if (rand(1, 20) == 1) 
	{
		sleep(1);
	}
	if (count($tmmp) < 9) {
		die($i.'-ok');
	}
	$i++;
}

function getStr($data,$fStr,$eStr)
{
	$tmp = explode($fStr,$data);
	$pos = strpos($tmp[1],$eStr);
	return substr($tmp[1],0,$pos);
}
