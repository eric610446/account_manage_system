<?php
	include 'config.php' ;
?>


<style type="text/css">

/*網頁整體*/
body {
	font-family: <?php echo $body_font_family; ?> ;	
	margin: 0 0 0 0 ;
	padding: 0 0 0 0 ;
	overflow-y:hidden;
}
/*網頁整體*/

/*標題列*/
header {
	line-height:<?php echo $header_line_height; ?>;
	background-color: <?php echo $header_bg_color; ?> ;
	font-size: <? echo $header_font_size; ?>;
	text-align: center;
	text-transform: uppercase;	/*全部大寫*/		
	color: <?php echo $header_font_color; ?> ;
	text-shadow: <?php echo $header_shadow_color; ?> <?php echo $header_shadow_style; ?>; /*陰影特效*/
	display: block; /*將header以區塊的方式呈現，不要是 inline，像是一般的文字標籤，在一行。*/
	height: <? echo $header_height; ?>;
	
	background: rgb(122,188,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(122,188,255,1) 0%, rgba(96,171,248,1) 44%, rgba(64,150,238,1) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* IE6-9 */



}
/*標題列*/

/*  側邊選單 */
/*  主選單 */
.div_Main_aside{
	height:19.5%;
	text-align: left;
}
.div_Main_asideR{
	height:19.5%;
	text-align: right;
}
.Main_aside{
	width:50%;
	background-color: <?php echo $asideL_bg_color; ?> ;
	height: <? echo $default_main_height ?>;
	float:left;
}
.Aside_Style_2 {
	width:20%;
	float:left;
}
.Aside_Style_1 {
	width:10%;
	float:left;
}
.Main_aside_Style_1{
	width:100%;
}
.Main_aside_Style_2{
	width:50%;
}

/*次選單*/
.Sub_aside{
	width:50%;
	background-color: <?php echo $asideM_bg_color; ?> ;
	height: <? echo $default_main_height ?>;
	float:left;
}
div[id='srch_way'] ul {
	margin: 0 ;
	padding: 0 ;
	list-style: none ;
	text-align: center ;
	padding-left: 2% ;
}
div[id='srch_way'] ul li {
	background-color: #666 ;
	width: <? echo $Index_Sub_btn_width; ?> ;
	height: <? echo $Index_Sub_btn_height; ?> ;
	margin: 10% auto ;
	border-radius: <? echo $button_border_radius."px" ?> ;
}
div[id='srch_way'] ul li button {
	font-size: 60%;
	width: 95% ;
	height: 95% ;
	margin-left: -1 ;
	padding: 0 ;
	
	color: <? echo $Sub_content_color; ?> ;
	border-radius: <? echo ((string)((int)$button_border_radius)-2)."px" ?> ;
}
div[id='srch_way'] ul li button:hover {
	background-color: <? echo $Sub_btn_activate; ?> ;
}
div[id='srch_way'] ul li button[id='sw_btn_active'] {
	color: <? echo $Sub_content_color; ?> ;
	background-color: <? echo $Sub_btn_activate; ?> ;
	width: 99% ;
	height: 97% ;
	margin: 0 ;	
	text-shadow: <? echo $Sub_content_shadow; ?> 0.03em 0.03em 0.05em;
}
div[id='srch_way'] ul li[id='sw_btn_active'] {
	width: 76% ;
}
div[id='srch_way'] button {
	font-family: <?php echo $body_font_family; ?> ;
	
	display: block ;
	width: 80% ;
	height: 10% ;
	background-color: <? echo $Sub_btn_disable; ?> ;
	margin: 10% auto ;
}
div[id='srch_way'] ul {
	margin: 40% auto ;
	width: 80% ;
}
/*次選單*/
/*側邊選單*/

/*主選單按鈕*/
.btn_main{
	width:90%;
	height:99%;
	background-color: <?php echo $Main_btn_disable; ?>;
	color: <? echo $Main_btn_color; ?> ;
    margin: 20% auto;
	}
.btn_main_active{	
	background-color: <?php echo $Main_btn_activate; ?>;	
}
.btn_main_active:hover{
	text-decoration:underline;
}
.btn_main_disable{	
}
.btn_main_disable:hover{
	text-decoration:underline;
	background-color: <?php echo $Main_btn_activate; ?>;
}
/*主選單按鈕*/

/* 主要區塊 */
.article_Style_1 {
	width: 90%;
}
.article_Style_2 {
	width: 80%;
}
article {
	background-color: <?php echo $main_bg_color ; ?> ; 
	height: <? echo $default_main_height ?>;
	margin-left: 10%;
	overflow: scroll;
	overflow-x:hidden;
}
section{
	margin:1%;
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
/*主要區塊*/

/*按鈕全域變數*/
Button {
	font-family: <?php echo $body_font_family; ?> ;	
	font-size:80%;
	height:80%;
	width: 90%;
	border : 0;
}
/*舊版button 全捨棄*/
/*Button {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf));
	background:-moz-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
	background:-webkit-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
	background:-o-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
	background:-ms-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
	background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf',GradientType=0);
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:4px;
	border:1px solid #161616;
	display:inline-block;
	cursor:pointer;
	color:#777777;
	font-family: <?php echo $body_font_family; ?> ;	
	font-size:80%;
	font-weight:250;
	height:80%;
	width: 90%;
	text-decoration:none;
	text-shadow:0px 0.5px 1.5px #161616;
	word-wrap:break-word;
	overflow:hidden;
}
Button:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed));
	background:-moz-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
	background:-webkit-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
	background:-o-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
	background:-ms-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
	background:linear-gradient(to bottom, #dfdfdf 5%, #ededed 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed',GradientType=0);
	background-color:#dfdfdf;
}
Button:active {
	position:relative;
	top:1px;
}*/
/*按鈕全域變數*/


/*修改報價單 轉換報價單/訂單 輸出PDF */
.btn_submit{
	margin: 0 ;
	width: 80% ;
	height: 80% ;
	border: 0 ;
	border-radius: <? echo ((string)((int)$button_border_radius)-2)."px" ?> ;
	background-color: <? echo $submit_btn_color; ?> ;
	outline: none ;
	font-size: 80% ;
	color: <? echo $submit_content_color; ?> ;
	box-shadow: 7px 7px 10px <? echo $submit_btn_shadow ?>;
}
.btn_submit:hover{
	/*background-color: <?php echo $List_btn_activate; ?>;*/
	box-shadow: 3px 3px 8px #888888;
	
	position:relative;	/*位移用參數*/
	top:4px;			/*從上往下移動*/
	left:4px;			/*從左往右移動*/
}
.quo_option{
	height: 20%;
	width: 20%;
	text-align: center ;
}
.set_float_left{
	float:left;
}
.set_clear_left{
	clear:left;
}
/*修改報價單 轉換報價單/訂單 輸出PDF */


/*功能說明區塊*/
.srch_docun{
	font-size: 100%;
	margin: 5% 12% ;
}
.srch_docun_Style_1{
	height: 52%;	
}
.srch_docun_Style_2{
	height: 68%;	
}
.srch_docun_Style_index{
	margin: 2.5% 12% ;
	height: 78%;	
}
.table_srch_docun{
	font-size: 100%;
	width : 100%;
	height : 100%;
	border: 1px solid <? echo $table_border_color; ?> ;
}
.th_srch_docun{
	font-size: 62.5%;
	height : 20%;
	background-color: <? echo $table_header_color; ?> ;
}
.th_srch_docun:nth-child(odd) {
	width : 20% ;
}
.tr_srch_docun{
	font-size: 100%;
	height : 25%;
}
.tr_srch_docun:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_srch_docun:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}

.tr_srch_docun_index{
	font-size: 100%;
	height : 18%;
}
.tr_srch_docun_index:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_srch_docun_index:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}

