<?php
//設定時間變數
date_default_timezone_set("Asia/Taipei");
$mdate=date ("Y-m-d");
$mtime=date ("H:i:s");

//設定連線資料庫基本資訊
$servername = "127.0.0.1";
$username = "root";
$password = "helloroot";
$dbname = "client_info";

//連線到 database
function connect2db() {
	global $servername, $username, $password ;
	global $conn ;
	// 建立 MySQL 連線
	$conn = mysql_connect($servername, $username, $password) ;
	// 連線檢查
	if ($conn->connect_error) {
		die("連線資料庫失敗，請檢查資料庫的帳號與密碼，以及要進入的資料庫名稱" . $conn->connect_error);
	}
}


//抓取所有國家跟城市的資料
function get_location_list(){
	//連接資料庫
	connect2db() ;
	global $conn ;
	
																			//抓取不重複的國家名稱 DISTINCT:篩選掉已有的資料
	$sql_cmd="SELECT DISTINCT country,country_sid FROM client_info.location_db WHERE invalid = 0" ;	
	//$sql_cmd="SELECT * FROM client_info.location_db" ;					//test:抓取整個table    
	$temp = mysql_query($sql_cmd , $conn);									//將指令執行結果存入temp
		
	for( $i=0 ; $row = mysql_fetch_array($temp) ; $i++){
		$_SESSION["location_country_arr"][$i][0]=$row['country'];			//將資料庫中有的國家"名稱"各別放入location_country_arr['國家'][0]
		$_SESSION["location_country_arr"][$i][1]=$row['country_sid'];		//將資料庫中有的國家"流水號"各別放入location_country_arr['國家'][1]
        //echo $_SESSION["location_country_arr"][$i];						//test:顯示國家名稱
    }
	
	for( $i=0 ; $i<sizeof($_SESSION["location_country_arr"]) ; $i++){
		$sql_cmd="SELECT * FROM client_info.location_db WHERE country_sid='".$_SESSION["location_country_arr"][$i][1]."' AND invalid = 0" ;
		$temp = mysql_query($sql_cmd , $conn);								//依靠國家當關鍵字抓取城市資料(全抓)
		
		for( $j=0 ; $row = mysql_fetch_array($temp) ; $j++){
			$_SESSION["location_city_arr"][$i][$j][0]=$row['location_id'];	//將城市"編號"各別放入location_country_arr['城市'][0]
			$_SESSION["location_city_arr"][$i][$j][1]=$row['city'];			//將城市"名稱"各別放入location_country_arr['城市'][1]
		}
	}
}

function get_item_list(){
	//連接資料庫
	connect2db() ;
	global $conn ;
	
	$sql_cmd="SELECT * FROM client_info.item_db" ;							//抓取所有的物品資料
	$temp = mysql_query($sql_cmd , $conn);									//將指令執行結果存入temp
		
	for( $i=1 ; $row = mysql_fetch_array($temp) ; $i++){
		$_SESSION["item_arr"][$i][0]=$row['item_id'];						//將資料庫中所有欄位分別放入[0-5]
        $_SESSION["item_arr"][$i][1]=$row['s_id'];
		$_SESSION["item_arr"][$i][2]=$row['name'];
		$_SESSION["item_arr"][$i][3]=$row['supplier_id'];
		$_SESSION["item_arr"][$i][4]=$row['price'];
		$_SESSION["item_arr"][$i][5]=$row['currency'];
    }
}



// ---------- ↓創建報價單區↓ ----------
//左側欄選擇建立報價單會執行的 function
function main_create_quotation() {
	connect2db() ;
	global $conn ;
	global $client_arr ;
	$client_arr=array() ;

	$sql_cmd = "select name from client_info.customer_db WHERE invalid = 0" ;

	$result = mysql_query( $sql_cmd, $conn ) ;

	if( !$result ) {
		die('Could not get data: ' . mysql_error()) ;
	}

	while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
    	array_push($client_arr,$row['name']) ;
	}

	echo "<select name=select_client>" ;
	for ( $i=0 ; $i<sizeof($client_arr) ; $i++ ) {
		echo "<option id='t' value='".$client_arr[$i]."'>".$client_arr[$i]."</option>" ;
		//echo "<option value=$i>".$client_arr[$i]."</option>" ;
	}
	echo "</select>" ;

	echo "<button type=submit name=btm_confirm_client id='btm_confirm_client'>確認</button>" ;
}

//建立報價單時，要列出所有的產品選擇
function quotation_products_list( $c ) {
	connect2db() ;
	global $conn ;
	global $products_arr ;

	$products_arr=array() ;
	$sql_cmd = "select * from client_info.".$c ;	
	$result = mysql_query( $sql_cmd, $conn ) ;

	if( !$result ) {
		$sql_cmd = "CREATE TABLE client_info.".$c." (total char(50), date text" ;
		for ( $i=1 ; $i<=10 ; $i++ ) {
			$sql_cmd = $sql_cmd.", product".$i." char(50), count".$i." char(50), price".$i." char(50)" ;
		}
		$sql_cmd = $sql_cmd.")" ;
	}
	$result = mysql_query( $sql_cmd, $conn ) ;
	if( !$result ) {
		die('Create Failed.  ' . mysql_error()) ;
	}


	$sql_cmd = "use products" ;
	$result = mysql_query( $sql_cmd, $conn ) ;
	$sql_cmd = "show tables" ;
	$result = mysql_query( $sql_cmd, $conn ) ;

	if( !$result ) {
		die('Could not get data: ' . mysql_error()) ;
	}

	while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
    	array_push($products_arr,$row['Tables_in_products']) ;
	}


	echo "<input type=text name=create_quotation_client value='$c' readonly>" ;

	echo "<table border=1><tbody>" ;
	for ( $i=1 ; $i<=10 ; $i++ ) {
		echo "<tr><td>" ;

		echo "<select name=select_product".$i.">" ;
		echo "<option value='null'> － － － － </option>" ;
		for ( $j=0 ; $j<sizeof($products_arr) ; $j++ ) {
			echo "<option value='".$products_arr[$j]."'>".$products_arr[$j]."</option>" ;
		}
		echo "</select>" ;
		
		echo "</td>" ;
		echo "<td><input type=text name=count".$i." placeholder=數量></td>" ;
		echo "<td><input type=text name=price".$i." placeholder=價格></td>" ;
		echo "</tr>" ;
	}
	echo "</tbody></table>" ;

	echo "<button type=submit name=btm_sent_quotation_list id='btm_sent_quotation_list'>建立報價單</button>" ;

}

//儲存報價單
function save_quotation( $client, $quotation_arr ) {
	//連接資料庫
	connect2db() ;
	global $conn ;
	global $save_quotation_client ;
	//echo sizeof($quotation_arr)/3 ;
	//echo "<br/>" ;
	//echo $client."<br/>" ;

	$total=0 ;
	for( $i=2 ; $i<sizeof($quotation_arr) ; $i=$i+3 ) {
		$total = $total+$quotation_arr[$i] ;
	}
	echo $total ;
	$date = date('Y-m-d');

	$sql_cmd = "insert into client_info.$client(total,date" ;
	for( $i=1 ; $i<=sizeof($quotation_arr)/3 ; $i++ ) {
		$sql_cmd = $sql_cmd.",product$i,count$i,price$i" ;
	}
	$sql_cmd = $sql_cmd.") " ;
	$sql_cmd = $sql_cmd."values($total,'$date'" ;
	for( $i=0 ; $i<sizeof($quotation_arr) ; $i++ ) {
		$sql_cmd = $sql_cmd.",'$quotation_arr[$i]'" ;
	}
	$sql_cmd = $sql_cmd.") " ;

	echo $sql_cmd ;
	
	$result = mysql_query( $sql_cmd, $conn ) ;
	if( !$result ) {
		die('Could not get data: ' . mysql_error()) ;
	}

	echo "報價單新增成功" ;
	//echo $sql_cmd ;
	//print_r(array_values($quotation_arr)) ;
}
// ---------- ↑創建報價單區↑ ----------

// ---------- ↓查詢報價單訂單區↓ ----------

