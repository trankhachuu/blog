<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

function encode($text){
	$bbcode = '~\[b\](.*?)\[/b\]~';


	$thaythe = '<b>$1</b>';

	return preg_replace($bbcode, $thaythe, $text);

}

echo encode("[b]Đây là nội dung chử đậm [/b] lạdlasjdkasdn");

?>