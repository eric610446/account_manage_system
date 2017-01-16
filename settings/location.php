<html>

<head>
	<title>地點資料建立/修改/查詢</title>
</head>

<body class='settings-location'>

<?

//----------------------------------------------------------------------------------------------
//-                                       INITIALIZE                                           -
//----------------------------------------------------------------------------------------------
		require("function.php") ;
		require("var.php") ;
		include("initialize.php") ;
		include("style.php") ;
		include("../config.php") ;
		$supplier_select_option = supplier_select_option($conn) ;
		$where_am_i = "location" ;



//----------------------------------------------------------------------------------------------
//-                                         ACTION                                             -
//----------------------------------------------------------------------------------------------

		//設定建立模式與修改模式的按鈕顏色
		if(isset($_POST['create_mode']) or ($_GET["mode"]=="create") ) {
			$mode = "create" ;
			var_init();
			$readonly='';
			$final_status='';
			$test=$test.' create mode<br/>';
			$button2='<button type="submit" name="create_button" >建立</button>';			
		}
		if(isset($_POST['modify_mode']) or ($_GET["mode"]=="modify") ) {
			$mode = "modify" ;
			$button1='<button type="submit" name="find_button" >尋找</button>';
			var_init();
			$readonly='readonly' ;
			$default_div_color = $default_sleep_input ;
			$test=$test.' edit mode<br/>';
		}
		if(isset($_POST['find_mode']) or ($_GET["mode"]=="find") ) {
			$mode = "find" ;
			var_init();
			$test=$test.' find mode<br/>';
			$only_get_info=1;
		}

		
		if(isset($_POST['find_button'])) {
			$mode = "modify" ;

			$test=$test.' find button<br/>';
			location_get_html_input();
			$button1='<button type="submit" name="find_button" >尋找</button>' ;			
			
			//防止地點名稱沒輸入
			if ($location_country_sid == '' or $location_city_sid == '' ) {
				$final_status .= "請輸入要查詢的地點名稱";
				var_init();
				$readonly='readonly';				
				$default_div_color = $default_sleep_input ;
				echo "			
				<script>
					alert('錯誤！　請輸入要查詢的地點 sid 再尋找') ;
				</script>
				" ;
			}
			//地點名稱有輸入
			else {
				$sql_cmd = "select * from client_info.location_db where city_sid='".$location_city_sid."' and country_sid='".$location_country_sid."' and invalid = '0'" ;
				//echo $sql_cmd ;
				//查詢的地點有存在在資料庫中
				$result = $conn->query($sql_cmd) ;
				if ( $result->num_rows > 0 ) {
					// fetch result as an associate array
					while( $row = $result->fetch_assoc() ) {
						$location_id = $row['location_id'] ;
						$location_country = $row['country'] ;
						$location_country_sid = $row['country_sid'] ;
						$location_city = $row['city'] ;
						$location_city_sid = $row['city_sid'] ;
    				}		

					$readonly='';
    				$button2='<button type="submit" name="modify_button" >修改</button>';
    				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
    				$final_status .= "查詢成功!";
				}
				else {
					$final_status .= $location_country_sid.$location_city_sid." 的地點資料尚未被建立 ...";
					var_init();
					$readonly='readonly';
					$default_div_color = $default_sleep_input ;
					$button1 = '<button type="submit" name="find_button" >尋找</button>' ;	
					echo "			
					<script>
						alert('錯誤！ ".$location_country_sid.$location_city_sid." 的地點資料尚未被建立 ...".$conn->error."') ;
					</script>
					" ;
				}
			}
		}


		//修改
		if(isset($_POST['modify_button'])) {
			$mode = "modify" ;
			location_get_html_input();
			$test=$test.' modify button<br/>';

			// 確認至少 sid 不可以是空的
			if( $location_city_sid != "" and $location_country_sid != "" ) {
				$sql_cmd = "update client_info.location_db set 
					country='".$location_country."',
					country_sid='".$location_country_sid."',
					city='".$location_city."',
					city_sid='".$location_city_sid."'
				where location_id='".$location_id."'
				";
				$result = $conn->query($sql_cmd) ;
				if( $result > 0 ) {
					$final_status = $final_status.' <br/>成功修改地點資料 ...<br/>';
					echo "			
					<script>
						alert('成功修改地點　".$item_name."　的資料') ;
					</script>
					" ;
					$button2 = "" ;
					$button3 = "" ;
					$readonly='readonly';
					var_init() ;
					$default_div_color = $default_sleep_input ;
				} 
				else {			
					$final_status = $final_status.' <br/>修改地點資料失敗，錯誤訊息:'.$conn->error.'<br/>';
					echo "			
					<script>
						alert('錯誤！　修改地點資料錯誤！錯誤訊息：".$conn->error."') ;
					</script>
					" ;
					$button2 = '<button type="submit" name="modify_button" >修改</button>';
					$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
				}
			}
			else {
				$final_status = $final_status.' <br/>修改客戶資料失敗，錯誤訊息:'.$conn->error.'<br/>';
					echo "			
					<script>
						alert('錯誤！　修改資料發生錯誤！ 錯誤訊息：國際代碼不可以是空值') ;
					</script>
					" ;
					$button2 = '<button type="submit" name="modify_button" >修改</button>';
					$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}
			


			$button1='<button type="submit" name="find_button">尋找</button>' ;	

		}


		//建立
		if(isset($_POST['create_button'])) {
			$mode = "create" ;
			$test=$test.' create button<br/>';
			location_get_html_input();				
			
			if ($location_country != "" and $location_country_sid != "" and $location_city != "" and $location_city_sid != "" ) {	
				
				//檢查 Database 有沒有重複建立的 location
				$sql_cmd = "select * from client_info.location_db where city_sid='".$location_city_sid."' and country_sid='".$location_country_sid."' and invalid = '0'" ;
				$result = $conn->query($sql_cmd) ;
				if ($result->num_rows > 0) {
					$final_status = $final_status.'<br/>建立地點資料失敗！<br/>原因： '.$location_country." ".$location_city." [".$location_country_sid.$location_city_sid.'] 不可重複建立！<br/>';
					echo "			
						<script>
							alert('錯誤！　同一地點  ".$location_country_sid.$location_city_sid."  不可重複建立！錯誤訊息：".$conn->error."') ;
						</script>
					" ;
					var_init() ;
				}
				else {

					// 建立新的 地點欄位					
					$sql_cmd = "insert into client_info.location_db (
						country,
						country_sid,
						city,
						city_sid
					) values (
						'".$location_country."',
						'".$location_country_sid."',
						'".$location_city."',
						'".$location_city_sid."'
					)
					";
					/*
					$sql_cmd = "insert into client_info.location_db ( name ) valuse"
					*/
			
					if ($conn->query($sql_cmd) === TRUE) {
						$final_status = $final_status.' <br/>成功新增地點 ...<br/>';
						echo "			
						<script>
							alert('成功建立地點資料') ;
						</script>
						" ;						
						var_init() ;
					} 
					else {
						$final_status = $final_status.' <br/>新增地點失敗，錯誤訊息:'.$conn->error.'<br/>';
						echo "			
						<script>
							alert('錯誤！　建立地點資料錯誤！錯誤訊息：".$conn->error."') ;
						</script>
						" ;
					}
				}
				
			}
			else {
				$final_status .= "<br/>填寫完所有表格再建立<br/>" ;
				echo "			
				<script>
					alert('錯誤！　請填寫完所有表格再建立') ;
				</script>
				" ;
			}
			$button2='<button type="submit" name="create_button" >建立</button>';
		}	


		// 按下作廢按鈕
		if( isset($_POST["invalid_button"]) ) {
			location_get_html_input();
			$test=$test.' invalid_button<br/>';
			$h1_mod_color="color:#5b88f6;";
			

			$sql_cmd = "update client_info.location_db set 
				invalid='1'
			where location_id='".$location_id."'
			";
			$result = $conn->query($sql_cmd) ;
			if( $result > 0 ) {
				$final_status = $final_status.' <br/>成功 作廢 資料 ...<br/>';
				echo "			
				<script>
					alert('成功 作廢 地點　".$supplier_name."　的資料。') ;
				</script>
				" ;

				var_init() ;
				$input_color = "#f0f0f0" ;
				$disabled="disabled" ;				
				$button2 = "" ;
				$button3 = "" ;				
				$readonly="readonly" ;
				$default_div_color = $default_sleep_input ;
			} 
			else {			
				$final_status = $final_status.' <br/>失敗！ 作廢地點資料失敗，錯誤訊息:'.$conn->error.'<br/>';
				echo "			
				<script>
					alert('錯誤！　作廢地點 ".$item_name."　的資料發生錯誤！ 錯誤訊息：".$conn->error."') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $location_location) ;

			$button1='<button type="submit" name="find_button" class="com_info">尋找</button>';

		}
