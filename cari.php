<?php
system('clear');
echo "
----------------------------------------------------------

Admin finder CLI

---------------------------------------------------------
";
echo "Url? (Use http, https or not) -> ";
$target=trim(fgets(STDIN))."/";
$get=file_get_contents("wordlist.txt");
$loncat=explode("\n",$get);
//jalankan
foreach($loncat as $admin){
$target_admin=$target.$admin;
$ch = curl_init($target_admin);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$ex = curl_exec($ch);
$kode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
echo $target_admin ."  ->  $kode\n";
//adlog ditemukan
if($kode==200){
	echo "Dir atau file ditemukan(Lanjut? ketik y)";
	$lanjut=trim(fgets(STDIN));
	if($lanjut=='y'){
		continue;
	}else{
		echo $target_admin.' -> Status code 200';
		echo "\n";
		exit;
	}
}
}

?>
