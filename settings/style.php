
<style>

<?
include '../config.php' ;
?>

body {
	font-family: <?php echo $body_font_family; ?> ;
	background-color: <? echo $default_background_color; ?> ;
	margin: 0 0 0 0 ;
	padding: 0 0 0 0 ;
	height: 100% ;
	overflow-y: hidden ;
	color: <? echo $default_font_color ?> ;
}

.settings *,
.settings-item *,
.settings-location * {
	text-align: center ;
}

header {
	line-height:<?php echo $header_line_height; ?>;
	valign: center;
	height: <? echo $header_height; ?> ;
    text-align: center ;
    color: <? echo $header_font_color; ?> ;
	font-size: <? echo $header_font_size; ?>;
	text-shadow: <?php echo $header_shadow_color; ?> <?php echo $header_shadow_style; ?>;
	
	background: rgb(122,188,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(122,188,255,1) 0%, rgba(96,171,248,1) 44%, rgba(64,150,238,1) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* IE6-9 */

}

header h1,
header h2 {

	margin: 0px ;
	text-shadow: <?php echo $header_shadow_color; ?> <?php echo $header_shadow_style; ?>;
	padding: 0.5em ;

}

nav, div[id='mode'] , content, div[id='right'] {
	display: inline-block ;
}

nav, div[id='mode'] {
	float: left ;
}

nav {
}

div[id='mode'] {
	width: 10% ;
}

content {
	width: 60% ;
	height: <? echo $default_main_height ?> ;
	overflow: auto ;
}

div[id='right'] {
	width: 20% ;
	float: right ;
	height: <? echo $default_main_height ?> ;
}

content ul,
div[id='mode'] ul {
	margin: 0 ;
	padding: 0 ;
	list-style: none ;
	text-align: center ;
	padding-left: 2% ;
}

content ul li,
div[id='mode'] ul li {
	width: 100% ;
}

content ul li div {
	display: inline-block ;
	margin-top: 3% ;
	border: 1px solid <? echo $default_div_color ?> ;
	border-radius: <? echo $input_border_radius ?> ;
	float:left;
	margin-left: 1% ;
}

content div[id='name'] {
	border: 1px solid <? echo $default_active_input ?> ;
}
content div[id='name'] > label {
	color: <? echo $default_active_input ?> ;
}
content div[id='sid'] {
	border: 1px solid <? echo $default_sleep_input ?> ;
}
content div[id='sid'] > label {
	color: <? echo $default_sleep_input ?> ;
}

content div[id='name'],
content div[id='address'] {
	width: 71.5% ;
}
content div[id='sid'],
content div[id='nickname'],
content div[id='ubn'],
content div[id='company_phone'],
content div[id='company_fax'],
content div[id='location'],
content div[id='contact'],
content div[id='contact_phone'],
content div[id='modify'],
content div[id='create'],
content div[id='invalid'] {
	width: 23% ;
}
content div[id='email'] {
	width: 47.5% ;
}

content ul li select {
	font-family: <?php echo $body_font_family; ?> ;
	width: 100% ;
	border: 0 ;
	height: <? echo $input_height ?> ;
	margin-top: <? echo $input_margin_top ?> ;
	outline: none ;
	font-size: <? echo $default_input_font_size ?> ;
	color: <? echo $default_font_color ?> ;
	background-color: <? echo $main_bg_color; ?> ;
}

content ul li input {
	font-family: <?php echo $body_font_family; ?> ;
	width: 100% ;
	height: <? echo $input_height ?> ;
	border: 0 ;
	padding: 0 ;
	border-radius: <? echo $input_border_radius ?> ;
	margin-top: <? echo $input_margin_top ?> ;
	outline: none ;
	font-size: <? echo $default_input_font_size ?> ;
	color: <? echo $default_font_color ?> ;
	background-color: <? echo $main_bg_color; ?> ;
}


content ul li label {
	display: block ;
	background-color: <? echo $main_bg_color; ?> ;
	color: <? echo $default_div_color ?> ;
	float: left ;
	padding: 5px 10px ;
	margin: -20px 10px 0px 10px ;
	font-size: <? echo $default_input_font_size+4 ?> ;

}

content ul li span {
	display: block ;
	background-color: <? echo $input_bottom_bg ?> ;
	color: <? echo $input_bottom_color ?> ;
	padding : 3px ;
	font-size: 8px ;
	height: 13px ;
	border-radius: <? echo $input_border_radius ?> ;
}
content ul li span a:link {	color: <? echo $input_bottom_a_color ?> ; }
content ul li span a:visited { color: <? echo $input_bottom_a_color ?> ; }

content list[id='list5'] > div {
	border: 0 ;
}

content div[id='modify'],
content div[id='create'],
content div[id='invalid'] {
	border: 0 ;
}

.settings-item content div[id='supplier'] {
	width: 79% ;
}

.settings-item li[id='list3'] div {
	width: 18% ;
}
.settings-item li[id='list3'] div[id='empty'] {
	border: 0 ;
	float: none ;
	height: ;
}

.settings-location content div {
	width: 48% ;
}

.settings-location content li[id='list3'] div {
	width: 10% ;
	border: 0 ;
}

.settings-location div[id='location_country_sid'],
.settings-location div[id='location_city_sid'] {
	border: 1px solid <? echo $default_active_input ?> ;
}

.settings-location label[id='location_country_sid'],
.settings-location label[id='location_city_sid'] {
	color: <? echo $default_active_input ?> ;
}

table {
	border: 1px solid <? echo $table_border_color; ?> ;
	margin: 5% auto ;
	width: 90% ;
}
td {
	border: 1px solid <? echo $table_border_color; ?> ;
	min-width: 10em ;
	max-width: 20em ;
	border-radius: <? echo $input_border_radius ?> ;
}
th {
	background-color: <? echo $table_header_color; ?> ;
	font-size: <? echo $default_input_font_size+4 ?> ;
}
td, th {
	padding: 10px ;
}
tr:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
tr:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}