?>
<?
//----------------------------------------------------------------------------------------------
//-                                        Context                                             -
//----------------------------------------------------------------------------------------------
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<header>
			<?php echo $header_context; ?>
			<!--<h1>SIX MONSTER ACCOUNT MANAGEMENT SYSTEM</h1>
			<h2><font face="Droid Serif"><<地點>></font></h2>-->
		</header>
		
		<nav>
			<ul>
				<div id='client'><a href='client.php?mode=modify' id='client'>客戶資料</a></div>
				<div id='supplier'><a href='supplier.php?mode=modify' id='supplier'>供應商</a></div>
				<div id='item'><a href='item.php?mode=modify' id='item'>物品清單</a></div>
				<div id='location'><a href='location.php?mode=modify' id='location'>地點</a></div>
			</ul>
		</nav>

		<div id='mode'>	
			<ul>
				<li id='create'><button type=submit name='create_mode' id='create'>建立</button></li>
				<li id='modify'><button type=submit name='modify_mode' id='modify'>修改</button></li>
				<li id='find'><button type=submit name='find_mode' id='find'>查詢</button></li>
			</ul>
		</div>
		<div id="right"></div>
		<content>
			<ul>
			<?php

				if( $only_get_info != 1 ) {
					echo "	
					<input type='hidden' name='location_id' value='$location_id'>	
					<li id='list1'>
						<div id='location_country'>
							<label for='location_country'>國家</label>
							<input type=text id='location_country' name='location_country' value='$location_country' $readonly>
							<span>輸入地點國家名稱 ex: 臺灣</span>
						</div>	
						<div id='location_country_sid'>
							<label id='location_country_sid' for='location_country_sid'>國家 國際代碼</label>
							<input type=text id='location_country_sid' name='location_country_sid' value='$location_country_sid' maxlength='2'>
							<span>國際代碼可點選 <a href='http://www.unece.org/cefact/locode/service/location' target='_blank'>連結</a> 查詢</span>
						</div>
					</li>
					<li id='list2'>
						<div id='location_city'>
							<label for='location_city'>城市名稱</label>
							<input type=text id='location_city' name=location_city value='$location_city' $readonly>
							<span>輸入城市名稱 ex: 臺北</span>
						</div>						
						<div id='location_city_sid'>
							<label id='location_city_sid' for='location_city_sid'>城市 國際代碼</label>
							<input type=text id='location_city_sid' name=location_city_sid value='$location_city_sid' maxlength='3'>
							<span>國際代碼可點選 <a href='http://www.unece.org/cefact/locode/service/location' target='_blank'>連結</a> 查詢</span>
						</div>	
					</li>
					<li id='list3'>
						<div id='modify'>".$button1."</div>
						<div id='create'>".$button2."</div>
						<!--<div id='invalid'>".$button3."</div>-->
						<div id='others'></div>
					</li>
					" ;
				}
				else {
					echo find_all($conn, "location") ;
				}


			?>
			</ul>
		</content>

		<footer><?php echo $footer_context; ?></footer>

	</form>

</body>
</html>
  


<?php
//----------------------------------------------------------------------------------------------
//-                                         Style                                              -
//----------------------------------------------------------------------------------------------
include("style.php") ;

?>
