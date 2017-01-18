<?php
	include 'config.php' ;
?>


<style type="text/css">

#btm_confirm_client, #btm_sent_quotation_list{
	height: 15%;
	width: 15%;
	text-align: center;
}

.btn_main{
	width:90%;
	height:99%;
	background-color: <?php echo $Main_btn_disable; ?>;
	color: <? echo $Main_btn_color; ?> ;
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

/*查詢功能說明區塊*/
.srch_docun{
	font-size: 100%;
	margin: 5% 25% ;
	height: 64%;
	
}
.table_srch_docun{
	font-size: 100%;
	width : 100%;
	height : 100%;
	border: 1px solid <? echo $table_border_color; ?> ;
}

.th_srch_docun{
	font-size: 62.5%;
	height : 25%;
	background-color: <? echo $table_header_color; ?> ;
}
.th_srch_docun:nth-child(odd) {
	width : 20% ;
}
.tr_srch_docun{
	font-size: 100%;
	height : 25%;
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


.tr_srch_docun:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_srch_docun:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}

/*國家按鈕*/
#div_country_btm{
	height: 19%;
	width: 20%;
	top:50%;
	float:left;
	text-align: center ;
}
/*城市按鈕*/

#div_city_btm{
	height: 13.5%;
	width: 16.66%;
	top:50%;
	float:left;
	font-size:70%;
	text-align: center ;
}

#div_customer_btm{
	height: 13.5%;
	width: 100%;
	top:50%;
	float:left;
	text-align: center ;
}
.div_btn_cities{
	height: 19%;
	width: 20%;
	float:left;
	text-align: center ;
}

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

/* 客戶清單的頁面 */
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
.th_List_top_header:nth-child(1){ 	width : 7.5%; }
.th_List_top_header:nth-child(2){ 	width : 15%; }
.th_List_top_header:nth-child(3){ 	width : 45%; }
.th_List_top_header:nth-child(4){ 	width : 15%; }
.th_List_top_header:nth-child(5){ 	width : 15%; }

.tr_List_top_header{

	font-size: 100%;
	height : 80% ;
	text-align:center;
}

.td_List_top_header {
	padding:1%;
	font-size: 80%;
	min-height : 50%;
	border: 1px solid <? echo $table_border_color; ?> ;	
	border-radius: <? echo $input_border_radius ?> ;
}

.td_List_top_header:nth-child(4),.td_List_top_header:nth-child(5) {
	padding:0%;
	font-size: 80%;
	border: 0 ;	
}

.tr_List_top_header:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_List_top_header:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}


/*header在左邊的清單*//*客戶或供應商詳細資料*/
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
.th_List_left_header:nth-child(1){  }
.th_List_left_header:nth-child(2){ 	 }
.th_List_left_header:nth-child(3){ 	 }
.th_List_left_header:nth-child(4){ 	 }
.th_List_left_header:nth-child(5){ 	 }

.tr_List_left_header{

	font-size: 100%;
	height : 80% ;
	text-align:left;
}

.td_List_left_header {
	padding-left:1%;
	font-size: 80%;
	border: 1px solid <? echo $table_border_color; ?> ;	
	border-radius: <? echo $input_border_radius ?> ;
}

.tr_List_left_header:nth-child(odd) {
	background-color: <? echo $odd_rows_color; ?> ;
}
.tr_List_left_header:nth-child(even) {
	background-color: <? echo $even_rows_color; ?> ;
}





#div_cust1{
	background: <?php echo $odd_rows_bg_color;?> ;
	color: <?php echo $odd_rows_font_color;?> ;
}
#div_cust2{
	background: <?php echo $even_rows_bg_color;?> ;
	color: <?php echo $even_rows_font_color;?> ;
}
.div_cust_0{
	height:60px;
	font-size: 62.5%;
	overflow:hidden;
	transition-property: height;
	transition-delay: 0.5s;
    transition-duration: 0.5s;
    transition-timing-function: linear;
}
.div_cust_0:hover{
	height:600px;
}
.div_cust_1{
	margin-top:10px;
	margin-left:5px;
	width:6%;
	float:left;
}
.div_cust_2{
	margin-top:10px;
	width:75%;
	float:left;
	overflow:hidden;  
}
.div_cust_3{
	margin-top:5px;
	width:18%;
	height:60px;
	text-align: center;
	float:left;
}
.btm_detail_client_quo{
	width:100%;
	height:85%;
}