.td_srch_docun {
	font-size: 55%;
	border: 1px solid <? echo $table_border_color; ?> ;	
	border-radius: <? echo $input_border_radius ?> ;
}
.td_srch_docun:nth-child(odd) {
	text-align:center ;
}
.td_srch_docun:nth-child(even) {
	padding-left:1%;
}
/*查詢功能說明區塊*/

/*分隔線用*/
.separation
{
	height: 1%;
}
.set_List_border_color{
	border: 1px solid <? echo $List_border_color; ?> ;
}
/*主頁面中，標題區塊用*/
.art_top{ //
	min-height: 8%; /*2.0 new_add*/
	font-size: 80%;
	text-align: center;
}

/*建立修改報價單*/
/*#btm_confirm_client, #btm_sent_quotation_list{
	height: 15%;
	width: 15%;
	text-align: center;
}*/

.checkbox_item_aoe{
	 -webkit-transform: scale(2); /* Safari and Chrome */
}

.select_item_aoe{
	width:100%;
	font-size:100%;
}

.input_number_item_aoe{
	width:100%;
	font-size:100%;
}

.td_discount_item_AorE{
	font-size:80%;
}
/*建立修改報價單*/


/*查詢功能 城市按鈕*/
.div_btn_cities{
	height: 19%;
	width: 20%;
	float:left;
	text-align: center ;
}
/*查詢功能 城市按鈕*/