//選擇要查詢報價單的方式 依時間 國內客戶 國外客戶
function Sub_Aside($main_choose){	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$main_choose."' >";
	/*
	if($_REQUEST['srch_way_choose']==1  )
		$active_way=1;
	else if($_REQUEST['srch_way_choose']==2  )
		$active_way=2;
	else if($_REQUEST['srch_way_choose']==3  )
		$active_way=3;
	else
		$active_way=0;*/
	if(isset($_REQUEST['main_choose']))
		$active_way=0;
	else if(isset($_REQUEST['srch_way_choose']))
		$active_way=$_REQUEST['srch_way_choose'];
	else if(isset($_REQUEST['Which_Sub_choose']))
		$active_way=$_REQUEST['Which_Sub_choose'];
	else
		$active_way=0;
			
	echo "<div class='Sub_aside'>";	
		echo "	<div id='srch_way'>	
					<ul>";
					
	$way_content=array("0"=>"說　明","1"=>"流水編號","2"=>"本國客戶","3"=>"外國客戶");
	
	for($sw=0;$sw<4;$sw++){
		if($active_way==$sw)
					echo "<li id='sw_li_active'><button type=submit id='sw_btn_active' name='srch_way_choose' value=".$sw." >";
		else
					echo "<li><button type=submit name='srch_way_choose' value=".$sw." >";
				
		echo $way_content[$sw]."</button></li>";
	}
			echo "	</ul>
				</div>";
	//echo "swc:".$_REQUEST['srch_way_choose']."_";
	//echo "aw:".$active_way."_";

}

function main_search_way($main_choose,$clear_way){
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$main_choose."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['srch_way_choose']."' >";
	
	//跟首頁的狀況一樣，要小心優先權被記憶變數搶走
	if($clear_way==1)
		$active_way=0;
	else if(isset($_REQUEST['srch_way_choose']))
		$active_way=$_REQUEST['srch_way_choose'];
	else if(isset($_REQUEST['Which_Sub_choose']))
		$active_way=$_REQUEST['Which_Sub_choose'];
	else
		$active_way=0;
	
	if( $main_choose==2 )
		$content_qorp = "報價單";
	else
		$content_qorp = "已成交訂單";
	
	if($active_way==1)
	{
		month_of_year();
		//echo "mc:".$_REQUEST['srch_way_choose']."_</div>";
	}
	else if($active_way==2)
	{
		//echo "mc:".$_REQUEST['srch_way_choose']."_</div>";
		cities_of_country('TW');
	}
	else if($active_way==3)
	{
		echo_worldwide_customer('TW');
		//echo "mc:".$_REQUEST['srch_way_choose']."_</div>";
	}
	else
	{
		echo "<div class ='srch_docun'>";
			echo "<table class='table_srch_docun'>";
			
				echo "<tr>";
				echo "<th class='th_srch_docun'>按鈕名稱";
				echo "</th>";
				echo "<th class='th_srch_docun'>功能說明";
				echo "</th>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun'>";
				echo "<td class='td_srch_docun'>流水編號";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						列出有<b>".$content_qorp."</b>紀錄的月份，<br>
						選擇月份後，列出該月所有<b>".$content_qorp."</b>。";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun'>";
				echo "<td class='td_srch_docun'>本國客戶";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						依照台灣縣市來區分客戶，存在客戶且客戶有<b>".$content_qorp."</b>的縣市才會顯示。<br>
						選擇縣市後，列出屬於該縣市中所有擁有<b>".$content_qorp."</b>的客戶，<br>
						選擇客戶後，列出屬於該客戶的所有<b>".$content_qorp."</b>。";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun'>";
				echo "<td class='td_srch_docun'>外國客戶";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						列出所有擁有<b>".$content_qorp."</b>的外國客戶，<br>
						選擇客戶後，列出屬於該客戶的所有<b>".$content_qorp."</b>。";
				echo "</td>";
				echo "</tr>";
				
			echo "</table>";
		echo "</div>";
	}
}

/*取得該國所有有報價單的客戶的所在位置*/
function cities_of_country($tgt_cntry){ //target country

	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['srch_way_choose']."' >";
	
	connect2db() ;
	global $conn ;			
	
	//是否篩選掉不是訂單的報價單
	if( $_REQUEST['Which_Main_choose']==2 )
		$check_order = 0;
	else
		$check_order = 1;
	
	//抓出所有有報價單的客戶的所在位置
	$sql_cmd = "SELECT DISTINCT C.location,L.city FROM client_info.quotation_simple_db AS QS
					LEFT JOIN client_info.customer_db AS C ON QS.customer_id=C.customer_id
					LEFT JOIN client_info.location_db AS L ON C.location=L.location_id
					WHERE QS.invalid = 0 AND L.country_sid = '".$tgt_cntry."' AND QS.is_order >= ".$check_order."
					ORDER BY C.location;" ;
	
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	//echo $sql_cmd;
	//echo "swc:".$_REQUEST['srch_way_choose']."_</div>";
	
	if(mysql_num_rows($result)>0){
		$location_city_arr=array();
		
		for( $i=0 ; $row = mysql_fetch_array($result) ; $i++){
				$location_city_arr[$i][0]=$row['location'];		//將城市"編號"各別放入location_country_arr['城市'][0]
				$location_city_arr[$i][1]=$row['city'];			//將城市"名稱"各別放入location_country_arr['城市'][1]
		}
		/*//test output
		for( $i=0 ; $i<$location_city_amount ; $i++){
				echo "編號 ".$location_city_arr[$i][0]." ";
				echo "地名 ".$location_city_arr[$i][1]." <br>";
		}*/
		
		echo "<div class='art_top '> 請選擇客戶所在的城市：<div ='separation'><hr class='set_List_border_color'></div></div>";
		//echo "<div class='separation set_clear_right'><hr></div>";
		for ( $i=0 ; $i<sizeof($location_city_arr) ; $i++ ) {
																				
			echo   "<div class = div_btn_cities>
					<button type=submit class='btn_List'
						name=btn_city_to_customer value=".$location_city_arr[$i][0]." >"
						.$location_city_arr[$i][1].
					"</button></div>" ;
		}
	}
	else{
		echo "<div class='art_top'> 對不起，查無資料。</div>";
	}
}

/*取得所有存在報價單的月份*/
function month_of_year(){
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['srch_way_choose']."' >";
	
	connect2db() ;
	global $conn ;			
	
	//是否篩選掉不是訂單的報價單
	if( $_REQUEST['Which_Main_choose']==2 )
	{
		$content_qorp ="報價單";
		$check_order = 0;
	}
	else
	{	
		$content_qorp ="訂單";
		$check_order = 1;
	}
	
	//抓出所有有報價單的客戶的所在位置
	$sql_cmd = "SELECT DISTINCT QS.date_y,QS.date_m
                	FROM client_info.quotation_simple_db AS QS
				WHERE QS.invalid = 0 AND QS.is_order >= ".$check_order."
				ORDER BY QS.date DESC;" ;
	
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	//echo $sql_cmd;
	//echo "swc:".$_REQUEST['srch_way_choose']."_</div>";
	
	if(mysql_num_rows($result)>0){
		$date_arr=array();
		
		for( $i=0 ; $row = mysql_fetch_array($result) ; $i++){
				$date_arr[$i][0]=$row['date_y'];		
				$date_arr[$i][1]=$row['date_m'];		
		}
		/*//test output
		for( $i=0 ; $i<$location_city_amount ; $i++){
				echo "編號 ".$date_arr[$i][0]." ";
				echo "地名 ".$date_arr[$i][1]." <br>";
		}*/
		
		echo "<div class='art_top '> 請選擇想要瀏覽".$content_qorp."的月份：<div ='separation'><hr class='set_List_border_color'></div></div>";
		//echo "<div class='separation set_clear_right'><hr></div>";
		for ( $i=0 ; $i<sizeof($date_arr) ; $i++ ) {
					
			if($date_arr[$i][1]<10)
				echo   "<div class = div_btn_cities>
						<button type=submit class='btn_List'
							name=btn_date_to_quo value=".$date_arr[$i][0]."0".$date_arr[$i][1]." >"
							.$date_arr[$i][0]." 年 ".$date_arr[$i][1]." 月
						</button></div>" ;
			else
				echo   "<div class = div_btn_cities>
						<button type=submit class='btn_List'
							name=btn_date_to_quo value=".$date_arr[$i][0].$date_arr[$i][1]." >"
							.$date_arr[$i][0]." 年 ".$date_arr[$i][1]." 月
						</button></div>" ;

		}
	}
	else{
		echo "<div class='art_top'> 對不起，查無資料。</div>";
	}
}