/* 列出所有報價單訂單簡易資訊的頁面 */
#table_squo{	width:100%;		font-size: 62.5%;	min-height:15%;}
.table_odd{
	background: <?php echo $odd_rows_bg_color;?> ;
	color: <?php echo $odd_rows_font_color;?> ;
}
.table_even{
	background: <?php echo $even_rows_bg_color;?>;
	color: <?php echo $even_rows_font_color;?> ;
}
#table_squo_01{	width:16%;	}
#table_squo_02{	width:11%;	}
#table_squo_03{	width:38%;	}
#table_squo_04{	width:19%;	}
#table_squo_05{	width:15%;	}
.table_content_right{	text-align: right;	}
.table_content_center{	text-align: center;	}
.btm_detail_info{	width:100%;	height:100%;	}
.quo_r_marg1{	margin-right:1%;	}
.table_min_height{
	min-height:100px;
}
.quo_option{
	height: 19%;
	width: 20%;
	top:50%;
	text-align: center ;
}
.set_float_right{
	float:left;
}
.set_clear_right{
	clear:left;
}



/* 列出報價單訂單詳細資訊的頁面 */
#table_dquo{ 	width:100%;	font-size: 62.5%;	min-height:15%;}
#table_dquo_01{ width:20%;	}
#table_dquo_02{	width:12%;	}
#table_dquo_03{	width:26%;	}
#table_dquo_04{	width:27%;	}
#table_dquo_05{	width:15%;	}

#table_dquo_11{	width:6%;	}
#table_dquo_12{	width:14%;	}
#table_dquo_13{	width:38%;	}
#table_dquo_14{	width:8%;	}
#table_dquo_15{	width:19%;	}
#table_dquo_16{	width:15%;	}


/*列出供應商詳細資料的頁面*/
#table_supp{ 	width:100%;	font-size: 62.5%;	min-height:15%;}
#table_supplier_11{ width:25%;	}
#table_supplier_12{	width:50%;	}
#table_supplier_13{	width:25%;	}
#table_supplier_14{	width:27%;	}
#table_supplier_15{	width:15%;	}

#table_supplier_21{	width:25%;	}
#table_supplier_22{	width:25%;	}
#table_supplier_23{	width:25%;	}
#table_supplier_24{	width:25%;	}

#create_pdf {
	height: 15%;
	width: 15%;
	text-align: center;
}

#pdf_info {
	border-top:5px black solid;　//上方邊框寬度設為 5px，顏色為黑色
　border-right:8px red double;　//右邊的邊框寬度設為 8px，顏色為紅色，樣式為 double
　border-left:7px yellow dotted;　//左邊的邊框寬度設為 7px，顏色為黃色，樣式為 dotted
　border-bottom:3px blue dashed;　//下方邊框寬度設為 3px，顏色為藍色，樣式為 dashed
　padding:30px;
}


.table_setting_page{
	border: 1px solid black;
	min-height:80%;
	min-width:80%;
	font-size:70%;
	text-align: center;
}
.td_bor{
	border: 1px solid black;
}


/*分隔線用*/
.separation
{
	height: 1%;
}
/*主頁面中，標題區塊用*/
.art_top{ //
	min-height: 8%; /*2.0 new_add*/
	font-size: 80%;
	text-align: center;
}

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

}

/*  側邊選單 */
.div_Main_aside{
	height:19.5%;
	text-align: left;
}
.div_Main_asideR{
	height:19.5%;
	text-align: right;
}
.div_Sub_aside{
	height:19.5%;
	text-align: center;
}
.Main_aside{
	width:50%;
	background-color: <?php echo $asideL_bg_color; ?> ;
	height: <? echo $default_main_height ?>;
	float:left;
}
.Main_aside_Style_1{
	width:100%;
}
.Main_aside_Style_2{
	width:50%;
}

.Sub_aside{
	width:50%;
	background-color: <?php echo $asideM_bg_color; ?> ;
	height: <? echo $default_main_height ?>;
	float:left;
}
.aside_Style_2 {
	width:20%;
	float:left;
}
.aside_Style_1 {
	width:10%;
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
	margin:0.3%;
}


/*置底區塊*/
footer {
	background-color:  <?php echo $footer_bg_color; ?>;
	height:<?php echo $footer_height; ?>;
	font-size: 0.25em;
	text-align: center;
	color: <?php echo $header_font_color; ?> ;
	overflow:hidden;
}
footer a:link {color:<?php echo $header_font_color; ?>;} /* 設定尚未點閱過的連結樣式顏色 */
footer a:visited {color:<?php echo $header_font_color; ?>;} /* 設定過去曾經閱過的連結顏色 */


body {
	font-family: <?php echo $body_font_family; ?> ;	
	margin: 0 0 0 0 ;
	padding: 0 0 0 0 ;
	/*text-shadow:#999 0.005em 0.005em 0.0025em;*/
	font-weight:250;
	overflow-y:hidden;
}

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


</style>