/* 標題在上方的表格 參數設定 */
.div_List_top_header{
	font-size:100%;
}
.table_List_top_header{
	font-size: 100%;
	width : 100%;
	border: 1px solid <? echo $table_border_color; ?> ;
}
.th_List_top_header{
	font-size: 90%;
	height : 100%;
	background-color: <? echo $table_header_color; ?> ;
}
.tr_List_top_header{

	font-size: 100%;
	text-align:center;
}
.tr_List_top_header:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_List_top_header:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}
.td_List_top_header{
	min-height : 50%;
	border-radius: <? echo $input_border_radius ?> ;
}
/* 標題在上方的表格 參數設定 */

/* 標題在左方的表格 參數設定*//*客戶或供應商詳細資料*/
.div_List_left_header{
	font-size:100%;
}
.table_List_left_header{
	font-size: 100%;
	width : 100%;
	border: 1px solid <? echo $table_border_color; ?> ;
}
.th_List_left_header{
	font-size: 90%;
	width : 20%;
	background-color: <? echo $table_header_color; ?> ;
	text-align:center;
}
.tr_List_left_header{

	font-size: 100%;
	height : 100% ;
	text-align:left;
}
.tr_List_left_header:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_List_left_header:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}
.td_List_left_header {
	padding-left:1%;
	font-size: 80%;
	border: 1px solid <? echo $table_border_color; ?> ;	
	border-radius: <? echo $input_border_radius ?> ;
}
/* 標題在左方的表格 參數設定*/


/*查詢功能 列表按鈕*/
.btn_List{

	border-radius: <? echo $input_border_radius ?> ;
	background-color: <?php echo $List_btn_disable; ?>;
	border: 1px solid <?php echo $List_border_color; ?>;
	box-shadow: 5px 5px 8px #888888;
}
.btn_List:hover{
	background-color: <?php echo $List_btn_activate; ?>;
	border: 1px solid <?php echo $List_btn_activate; ?>;
	box-shadow: 2px 2px 8px #888888;
	
	position:relative;	/*位移用參數*/
	top:3px;			/*從上往下移動*/
	left:3px;			/*從左往右移動*/
}
.btn_List_big{

	height: 96%;
	width: 99%;
}
/*查詢功能 列表按鈕*/



