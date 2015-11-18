<?php
$link = ("http://www.streetdirectory.com//api/?mode=search&act=location&output=js&callback=set_data&start=0&limit=20&country=sg&profile=template_2&show_additional=0&no_total=1&q=".trim($_GET['q'])."&d=1&ctype=1%20Request%20Headers");
$ch = curl_init();
$domain = $_SERVER["HTTP_HOST"];
curl_setopt($ch, CURLOPT_URL, "$link");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "domain=$domain");
curl_setopt($ch, CURLOPT_HEADER, 0);
$content = curl_exec($ch);
die();


//$content = file_get_contents($link);
//$html[] = '<select name="Listing[postal_code]" id="Listing_postal_code" >';
/*$html = array();
if($content){
	$content = str_replace(array('set_data(',');'),array(''),$content);
	$content = json_decode($content,true);
	if(count($content)>0 && is_array($content)){
		foreach ($content as $value) {
			$html[] ='<option value="'.$value['pc'].'">'.$value['pc'] .'</option>';
		}
	}
}*/
/*//$html[] = '</select>';
echo '<pre>';
print_r($html);
echo '</pre>';
die;
die(implode($html,''));*/

?>