.settins-location input[id='location_country_sid'],
.settins-location input[id='location_city_sid'] {
	text-transform: uppercase ;
}

div[id='mode'] ul li {
	background-color: #666 ;
	width: <? echo $Setting_Sub_btn_width; ?> ;
	height: <? echo $Setting_Sub_btn_height; ?> ;
	margin: 10% auto ;
	border-radius: <? echo $button_border_radius."px" ?> ;
}
div[id='mode'] ul li button {
	width: 95% ;
	height: 95% ;
	margin-left: -1 ;
	padding: 0 ;
	color: <? echo $Sub_content_color; ?> ;
}
div[id='mode'] ul li button:hover {
	background-color: <? echo $Sub_btn_activate; ?> ;
}
div[id='mode'] ul li button[id='<? echo $mode ?>'] {
	color: <? echo $Sub_content_color; ?> ;
	background-color: <? echo $Sub_btn_activate; ?> ;
	width: 99% ;
	height: 97% ;
	margin: 0 ;
	text-shadow: <? echo $Sub_content_shadow; ?> 0.03em 0.03em 0.05em;
}
div[id='mode'] ul li[id='sw_li_active'] {
	width: 76% ;
}
div[id='mode'] button {
	font-family: <?php echo $body_font_family; ?> ;
	display: block ;
	width: 80% ;
	height: 10% ;
	background-color: <? echo $Sub_btn_disable; ?> ;
	margin: 10% auto ;
}
div[id='mode'] ul {
	margin: 40% auto ;
	width: 80% ;
}


content div[id='modify'],
content div[id='create'],
content div[id='invalid'] {
	margin-left: 30px ;
	width: 10% ;
	height: 80px ;
	border-radius: <? echo $button_border_radius."px" ?> ;
}
content div[id='modify'] {
	<?
	if( $button1 != '' )
		echo "background-color: ".$submit_btn_shadow." ;" ;
	?>
}
content div[id='create'] {
	<?
	if( $button2 != '' )
		echo "background-color: ".$submit_btn_shadow." ;" ;
	?>
}
content div[id='invalid'] {
	<?
	if( $button3 != '' )
		echo "background-color: ".$submit_btn_shadow." ;" ;
	?>
}