/*創建修改物品清單列表各欄位寬度*/
.th_List_item_AorE:nth-child(1){ 	width : 4%; }
.th_List_item_AorE:nth-child(2){ 	width : 4%; }
.th_List_item_AorE:nth-child(3){ 	width : 39%; }
.th_List_item_AorE:nth-child(4){ 	width : 20%; }
.th_List_item_AorE:nth-child(5){ 	width : 20%; }
.th_List_item_AorE:nth-child(6){ 	width : 13%; }
/*城市內客戶列表各欄位寬度*/
.th_List_city_customer:nth-child(1){ 	width : 7.5%; }
.th_List_city_customer:nth-child(2){ 	width : 15%; }
.th_List_city_customer:nth-child(3){ 	width : 45%; }
.th_List_city_customer:nth-child(4){ 	width : 15%; }
.th_List_city_customer:nth-child(5){ 	width : 15%; }
/*外國客戶列表各欄位寬度*/
.th_List_worldwide_customer:nth-child(1){ 	width : 4%; }
.th_List_worldwide_customer:nth-child(2){ 	width : 14%; }
.th_List_worldwide_customer:nth-child(3){ 	width : 14%; }
.th_List_worldwide_customer:nth-child(4){ 	width : 18%; }
.th_List_worldwide_customer:nth-child(5){ 	width : 18%; }
.th_List_worldwide_customer:nth-child(6){ 	width : 15%; }
.th_List_worldwide_customer:nth-child(7){ 	width : 15%; }
/*單獨客戶簡單報價單列表各欄位寬度*/
.th_List_sgl_smpl_quo:nth-child(1){ 	width : 4%; }
.th_List_sgl_smpl_quo:nth-child(2){ 	width : 17%; }
.th_List_sgl_smpl_quo:nth-child(3){ 	width : 13%; }
.th_List_sgl_smpl_quo:nth-child(4){ 	width : 33%; }
.th_List_sgl_smpl_quo:nth-child(5){ 	width : 20%; }
.th_List_sgl_smpl_quo:nth-child(6){ 	width : 13%; }
/*報價單物品清單列表各欄位寬度*/
.th_List_quo_item:nth-child(1){ 	width : 4%; }
.th_List_quo_item:nth-child(2){ 	width : 10%; }
.th_List_quo_item:nth-child(3){ 	width : 30%; }
.th_List_quo_item:nth-child(4){ 	width : 12%; }
.th_List_quo_item:nth-child(5){ 	width : 21%; }
.th_List_quo_item:nth-child(6){ 	width : 13%; }
.th_List_quo_item:nth-child(7){ 	width : 10%; }
/*單獨客戶簡單報價單列表各欄位寬度*/
.th_List_mth_smpl_quo:nth-child(1){ 	width : 4%; }
.th_List_mth_smpl_quo:nth-child(2){ 	width : 17%; }
.th_List_mth_smpl_quo:nth-child(3){ 	width : 12%; }
.th_List_mth_smpl_quo:nth-child(4){ 	width : 10%; }
.th_List_mth_smpl_quo:nth-child(5){ 	width : 25%; }
.th_List_mth_smpl_quo:nth-child(6){ 	width : 20%; }
.th_List_mth_smpl_quo:nth-child(7){ 	width : 12%; }

/*創建修改報價單列表*/
.td_List_item_AorE {
	font-size: 70%;
	padding:0.5%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
/*創建修改報價單列表*/

/*國內城市中客戶列表*/
.td_List_city_customer {
	font-size: 80%;
	padding:1%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
.td_List_city_customer:nth-child(4),.td_List_city_customer:nth-child(5) {
	padding:0%;
	border: 0 ;	
}
/*國內城市中客戶列表*/

/*國外客戶列表*/
.td_List_worldwide_customer {
	font-size: 80%;
	padding:1%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
.td_List_worldwide_customer:nth-child(6),.td_List_worldwide_customer:nth-child(7) {
	padding:0%;
	border: 0 ;	
}
/*國外客戶列表*/
/*個人報價單列表*/
.td_List_sgl_smpl_quo {
	font-size: 60%;
	padding:0.3%;
	padding-top:0.8%;
	padding-bottom:0.8%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
.td_List_sgl_smpl_quo:nth-child(6) {
	padding:0%;
	padding-top:0%;
	padding-bottom:0%;
	border: 0 ;	
}
.td_List_mth_smpl_quo {
	font-size: 60%;
	padding:0.3%;
	padding-top:0.8%;
	padding-bottom:0.8%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
.td_List_mth_smpl_quo:nth-child(7) {
	padding:0%;
	padding-top:0%;
	padding-bottom:0%;
	border: 0 ;	
}
.td_List_quo_item {
	font-size: 60%;
	padding:0.3%;
	padding-top:0.8%;
	padding-bottom:0.8%;
	border: 1px solid <? echo $table_border_color; ?> ;	
}
.td_List_quo_item:nth-child(7) {
	padding:0%;
	padding-top:0%;
	padding-bottom:0%;
	border: 0 ;	
}
.td_List_Button {
	
	padding:0%;
	padding-top:0%;
	padding-bottom:0%;
	border: 0 ;	
}
/*個人報價單列表*/

/*置底區塊*/
footer {
	background-color:  <?php echo $footer_bg_color; ?>;
	height:<?php echo $footer_height; ?>;
	font-size: 0.25em;
	text-align: center;
	color: <?php echo $header_font_color; ?> ;
	overflow:hidden;
	
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

.test_nore{
	font-size:12px;
}


</style>