//取得該城市的所有客戶名單
function echo_city_customer($location){
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_POST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	connect2db() ;
	global $conn ;			
	
	if( $_POST['Which_Main_choose']==2 )
	{
		$check_order = 0;
		$content_qorp = "報價單";
	}
	else{
		$check_order = 1;
		$content_qorp = "訂單";
	}
	
	//抓出所有該城市的客戶(以及該城市的資料)
	$sql_cmd = "SELECT DISTINCT C.*, L.city 
					FROM client_info.quotation_simple_db AS QS
				LEFT JOIN client_info.customer_db AS C 
					ON QS.customer_id=C.customer_id
				LEFT JOIN client_info.location_db AS L 
					ON C.location=L.location_id
				WHERE QS.invalid = 0 AND C.location = ".$location." AND QS.is_order >= ".$check_order."
				ORDER BY C.location;" ;
	/*old version:會抓到沒有報價單的傢伙*//*
	$sql_cmd = "SELECT *
				FROM client_info.customer_db AS C
				LEFT JOIN client_info.location_db AS L
				ON C.location = L.location_id
				WHERE C.location = ".$location." and C.invalid = 0 ;" ;
	*/
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	//echo $result;
	//echo "swc:".$_REQUEST['srch_way_choose']."_</div>";
	
	if(mysql_num_rows($result)>0){
		
		
		
		$row_no=1;
		while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) 
		{
			if($row_no==1){
				echo "<div class='art_top'> 以下為在 <b>".$row['city']."</b> 的客戶：</div>";
				echo "<div class='div_List_top_header'>";
				echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_city_customer'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_city_customer'>客戶流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_city_customer'>客戶名稱";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_city_customer'>客戶<br>詳細資料";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_city_customer'>查看<br>".$content_qorp;
						echo "</th>";
					echo "</tr>";
			}
			
			echo "<tr class='tr_List_top_header'>";
				echo "<td class='td_List_top_header td_List_city_customer'>".$row_no;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_city_customer'>".$row['s_id'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_city_customer'>".$row['name']."";
				echo "</td>";
				echo "<td class='td_List_top_header td_List_city_customer'>";
					echo "<button type=submit class='btn_List' name=btn_detail_customer value=".$row['customer_id']." '>詳細資料</button>" ;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_city_customer'>";
					echo "<button type=submit class='btn_List' name=btn_list_simple_quo value=".$row['customer_id']." >查看".$content_qorp."</button>" ;
				echo "</td>";
			echo "</tr>";
			$row_no++;
		}
		echo "</table>";
		echo "</div>";
		
	}
	else{
		echo "<div class='art_top'> 對不起，查無資料。</div>";
	}
}