content[id='info'] {
	padding-top: 0px ;
}
content[id='info'] th {
	font-size: 2em ;
	padding: 10px ;
}
content[id='info'] tr {
	padding: 20px ;
}
content[id='info'] td {
	padding: 20px ;
	padding-left: 80px ;
}
content[id='info'] ol {
	padding: 10px ;
	text-align: left ;
}

button {
	margin: 0 ;
	width: 100% ;
	height: 90% ;
	border: 0 ;
	border-radius: <? echo ((string)((int)$button_border_radius)-2)."px" ?> ;
	background-color: <? echo $submit_btn_color; ?> ;
	outline: none ;
	font-size: 25px ;
	color: <? echo $submit_content_color; ?> ;

}

button:hover {
	cursor: pointer ;
	text-shadow: <? echo $submit_content_shadow; ?> 0.03em 0.03em 0.05em;
}
button:active {
	background-color: #4282f2 ;
}

.invalid_btn {
	font-size: 20px ;
	width: 100px ;
	height: 25px ;
}
.del_btn {
	font-size: 20px ;
	width: 100px ;
	height: 25px ;
	background-color: #f56 ;
}

nav div {
	background-color: <? echo $Main_btn_disable ?> ;
	padding: 15% 12% ;
	width: 60% ;
	height: 80px ;
	margin: 10% auto ;
	margin-left: 0 ;
}
nav div:hover {
	background-color: <? echo $Main_btn_activate; ?> ;
}
nav div[id='<? echo $where_am_i ?>'] {
	margin: 10% auto ;
	margin-right: 0 ;
	background-color: <? echo $Main_btn_activate; ?> ;
}
nav a {
	display: block ;
	background-color: transparent ;
	color: <? echo $Main_btn_color; ?> ;
	font-size: <? echo $default_input_font_size+15 ?> ;
	text-decoration: none ;
}
nav ul {
	padding: 0 ;
}


/* 開發版面設定顏色 */
header {
	background-color: <? echo $header_bg_color; ?> ;
}

nav {
	width: 10% ;
	background-color: <?php echo $asideL_bg_color; ?> ;
	height: <? echo $default_main_height ?> ;
}

div[id='mode'] {
	background-color: <?php echo $asideM_bg_color; ?> ;
	height: <? echo $default_main_height ?> ;
}

content {
	//background-image: url(./img/wood.jpg) ;
	background-color: <?php echo $main_bg_color; ?> ;
}

/*::-webkit-scrollbar {
  width: 14px;
  height: 14px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #0099cc;
  border: 0px none #ffffff;
  border-radius: 0px;
}
::-webkit-scrollbar-thumb:hover {
  background: #223366;
}
::-webkit-scrollbar-thumb:active {
  background: #00ffaa;
}
::-webkit-scrollbar-track {
  background: #eeeeee;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: #eeeeee;
}
::-webkit-scrollbar-track:active {
  background: #ffffff;
}
::-webkit-scrollbar-corner {
  background: transparent;
}*/


div[id='right'] {
	background-color: <?php echo $asideR_bg_color; ?> ;
}

footer {
	background-color:  <?php echo $footer_bg_color; ?>;
	height:<?php echo $footer_height; ?>;
	font-size: 0.25em;
	text-align: center;
	margin: 0 ;
	padding: 0 ;
	color: <?php echo $header_font_color; ?> ;
	
	background: rgb(122,188,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(122,188,255,1) 0%, rgba(96,171,248,1) 44%, rgba(64,150,238,1) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* IE6-9 */

}
footer a:link {color:<?php echo $header_font_color; ?>;} /* 設定尚未點閱過的連結樣式顏色 */
footer a:visited {color:<?php echo $header_font_color; ?>;} /* 設定過去曾經閱過的連結顏色 */



/*動態改變文字大小*/
<?php
	for ($rate=0 ; $rate<101 ; $rate++ )
	{
		$mw=$rate*((1536)/100);
		$mh=$rate*((854)/100);
		$fz=$rate*(($root_font_size)/100);
		$s = "@media screen and (min-width:".$mw."px) and (min-height:".$mh."px){html {font-size: ".$fz."em;}}  ";
		echo substr($s,0,-1) ;
	}
?>

/*
blue: #48f ;
orange: #f85 ;
skyblue: #5cf ;
green: #1fa ;
*/
</style>