//取得該月的所有報價單
function echo_list_month_all_simple_quo( $dateYYYYMM ) {
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	//連接資料庫
	connect2db() ;
	global $conn ;
	
	//抓出客戶所有的 0:報價單資料   1:訂單資料
	if($_REQUEST['Which_Main_choose']==2){
		$check_qorp=0;
		$content_qorp="報價單";
		$sql_qorp="qu_s_id";
	}
	else{
		$check_qorp=1;
		$content_qorp="訂單";
		$sql_qorp="po_s_id";
	}
	//抓取該月的所有報價單、客戶簡稱、物品名稱
	$sql_cmd = "SELECT QS.*, C.nickname AS cname, I.name AS iname
				FROM client_info.quotation_simple_db AS QS
				LEFT JOIN client_info.customer_db AS C
				ON QS.customer_id = C.customer_id
				LEFT JOIN client_info.item_db AS I
				ON QS.item_id = I.item_id
				WHERE QS.date_y = ".(int)($dateYYYYMM/100)." AND QS.date_m = ".($dateYYYYMM%100)." AND QS.is_order >= ".$check_qorp." AND QS.invalid = 0 
				ORDER BY ".$sql_qorp." DESC";
//				ORDER BY date DESC";

	$result = mysql_query( $sql_cmd, $conn ) ;

	if(mysql_num_rows($result)>0){
		for( $row_no=1; $row = mysql_fetch_array( $result) ; $row_no++ ) 
		{
			if($row_no==1){
				echo "<div class='art_top'> 以下為 <b>".(int)($dateYYYYMM/100)." 年 ".(int)($dateYYYYMM%100)." 月 </b> 的".$content_qorp."：</div>";
				echo "<div class='div_List_top_header'>";
				echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>".$content_qorp."<br>流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>報價單<br>創建日期";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>客戶<br>簡稱";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>重點<br>採買項目";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>總金額<br>";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_mth_smpl_quo'>詳細<br>".$content_qorp;
						echo "</th>";
					echo "</tr>";
			}
			
			echo "<tr class='tr_List_top_header'>";
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$row_no;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$row[$sql_qorp];
				echo "</td>";
				//截短日期
				$quo_time = strtotime($row['date']);
				$quo_time = date("Y-m-d", $quo_time);
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$quo_time;
				echo "</td>";
				if($row['cname']==NULL)
					echo "<td class='td_List_top_header td_List_mth_smpl_quo'><I><font color=#aaa>尚未設定<br>客戶簡稱</font></I>";
				else
					echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$row['cname'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$row['iname'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>".$row['currency']."$ ".number_format($row['price']);
				echo "</td>";
				echo "<td class='td_List_top_header td_List_mth_smpl_quo'>";
					echo "<button type=submit class='btn_List' name=btn_list_detail_quo value=".$row['quo_id']." >查看".$content_qorp."</button>" ;
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";		
	}
	else
	{
		echo "<div class='art_top'> 對不起，查無客戶帳務資料。</div>";
	}

}

//取得國外的所有客戶名單
function echo_worldwide_customer($tgt_cntry){
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['srch_way_choose']."' >";
	
	connect2db() ;
	global $conn ;			
	
	if( $_POST['Which_Main_choose']==2 )
	{
		$check_order = 0;
		$content_qorp = "報價單";
	}
	else{
		$check_order = 1;
		$content_qorp = "訂單";
	}
	
	//抓出所有該城市的客戶(以及該城市的資料)
	$sql_cmd = "SELECT DISTINCT C.*, L.city ,L.country
					FROM client_info.quotation_simple_db AS QS
				LEFT JOIN client_info.customer_db AS C 
					ON QS.customer_id=C.customer_id
				LEFT JOIN client_info.location_db AS L 
					ON C.location=L.location_id
				WHERE QS.invalid = 0 AND L.country_sid != '".$tgt_cntry."' AND QS.is_order >= ".$check_order."
				ORDER BY L.country_sid, L.city_sid , C.s_id ASC;" ;
	/*old version:會抓到沒有報價單的傢伙*//*
	$sql_cmd = "SELECT *
				FROM client_info.customer_db AS C
				LEFT JOIN client_info.location_db AS L
				ON C.location = L.location_id
				WHERE C.location = ".$location." and C.invalid = 0 ;" ;
	*/
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	//echo $result;
	//echo "swc:".$_REQUEST['srch_way_choose']."_</div>";
	
	if(mysql_num_rows($result)>0){
		
		
		
		$row_no=1;
		while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) 
		{
			if($row_no==1){
				echo "<div class='art_top'> 以下為在 <b>外國</b> 的客戶：</div>";
				echo "<div class='div_List_top_header'>";
				echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>客戶流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>客戶簡稱";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>國家";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>城市";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>客戶<br>詳細資料";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_worldwide_customer'>查看<br>".$content_qorp;
						echo "</th>";
					echo "</tr>";
			}
			
			echo "<tr class='tr_List_top_header'>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>".$row_no;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>".$row['s_id'];
				echo "</td>";
				if($row['nickname']==NULL)
					echo "<td class='td_List_top_header td_List_worldwide_customer'><I><font color=#aaa>尚未設定<br>客戶簡稱</font></I>";
				else
					echo "<td class='td_List_top_header td_List_worldwide_customer'>".$row['nickname']."";
				echo "</td>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>".$row['country']."";
				echo "</td>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>".$row['city']."";
				echo "</td>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>";
					echo "<button type=submit class='btn_List' name=btn_detail_customer value=".$row['customer_id']." '>詳細資料</button>" ;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_worldwide_customer'>";
					echo "<button type=submit class='btn_List' name=btn_list_simple_quo value=".$row['customer_id']." >查看".$content_qorp."</button>" ;
				echo "</td>";
			echo "</tr>";
			$row_no++;
		}
		echo "</table>";
		echo "</div>";
		
	}
	else{
		echo "<div class='art_top'> 對不起，查無資料。</div>";
	}
}

//列出供應商或客戶的詳細資料
function list_detail_cus_or_sup_info($type,$type_info){
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	connect2db() ;
	global $conn ;			
	
	//列出客戶的詳細資料
	if($type==1){
		$sql_cmd = "SELECT C.*, L.country, L.city
					FROM client_info.customer_db AS C
                    LEFT JOIN client_info.location_db AS L
                    ON C.location = L.location_id
					WHERE customer_id = ".$type_info." ;" ;
	}
	//列出供應商的詳細資料
	else{
		$sql_cmd = "SELECT I.name AS iname, S.*, L.country, L.city
					FROM client_info.item_db AS I 
					LEFT JOIN client_info.supplier_db AS S 
					ON I.supplier_id = S.supplier_id 
                    LEFT JOIN client_info.location_db AS L
                    ON S.location = L.location_id
					WHERE I.item_id =  ".$type_info." ;" ;
	}
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	//echo $result;
	//echo "swc:".$_REQUEST['srch_way_choose']."_</div>";
	
	if(mysql_num_rows($result)>0){		
		
		$row = mysql_fetch_array( $result, MYSQL_ASSOC ) ;
		if($type==1){
			echo "<div class='art_top'> 以下為 <b>".$row['name']."</b> 的客戶詳細資料：</div>";				
		}
		else{
			echo "<div class='art_top'> 以下為 <b>".$row['iname']."</b> 的供應商詳細資料：</div>";
		}
			echo "<div class='div_List_left_header'>";
			echo "<table class='table_List_left_header'>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>流水編號";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['s_id'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>統一編號";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['ubn'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>名稱全名";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['name'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>名稱簡稱";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['nickname'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>所在國家";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['country'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>所在城市";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['city'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>聯絡人";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['contact'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>聯絡人電話";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['contact_phone'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>公司電話";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['company_phone'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>傳真";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['company_fax'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>地址";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['address'];
				echo "</td>";
			echo "</tr>";
			
			echo "<tr class='tr_List_left_header'>";
				echo "<th class='th_List_left_header'>信箱";
				echo "</th>";
				echo "<td class='td_List_left_header'>".$row['email'];
				echo "</td>";
			echo "</tr>";
			
		echo "</table>";
		echo "</div>";
		
	}
	else{
		echo "<div class='art_top'> 對不起，查無資料。</div>";
	}
}



//顯示出各個國家的 button
/*
function main_echo_location_btm() {
	echo "<div class='art_top'> 請選擇客戶所在的國家：</div>";
	for ( $i=0 ; $i<sizeof($_SESSION["location_country_arr"]) ; $i++ ) {
		$name=$_SESSION["location_country_arr"][$i][0] ;
		$s_id=$_SESSION["location_country_arr"][$i][1] ;
		echo "<div id = div_country_btm><button type=submit name=btm_co".$s_id." id=btm_co".$s_id.">".$name."</button></div>" ;
	}
	
	//填滿國家那行
	for ( $i=$i ; $i%5!=0 ; $i++ ) {
		echo "<div id = div_country_btm></div>" ;
	}
	
	*//*//直接從流水碼搜尋，尚待撰寫
	echo "<div class='separation'><hr></div>	";	
	echo "<div class='art_top'> 或直接輸入流水碼查詢：</div>";
	echo "<div><input type=search type=text name=searchbysid placeholder='流水碼' /></div>" ;
	echo "<input type=submit />";*//*
}*/


//顯示出各個城市的 button
/*
function main_echo_city_btm($co) {
	echo "<div class='art_top'> 請選擇客戶所在的城市：</div>";
	//一樣要顯示所有國家的按鈕，當前國家加上引號《》
	for ( $i=0 ; $i<sizeof($_SESSION["location_country_arr"]) ; $i++ ) {
		$name=$_SESSION["location_country_arr"][$i][0] ;
		$s_id=$_SESSION["location_country_arr"][$i][1] ;
		if($i==$co)
			echo "<div id = div_country_btm><button type=submit name=btm_co".$s_id." id=btm_co".$s_id.">《".$name."》</button></div>" ;
		else
			echo "<div id = div_country_btm><button type=submit name=btm_co".$s_id." id=btm_co".$s_id.">".$name."</button></div>" ;
	}	
	//填滿國家那行，不然城市按鈕會直接接在國家按鈕的右邊
	for ( $i=$i ; $i%5!=0 ; $i++ ) {
		echo "<div id = div_country_btm></div>" ;
	}
	
	//顯示各個城市的按鈕
	for ( $i=0 ; $i<sizeof($_SESSION["location_city_arr"][$co]) ; $i++ ) {
																			
		echo   "<div id = div_city_btm>
				<button type=submit 
					name=btm_city".$_SESSION["location_city_arr"][$co][$i][0].
					" value=btm_city".$_SESSION["location_city_arr"][$co][$i][0]." >"
					.$_SESSION["location_city_arr"][$co][$i][1].
				"</button></div>" ;
	}

}*/

//顯示該地點的所有客戶
/*old version*//*
function echo_location_client( $l ) {
	//清除訂單資訊
	unset($_SESSION["cust_info"]);
	
	//連接資料庫
	connect2db() ;
	global $conn ;															
	//抓出某個城市的所有客戶資料
	$sql_cmd = "SELECT * FROM client_info.customer_db WHERE location =".$l[0]." and invalid = 0 " ;

	$result = mysql_query( $sql_cmd, $conn ) ;
	
	if(mysql_num_rows($result)>0){
		echo "<div class='art_top'> 以下為在 <b>".$l[1]."</b> 的客戶：</div>";
		$row_no=1;
		while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) 
		{
			if($row_no%2==1)												//奇數行
				echo "<div id=div_cust1 class=div_cust_0>";
			else															//偶數行
				echo "<div id=div_cust2 class=div_cust_0>";
			echo "<div  class=div_cust_1>".$row_no.".</div>" ;
			echo "<div  class=div_cust_2>↓ ".$row['nickname']."<br><hr>";
			echo "<b>流水號</b>：".$row['s_id']."<br>" ;
			echo "<b>客戶全名</b>：".$row['name']."<br>" ;
			echo "<b>統一編號</b>：".$row['ubn']."<br>";
			echo "<b>聯絡人</b>：".$row['contact']."<br>";
			echo "<b>聯絡人電話</b>：".$row['contact_phone']."<br>";
			echo "<b>公司電話</b>：".$row['company_phone']."<br>";
			echo "<b>公司傳真</b>：".$row['company_fax']."<br>";
			echo "<b>地址</b>：".$row['address']."<br>";
			echo "<b>信箱</b>：".$row['email']."<br>";
			echo "</div>";
			$_SESSION["cust_info"][$row['customer_id']]=$row['nickname'];	//儲存下個頁面需要用到的資料
			if($_SESSION["action_choose"]==2)
				echo "<div  class=div_cust_3><button type=submit class=btm_detail_client_quo name=btm_find_client_quotation_list value=".$row['customer_id']." '>報價單</button></div>" ;
			else
				echo "<div  class=div_cust_3><button type=submit class=btm_detail_client_quo name=btm_find_client_quotation_list value=".$row['customer_id']." '>訂單</button></div>" ;
			echo "</div>";
						
			$row_no++;
		}
	}
	else{
		echo "<div class='art_top'> 對不起，查無客戶資料。</div>";
		//die(' ' . mysql_error()) ;		
	}
	
	echo "<div class='separation'><hr></div>";	
	
	for ( $i=0 ; $i<sizeof($_SESSION["location_country_arr"]) ; $i++ ) {
		$name=$_SESSION["location_country_arr"][$i][0] ;
		$s_id=$_SESSION["location_country_arr"][$i][1] ;
		echo "<div id = div_country_btm><button type=submit name=btm_co".$s_id." id=btm_co".$s_id.">回到 ".$name."</button></div>" ;
	}

}*/


//顯示客戶所有的報價單
function echo_list_single_customer_simple_quo( $customer ) {
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	//連接資料庫
	connect2db() ;
	global $conn ;
	
	//抓出客戶所有的 0:報價單資料   1:訂單資料
	if($_REQUEST['Which_Main_choose']==2){
		$check_qorp=0;
		$content_qorp="報價單";
		$sql_qorp="qu_s_id";
	}
	else{
		$check_qorp=1;
		$content_qorp="訂單";
		$sql_qorp="po_s_id";
	}
	
	//抓取該客戶的所有報價單、客戶名稱、物品名稱
	$sql_cmd = "SELECT QS.*, C.name AS cname, I.name AS iname
				FROM client_info.quotation_simple_db AS QS
				LEFT JOIN client_info.customer_db AS C
				ON QS.customer_id = C.customer_id
				LEFT JOIN client_info.item_db AS I
				ON QS.item_id = I.item_id
				WHERE QS.customer_id = ".$customer." AND QS.is_order >= ".$check_qorp." AND QS.invalid = 0 
				ORDER BY date DESC ";

	$result = mysql_query( $sql_cmd, $conn ) ;

	if(mysql_num_rows($result)>0){
		for( $row_no=1; $row = mysql_fetch_array( $result) ; $row_no++ ) 
		{
			if($row_no==1){
				echo "<div class='art_top'> 客戶 <b>".$row['cname']."</b> 的".$content_qorp."：</div>";
				echo "<div class='div_List_top_header'>";
				echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>".$content_qorp."<br>流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>報價單<br>創建日期";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>重點<br>採買項目";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>總金額<br>";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>詳細<br>".$content_qorp;
						echo "</th>";
					echo "</tr>";
			}
			
			echo "<tr class='tr_List_top_header'>";
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>".$row_no;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>".$row[$sql_qorp];
				echo "</td>";
				//截短日期
				$quo_time = strtotime($row['date']);
				$quo_time = date("Y-m-d", $quo_time);
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>".$quo_time;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>".$row['iname'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>".$row['currency']."$ ".number_format($row['price']);
				echo "</td>";
				echo "<td class='td_List_top_header td_List_sgl_smpl_quo'>";
					echo "<button type=submit class='btn_List' name=btn_list_detail_quo value=".$row['quo_id']." >查看".$content_qorp."</button>" ;
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";		
	}
	else
	{
		echo "<div class='art_top'> 對不起，查無客戶帳務資料。</div>";
	}

}
/*old version*//*
function list_client_quotations( $client ) {
	//清除訂單資訊
	unset($_SESSION["quo_info"]);
	
	//連接資料庫
	connect2db() ;
	global $conn ;
	
	//抓出客戶所有的 0:報價單資料   1:訂單資料
	if($_SESSION["action_choose"]==2)
		$sql_cmd = "select * from client_info.quotation_simple_db WHERE customer_id =".$client." AND is_order = 0 AND invalid = 0 order by date DESC ";
	else
		$sql_cmd = "select * from client_info.quotation_simple_db WHERE customer_id =".$client." AND is_order = 1 AND invalid = 0 order by date DESC ";

	$result = mysql_query( $sql_cmd, $conn ) ;

	if(mysql_num_rows($result)>0){
		if($_SESSION["action_choose"]==2)
			echo "<div class='art_top'> 客戶 <b>".$_SESSION["cust_info"][$client]."</b> 的報價單：</div>";
		else
			echo "<div class='art_top'> 客戶 <b>".$_SESSION["cust_info"][$client]."</b> 的已成交訂單：</div>";

		$row_no=1;
		echo "<div>";
		echo "<table id=table_squo>";
		echo "<tr class=table_even>";
			echo "	<th id=table_squo_01>流水編號</th>";
		if($_SESSION["action_choose"]==2)
			echo "	<th id=table_squo_01>報價單創建時間</th>";
		else
			echo "	<th id=table_squo_02>訂單創建時間</th>";
			echo "	<th id=table_squo_03>重點採買項目</th>";
			echo "	<th id=table_squo_04>總金額</th>";
			echo "	<th id=table_squo_05></th>";
		echo "</tr>";
		while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) 
		{
			if($row_no%2==1)
				echo "<tr class='table_odd table_content_right'>";
			else
				echo "<tr class='table_even table_content_right'>";
				if($_SESSION["action_choose"]==2)
					echo "<td ><div class=quo_r_marg1>".$row['qu_s_id']."</div></td>" ;
				else
					echo "<td ><div class=quo_r_marg1>".$row['po_s_id']."</div></td>" ;
					echo "<td ><div class=quo_r_marg1>".$row['date']."</div></td>";
					echo "<td ><div class=quo_r_marg1>".$_SESSION["item_arr"][$row['item_id']][2]."</div></td>";
					//number_format() :幫數字加上千分位的工具，使用其他參數還可以加入小數點後面兩位
					echo "<td ><div class=quo_r_marg1>".$row['currency']."$ ".number_format($row['price'])."</div></td>";
					//儲存流水號以供下個頁面使用
				if($_SESSION["action_choose"]==2)
					$_SESSION["quo_info"][$row['quo_id']]=$row['qu_s_id'];
				else
					$_SESSION["quo_info"][$row['quo_id']]=$row['po_s_id'];
					if($_SESSION["action_choose"]==2)
						echo "<td ><button type=submit class=btm_detail_info name=btm_detail_quotation value=".$row['quo_id']." '>詳細報價單</button></td>" ;
					else
						echo "<td ><button type=submit class=btm_detail_info name=btm_detail_quotation value=".$row['quo_id']." '>詳細訂單</button></td>" ;
				echo "</tr>";
			$row_no++;
		}
		echo "</table>";
		echo "</div>";
	}
	else{
		echo "<div class='art_top'> 對不起，查無客戶帳務資料。</div>";
		//die(' ' . mysql_error()) ;		
	}
	echo "<div class='separation'><hr></div>";	
	for ( $i=0 ; $i<sizeof($_SESSION["location_country_arr"]) ; $i++ ) {
		if ($i ==0){
			echo   "<div id = div_country_btm>
				<button type=submit 
					name=".$_SESSION["Pre_Page_city_info"][0].
					" value=".$_SESSION["Pre_Page_city_info"][0]." >回到 ".$_SESSION["Pre_Page_city_info"][1]."</button></div>" ;
		}
		$name=$_SESSION["location_country_arr"][$i][0] ;
		$s_id=$_SESSION["location_country_arr"][$i][1] ;
		echo "<div id = div_country_btm><button type=submit name=btm_co".$s_id." id=btm_co".$s_id.">回到 ".$name."</button></div>" ;
	}

}*/

//顯示詳細的報價單內容
function echo_detail_quotation( $qu_id ) {
	
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	//連接資料庫
	connect2db() ;
	global $conn ;
	
	//抓出客戶所有的 0:報價單資料   1:訂單資料
	if($_REQUEST['Which_Main_choose']==2){
		$check_qorp=0;
		$content_qorp="報價單";
		$sql_qorp="qu_s_id";
	}
	else{
		$check_qorp=1;
		$content_qorp="訂單";
		$sql_qorp="po_s_id";
	}
	
	//抓取該客戶的所有報價單、客戶名稱、物品名稱
	$sql_cmd = "SELECT  QS.qu_s_id, QS.po_s_id, QS.date, 
                		QS.price AS total_price, QS.currency, 
                        QS.sales_tax, QS.is_order, 
                        QD.amount, QD.price AS item_price ,
                		C.name AS cname, C.customer_id ,
                        I.item_id, I.s_id AS item_s_id, I.name AS iname
					FROM client_info.quotation_detail_db AS QD
				LEFT JOIN client_info.quotation_simple_db AS QS
					ON QD.quo_id = QS.quo_id
				LEFT JOIN client_info.customer_db AS C
					ON QS.customer_id = C.customer_id
				LEFT JOIN client_info.item_db AS I
					ON QD.item_id = I.item_id
				WHERE QD.quo_id = ".$qu_id." AND QS.invalid = 0 
				ORDER BY QD.quo_item_id ASC  ";

	$result = mysql_query( $sql_cmd, $conn ) ;

	if(mysql_num_rows($result)>0){
		$order_state;
		for( $row_no=1; $row = mysql_fetch_array( $result) ; $row_no++ ) 
		{
			if($row_no==1){
				/*
				echo "<div class='art_top'> 客戶".$qu_id." <b>".$row['cname']."</b> 的".$content_qorp."：</div>";
				echo "<div class='div_List_top_header'>";
				echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>".$content_qorp."<br>流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>報價單<br>創建時間";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>重點<br>採買項目";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>總金額<br>";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_sgl_smpl_quo'>詳細<br>".$content_qorp;
						echo "</th>";
					echo "</tr>";*/
					echo "<div class='art_top'> ".$content_qorp." <b>".$row[$sql_qorp]."</b> 的詳細資訊：</div>";
					echo "<div class='div_List_left_header'>";
					echo "<table class='table_List_left_header'>";
					
					if($check_qorp==1){
						
						echo "<tr class='tr_List_left_header'>";
							echo "<th class='th_List_left_header'>訂單<br>流水編號";
							echo "</th>";
							echo "<td class='td_List_left_header'>".$row['po_s_id'];
							echo "</td>";
						echo "</tr>";
						
						echo "<tr class='tr_List_left_header'>";
							echo "<th class='th_List_left_header'>報價單<br>流水編號";
							echo "</th>";
							echo "<td class='td_List_left_header'>".$row['qu_s_id'];
							echo "</td>";
						echo "</tr>";
					}
					else{
						
						echo "<tr class='tr_List_left_header'>";
							echo "<th class='th_List_left_header'>報價單<br>流水編號";
							echo "</th>";
							echo "<td class='td_List_left_header'>".$row['qu_s_id'];
							echo "</td>";
						echo "</tr>";
						
						if($row['po_s_id']!=NULL){
							
							echo "<tr class='tr_List_left_header'>";
								echo "<th class='th_List_left_header'>訂單<br>流水編號";
								echo "</th>";
								echo "<td class='td_List_left_header'>".$row['po_s_id'];
								echo "</td>";
							echo "</tr>";
						}
					}			
					
					echo "<tr class='tr_List_left_header'>";
						echo "<th class='th_List_left_header td_List_city_customer'>客戶名稱";
						echo "</th>";
						echo "<td class='td_List_left_header td_List_Button'>";
						echo "<button type=submit class='btn_List btn_List_big' name=btn_detail_customer value=".$row['customer_id']." '>".$row['cname']."</button>" ;
						echo "</td>";
					echo "</tr>";
					
					echo "<tr class='tr_List_left_header'>";
						echo "<th class='th_List_left_header'>報價單<br>創建時間";
						echo "</th>";
						echo "<td class='td_List_left_header'>".$row['date'];
						echo "</td>";
					echo "</tr>";
					
					echo "<tr class='tr_List_left_header'>";
						echo "<th class='th_List_left_header'>是否為<br>已成交訂單";
						echo "</th>";
						echo "<td class='td_List_left_header'>";
							if($row['is_order']==1)
								echo "是<br>本單被設定為 <b>已成交訂單</b>";
							else if($row['is_order']==0 && $row['po_s_id']!=NULL)
								echo "否<br>本單被設定為 <b>一般報價單</b>，但有曾經被設定為已成交訂單的紀錄";
							else
								echo "否<br>本單被設定為 <b>一般報價單</b>";
						echo "</td>";
					echo "</tr>";
					$order_state=$row['is_order'];
					
					echo "<tr class='tr_List_left_header'>";
						echo "<th class='th_List_left_header'>營業稅";
						echo "</th>";
						echo "<td class='td_List_left_header'>";
							if($row['sales_tax']==1)
								echo "金額中 <b>已包含</b> 營業稅";
							else
								echo "金額中 <b>尚未包含</b> 營業稅";
						echo "</td>";
					echo "</tr>";
					
					echo "<tr class='tr_List_left_header'>";
						echo "<th class='th_List_left_header'>".$content_qorp."總金額";
						echo "</th>";
						echo "<td class='td_List_left_header'>".$row['currency']."$ ".number_format($row['total_price'],2);
						echo "</td>";
					echo "</tr>";
					
					echo "</table>";
					echo "</div>";	
					
					echo "<div ='separation'><hr class='set_List_border_color'></div>";
					
					echo "<div class='art_top'> 以下為 ".$content_qorp." <b>".$row[$sql_qorp]."</b> 的物品明細：</div>";
					echo "<div class='div_List_top_header'>";
					echo "<table class='table_List_top_header'>";
					echo "<tr class='tr_List_top_header'>";
						echo "<th class='th_List_top_header th_List_quo_item'>項次";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_quo_item'>物品<br>流水號";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_quo_item'>物品名稱";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_quo_item'>購買數量";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_quo_item'>販售金額";
						echo "</th>";
						echo "<th class='th_List_top_header th_List_quo_item'>供應商";
						echo "</th>";
					echo "</tr>";
			}
			
			echo "<tr class='tr_List_top_header'>";
				echo "<td class='td_List_top_header td_List_quo_item'>".$row_no;
				echo "</td>";
				echo "<td class='td_List_top_header td_List_quo_item'>".$row['item_s_id'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_quo_item'>".$row['iname'];
				echo "</td>";
				echo "<td class='td_List_top_header td_List_quo_item'>".number_format($row['amount']);
				echo "</td>";
				echo "<td class='td_List_top_header td_List_quo_item'>".$row['currency']."$ ".number_format($row['item_price']);
				echo "</td>";
				echo "<td class='td_List_top_header td_List_quo_item'>";
					echo "<button type=submit class='btn_List ' name=btn_detail_supplier value=".$row['item_id']." >供應商資料</button>" ;
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";		
		echo "<div ='separation'><hr class='set_List_border_color'></div>";
		
		if($_REQUEST['Which_Main_choose']==2){
			//待完成後再加入此功能
			/*
			echo "	<div class='quo_option set_float_right'>
					<button type=submit class = 'btn_submit' name=btm_edit_quo value=".$qu_id." >
						修改".$content_qorp."
					</button>
				</div>" ;	
			*/
		}
		
		if($order_state==1){
			echo "	<div class='quo_option set_float_right'>
						<button type=submit class = 'btn_submit' name=btm_order_change value=".$qu_id." >
							恢復為<br>一般報價單
						</button>
					</div>" ;

		}
		else{
			echo "	<div class='quo_option set_float_right'>
						<button type=submit class = 'btn_submit' name=btm_order_change value=".$qu_id." >
							設定為<br>已成交訂單
						</button>
					</div>" ;
		}
			
		echo "	<div class='quo_option set_float_right'>
					<button type=button 
						class = 'btn_submit'
						onclick=window.open('outputpdf.php?action_choose=".$_REQUEST['Which_Main_choose']."&qu_id=".$qu_id."') 
						name=btm_output_pdf >
							輸出<br>正式".$content_qorp."
					</button>
				</div>" ;			
	}
	else
	{
		echo "<div class='art_top'> 對不起，查無客戶帳務資料。</div>";
	}
}

//報價單切換成訂單，並給予訂單流水號，訂單可恢復成報價單
function order_change( $qu_id ) {
		
	//取得並記錄當前位置
	echo "<input type='hidden' name='Which_Main_choose' value='".$_REQUEST['Which_Main_choose']."' >";
	echo "<input type='hidden' name='Which_Sub_choose' value='".$_REQUEST['Which_Sub_choose']."' >";
	
	//echo "<div>訂單/報價單屬性切換，訂單編號:".$qu_id."</div>";
	
	connect2db() ;
	global $conn ;
	
	$sql_cmd = "SELECT * FROM client_info.quotation_simple_db WHERE quo_id = ".$qu_id ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$qs_info = mysql_fetch_array($temp) ;
	
	if($qs_info['po_s_id']==NULL){
		$target_y = $qs_info['date_y'];
		$target_m = $qs_info['date_m'];
		$po_s_id = make_qorp_s_id( 1 , $target_y , $target_m );
		//echo "是報價單，要做一個訂單流水碼出來:".$po_s_id;
		$date_po_no = make_qorp_s_id( 3 , $target_y , $target_m );
		//echo "<br>尾數編號:".$date_po_no;
		$sql_cmd = "UPDATE client_info.quotation_simple_db SET po_s_id='".$po_s_id."',is_order=1,date_po_no=".$date_po_no." WHERE quo_id = ".$qu_id;
		mysql_query( $sql_cmd, $conn ) ;
		echo "<script>";
		echo "    alert('已經成功轉換成[已成交訂單]!');";
		echo "</script>";
	}
	else if($qs_info['is_order']==0){
		$sql_cmd = "UPDATE client_info.quotation_simple_db SET is_order=1 WHERE quo_id = ".$qu_id;
		mysql_query( $sql_cmd, $conn ) ;
		echo "<script>";
		echo "    alert('已經成功轉換成[已成交訂單]!');";
		echo "</script>";
	}
	else{
		$sql_cmd = "UPDATE client_info.quotation_simple_db SET is_order=0 WHERE quo_id = ".$qu_id;
		mysql_query( $sql_cmd, $conn ) ;
		echo "<script>";
		echo "    alert('已經成功恢復成[一般報價單]!');";
		echo "</script>";
	}
}

/* 
流水號創建函數
$Target_Type = 0 意思是目標是生成報價單(qu_s_id)的流水號
$Target_Type = 1 意思是目標是生成訂單(po_s_id)的流水號
$Target_Type = 2 意思是目標是生成報價單的尾數編號(date_qu_no)
$Target_Type = 3 意思是目標是生成訂單的尾數編號(date_po_no)
*/
function make_qorp_s_id( $Target_Type , $Year , $Month ){
	
	connect2db() ;
	global $conn ;

	//echo "<br>type:".$Target_Type." ty:".$Year." tm:".$Month."<br>";
	
	if($Target_Type==0 || $Target_Type==2 ){
		$get_max_no="date_qu_no";
		$s_id_header="QU";
	}
	else{
		$get_max_no="date_po_no";
		$s_id_header="PO";
	}
	
	
	$sql_cmd = "SELECT MAX(QS.".$get_max_no.") FROM client_info.quotation_simple_db AS QS WHERE date_y = ".$Year." AND date_m = ".$Month ;
	
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$max = mysql_fetch_array($temp) ;
	
	if($Month<10)
		$Month="0".$Month;
	
	if($max[0]>0){
		//echo "有值<br>";
	
		//$max是陣列 $max[0]才是我們在乎的數值
		$max = $max[0];
		$output_no = $max+1;
	}
	else{
		//echo "無值<br>";
		$max = 0;
		$output_no = $max+1;		
	}
	if($Target_Type<2){
		if($output_no<10)
			$output_no="0000".$output_no;
		else if($output_no<100)
			$output_no="000".$output_no;
		else if($output_no<1000)
			$output_no="00".$output_no;
		else if($output_no<10000)
			$output_no="0".$output_no;
		else
			$output_no=$output_no;
		
		return $s_id_header.$Year.$Month."-".$output_no;
	}
	else 
		return $output_no;
	
	echo "max:".$max." max0:".$max[0]." output_no :".$output_no."<br>";
	
	
}

function edit_quotation( $qu_id ) {
	echo "<div>修改訂單，訂單編號:".$qu_id."</div>";
	echo   "<div id = div_country_btm>
				<button type=submit 
					name=btm_detail_quotation value=".$_SESSION["Pre_Page_quo_info"]." >回上一層</button></div>" ;
}

/*2.0 創建PDF*/
function create_quo_pdf( $action_choose , $qu_id ,$view_or_save) {
		
	connect2db() ;
	global $conn ;
	$sql_cmd = "SELECT * FROM client_info.company_db WHERE company_id = 0" ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$company_result = mysql_fetch_array($temp) ;
	
	$sql_cmd = "SELECT * FROM client_info.quotation_simple_db WHERE quo_id = ".$qu_id ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$qus_result = mysql_fetch_array($temp) ;
	
	$quo_date=date_create($qus_result['date']);
	$quo_date2=strtotime(date_format($quo_date,"d-m-Y")."+2 Weeks");
	
	$sql_cmd = "SELECT * FROM client_info.customer_db WHERE customer_id = ".$qus_result['customer_id'] ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$cust_result = mysql_fetch_array($temp) ;
	
	$sql_cmd = "SELECT * FROM client_info.item_db" ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$item_array=array();
	for( $i=1 ; $row = mysql_fetch_array($temp) ; $i++){
		$item_array[$i][0]=$row['item_id'];						//將資料庫中所有欄位分別放入[0-5]
        $item_array[$i][1]=$row['s_id'];
		$item_array[$i][2]=$row['name'];
		$item_array[$i][3]=$row['supplier_id'];
		$item_array[$i][4]=$row['price'];
		$item_array[$i][5]=$row['currency'];
    }
	
	$sql_cmd = "SELECT * FROM client_info.quotation_detail_db WHERE quo_id = ".$qu_id ;
	$temp = mysql_query( $sql_cmd, $conn ) ;
	$item_amount=0;
	$qud_item=array();
	$sum_price=0;
	for( $item_amount=1 ; $row = mysql_fetch_array($temp) ; $item_amount++){
		$qud_item[$item_amount][0]=$item_array[  $row['item_id']  ][1];						
        $qud_item[$item_amount][1]=$item_array[  $row['item_id']  ][2];
		$qud_item[$item_amount][2]=$row['amount'];
		$qud_item[$item_amount][3]=$row['price'];
		$qud_item[$item_amount][4]=$row['amount']*$row['price'];
		$sum_price+=$qud_item[$item_amount][4];
    }
	
	/*$i = 0 ;
	$table = Array() ;
	while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		if($i==$index) {
			$table = $row ;
			break ;
		}
		$i++ ;
	}*/
		
	require_once('tcpdf/config/tcpdf_config.php') ;
	require_once('tcpdf/tcpdf.php') ;
	
	class MYPDF extends TCPDF {
		
		var $TitleHeader;
		var $CompanyHeader;
		var $QuoTitleHeader;
		var $CustomerHeader;
		var $ItemHeader;
		
		public function setTitleHeader($TitleHeader) {
			$this->TitleHeader = $TitleHeader;
		}		
		public function setCompanyHeader($CompanyHeader) {
			$this->CompanyHeader = $CompanyHeader;
		}
		public function setQuoTitleHeader($QuoTitleHeader) {
			$this->QuoTitleHeader = $QuoTitleHeader;
		}
		public function setCustomerHeader($CustomerHeader) {
			$this->CustomerHeader = $CustomerHeader;
		}
		public function setItemHeader($ItemHeader) {
			$this->ItemHeader = $ItemHeader;
		}
		//Page header
		public function Header() {
			//公司名稱
			$this->SetFont('DroidSansFallback', 'B', 48);
			$this->writeHTMLCell(
				$w = 0, $h = 0, $x = '', $y = 8,
				$this->TitleHeader, $border = 0, $ln = 1, $fill = 0,
				$reseth = true, $align = '', $autopadding = true);
			//公司資料
			$this->SetFont('DroidSansFallback', 'L', 10);
			$this->writeHTMLCell(
				$w = 0, $h = 0, $x = '', $y = 10,
				$this->CompanyHeader, $border = 0, $ln = 1, $fill = 0,
				$reseth = true, $align = '', $autopadding = true);
			//報價單開始
			$this->SetFont('DroidSansFallback', 'L', 16);
			$this->writeHTMLCell(
				$w = 0, $h = 0, $x = '', $y = 30,
				$this->QuoTitleHeader, $border = 0, $ln = 1, $fill = 0,
				$reseth = true, $align = '', $autopadding = true);
			//客戶資料
			$this->SetFont('DroidSansFallback', 'L', 12);
			$this->writeHTMLCell(
				$w = 0, $h = 0, $x = '', $y = 37,
				$this->CustomerHeader, $border = 0, $ln = 1, $fill = 0,
				$reseth = true, $align = '', $autopadding = true);
			$this->SetFont('DroidSansFallback', 'L', 12);
			$this->writeHTMLCell(
				$w = 0, $h = 0, $x = '', $y = 101,
				$this->ItemHeader, $border = 0, $ln = 1, $fill = 0,
				$reseth = true, $align = '', $autopadding = true);
		}
		
		// Page footer
		
		public function Footer() {
			// Position at 15 mm from bottom

			/*
			if (count($this->pages) == 1){
				$this->SetY(-22);
				$this->SetFont('DroidSansFallback', 'L', 12);
				$this->writeHTMLCell(
					$w = 0, $h = 0, $x = '', $y = '',
					'<hr>確認訂購簽章：', $border = 0, $ln = 0, $fill = 0,$reseth = true, $align = '', $autopadding = true);
			}
			else if($this->isLastPage){
				$this->SetY(-22);
				$this->SetFont('DroidSansFallback', 'L', 12);
				$this->writeHTMLCell(
					$w = 0, $h = 0, $x = '', $y = '',
					'總金額:300 含稅', $border = 0, $ln = 0, $fill = 0,$reseth = true, $align = '', $autopadding = true);
				$this->SetFont('DroidSansFallback', 'L', 12);
				$this->writeHTMLCell(
					$w = 0, $h = 0, $x = '', $y = '',
					'<hr>', $border = 0, $ln = 0, $fill = 0,$reseth = true, $align = '', $autopadding = true);
			}
			else{
				$this->SetY(-17);
				$this->SetFont('DroidSansFallback', 'L', 12);
				$this->writeHTMLCell(
					$w = 0, $h = 0, $x = '', $y = '',
					'<hr>', $border = 0, $ln = 0, $fill = 0,$reseth = true, $align = '', $autopadding = true);
			}*/
			$this->SetY(-17);
				$this->SetFont('DroidSansFallback', 'L', 12);
				$this->writeHTMLCell(
					$w = 0, $h = 0, $x = '', $y = '',
					'<hr>', $border = 0, $ln = 0, $fill = 0,$reseth = true, $align = '', $autopadding = true);
			// Set font
			$this->SetFont('DroidSansFallback', 'I', 10);
			// Page number
			$this->Cell(0, 0, '頁次: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
		//找出最末一頁
		/*public function lastPage($resetmargins=false) {
			$this->setPage($this->getNumPages(), $resetmargins);
			$this->isLastPage = true;
		}*/
	}
	
	// create new PDF document 預設A4
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	//$pdf->SetCreator(PDF_CREATOR);
	//$pdf->SetAuthor('Eric Tsai');
	if($action_choose==2){
		$pdf->SetTitle($qus_result['qu_s_id']);
		$pdf->SetSubject('報價單');
		$quo_s_id=$qus_result['qu_s_id'];
	}		
	else{
		$pdf->SetTitle($qus_result['po_s_id']);
		$pdf->SetSubject('訂單');
		$quo_s_id=$qus_result['po_s_id'];
	}
		
	
	//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, 3.972*PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	//公司名稱
	$pdf->setTitleHeader('<div align="left">'.$company_result[name].'</div>');
	//公司資料
	$pdf->setCompanyHeader('<div align="right" ><table><tr><td>統一編號：'.$company_result['ubn'].'</td></tr><tr><td>聯絡人：'.$company_result['contact'].'</td></tr><tr><td>電話：'.$company_result['company_phone'].'　　傳真：'.$company_result['company_fax'].'</td></tr><tr><td>地址：'.$company_result['address'].'</td></tr></table><hr></div>');
	//報價單開始
	if($action_choose==2){
		$pdf->setQuoTitleHeader('<div align="center">報價單憑證<hr></div>');	}		
	else{
		$pdf->setQuoTitleHeader('<div align="center">訂單憑證<hr></div>');	}
	//客戶資料以及單號
	if($action_choose==2){
	$pdf->setCustomerHeader('<div align="left" ><table ><tr ><td width="65%">客戶編號：'.$cust_result['s_id'].'</td><td width="3%"></td><td width="32%">報價單號：'.$quo_s_id.'</td></tr><tr><td>客戶名稱：'.$cust_result['name'].'</td></tr><tr><td>統一編號：'.$cust_result['ubn'].'</td><td></td><td>報價日期：'.date_format($quo_date,"Y/m/d").'</td></tr><tr><td>聯絡人：'.$cust_result['contact'].'</td><td></td><td>有效日期：'.date("Y/m/d",$quo_date2).'</td></tr><tr><td>電話(聯絡人)：'.$cust_result['contact_phone'].'　　</td></tr><tr><td>電話(公　司)：'.$cust_result['company_phone'].'　　</td></tr><tr><td>傳真：'.$cust_result['company_fax'].'</td></tr><tr><td>地址：'.$cust_result['address'].'</td></tr></table></div>');}
	else{
	$pdf->setCustomerHeader('<div align="left" ><table ><tr ><td width="65%">客戶編號：'.$cust_result['s_id'].'</td><td width="3%"></td><td width="32%">訂單單號：'.$quo_s_id.'</td></tr><tr><td>客戶名稱：'.$cust_result['name'].'</td><td></td></tr><tr><td>統一編號：'.$cust_result['ubn'].'</td><td></td><td>創建日期：'.date_format($quo_date,"Y/m/d").'</td></tr><tr><td>聯絡人：'.$cust_result['contact'].'</td></tr><tr><td>電話(聯絡人)：'.$cust_result['contact_phone'].'　　</td></tr><tr><td>電話(公　司)：'.$cust_result['company_phone'].'　　</td></tr><tr><td>傳真：'.$cust_result['company_fax'].'</td></tr><tr><td>地址：'.$cust_result['address'].'</td></tr></table></div>');}
	//物品清單開始
	$pdf->setItemHeader('<table align="center" border="1" RULES="ROWS"><tr><td width="6%">項次</td><td width="7%">品號</td><td width="37%">品名●規格●描述</td><td width="10%">數量</td><td width="20%">單價</td><td width="20%">金額</td></tr></table>');
	$pdf->SetPrintHeader(true);
	
	
	// add a page
	$pdf->AddPage();
	//$pdf->Write(0, 'Quotation', '', 0, 'L', true, 0, false, false, 0);
	
	// 正式寫入內容-----------------------------------------------------------------
	// 以下開始設定標改體字型  
	// 第一次加入 ttf 字型到 tcpdf 的指令放在outputpdf.php裡面，使用DroidSansFallback字型
	$pdf->SetFont('DroidSansFallback', '', 10, true);
	//$pdf->SetY(30);
	//$output= "<hr>";
	$break_page_amount = $_POST['paper_break'];
	$total_amount=1;
	for($display_item=1;$display_item<$item_amount;$display_item++)
	{
		if( $display_item > $break_page_amount && ($display_item % $break_page_amount) == 1 ){
			$output= '<table border="0" RULES="ALL">《本頁以下空白》</table>';
			$pdf->writeHTML($output, true, false, false, false, '');
			$pdf->AddPage();
		}
		$output= '<table border="0" RULES="ALL"><tr><td align="left" width="6%">'.$display_item.'</td><td align="left" width="7%">'.$qud_item[$display_item][0].'</td><td align="left" width="37%">'.$qud_item[$display_item][1].'</td><td align="right" width="10%">'.number_format($qud_item[$display_item][2]).'</td><td align="right" width="20%">$'.number_format($qud_item[$display_item][3],2).'</td><td align="right" width="20%">$'.number_format($qud_item[$display_item][4],2) .'</td></tr></table>';
		//$output= "<table border='1' RULES='ALL'><tr><td width='5%'>".$display_item."</td><td>".$qud_item[$display_item][0]."</td><td>".$qud_item[$display_item][1]."</td><td>".$qud_item[$display_item][2]."</td><td>".$qud_item[$display_item][3]."</td><td>".$qud_item[$display_item][4] ."</td></tr></table>";
		//$output= '<table><tr><td width="10%"><br></td><td width="40%"><br></td><td width="10%"><br></td><td width="20%"><br></td><td width="20%"><br></td></tr><tr><td>'.$qud_item[$display_item][0].'</td><td>'.$qud_item[$display_item][1].'</td><td>'.$qud_item[$display_item][2].'</td><td>'.$qud_item[$display_item][3].'</td><td>'.$qud_item[$display_item][4] .'</tr></table>';
		//$tbl = $output ;	
		$pdf->writeHTML($output, true, false, false, false, '');
		$total_amount++;
	}
	if( $total_amount > $break_page_amount && ($total_amount % $break_page_amount) == 1 ){
		$output= '<table border="0" RULES="ALL"><tr><td>《項目列表結束》</td></tr></table>';
		$pdf->writeHTML($output, true, false, false, false, '');
		$pdf->AddPage();
	}
	else{
		$output= '<table border="0" RULES="ALL"><tr><td>《項目列表結束》</td></tr></table>';
		$pdf->writeHTML($output, true, false, false, false, '');
	}
		if(isset($_POST['sales_tax_number'])){
			$stn=($_POST['sales_tax_number']/100);
			$sum_stn=1+($_POST['sales_tax_number']/100);
		}
		else{
			$stn=(5/100);
			$sum_stn=1+(5/100);
		}
		
		if($qus_result['sales_tax']==0)
			$output= '<table border="2" rules="all" width="100%" cellpadding="5"><tr align="right" ><td width="35%">合　計 : '.$qus_result['currency'].' $'.number_format($sum_price,2).'</td><td width="30%">營業稅 : '.$qus_result['currency'].' $'.number_format($sum_price*$stn,2).'</td><td width="35%">總　計 : '.$qus_result['currency'].' $'.number_format($sum_price*$sum_stn,2).'</td></tr><tr><td colspan="2">備註：'.$_POST['other_memo'].'</td><td>訂購確認簽章：<br><br>(確認後回傳傳真：'.$company_result['company_fax'].')</td></tr></table>';
		else
			$output= '<table border="2" rules="all" width="100%" cellpadding="5"><tr align="right" ><td width="35%">合　計 : '.$qus_result['currency'].' $'.number_format($sum_price,2).'</td><td width="30%">營業稅 : 內　含</td><td width="35%">總　計 : '.$qus_result['currency'].' $'.number_format($sum_price,2).'</td></tr><tr><td colspan="2">備註：'.$_POST['other_memo'].'</td><td>訂購確認簽章：<br><br>(確認後回傳傳真：'.$company_result['company_fax'].')</td></tr></table>';
		$pdf->writeHTML($output, true, false, false, false, '');
	
	
	// -----------------------------------------------------------------------------

	$datename=date("Y_m_d-H_i_s");
	$downloadname=$quo_s_id."-".$datename.".pdf";
	// 輸出內容
	ob_end_clean();	//解決 error: Some data has already been output, can't send PDF file
	if($view_or_save==1)
		$pdf->Output('report.pdf', 'I');
	else
		$pdf->Output($downloadname, 'D');
	
}/*2.0 new_add*/


// ---------- ↑查詢報價單訂單區↑ ----------

?>