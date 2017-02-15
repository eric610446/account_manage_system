<html>

<head>
	<title>地點資料建立/修改/查詢</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(document).keypress(function(e) {
		if(e.which == 13) {
			return false ;
		}
	});
	</script>
</head>

<body class='settings-item'>

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
		$item_type_select_option = item_type_select_option() ;
		$where_am_i = "item" ;

//----------------------------------------------------------------------------------------------
//-                                         ACTION                                             -
//----------------------------------------------------------------------------------------------

		if(isset($_POST['create_mode']) or ($_GET["mode"]=="create") ) {
			$mode = "create" ;
			var_init();
			$readonly = "";
			$disabled="";
			$button2='<button type="submit" name="create_button" id="create_button">建立</button>';
		}
		if(isset($_POST['modify_mode']) or ($_GET["mode"]=="modify") ) {
			$mode = "modify" ;
			$button1='<button type="submit" name="find_button" >尋找</button>';
			var_init();
			$default_div_color = $default_sleep_input ;
			$readonly = "readonly";
			$disabled="disabled" ;
			$test=$test.' edit mode<br/>';
			$item_type_select_option = item_type_select_option("ro") ;
			$supplier_select_option = supplier_select_option($conn) ;
		}
		if(isset($_POST['find_mode']) or ($_GET["mode"]=="find") ) {
			$mode = "find" ;
			var_init();
			$test=$test.' find mode<br/>';
			$only_get_info=1;
		}
		if( isset($_POST['invalid_mode']) or ($_GET["mode"]=="invalid") ) {
			$invalid_mode = 1 ;
		}





		//開始尋找
		if(isset($_POST['find_button'])) {
			$mode = "modify" ;

			$test=$test.' find button<br/>';
			item_get_html_input();
			$button1="<button type='submit' name='find_button' >尋找</button>" ;

			//防止地點名稱沒輸入
			if ($item_name == '') {
				var_init();
				$default_div_color = $default_sleep_input ;
				$readonly = "readonly";
				$disabled="disabled" ;
				echo "
				<script>
					alert('錯誤！　請輸入 [物品名稱] 後，再按下 [尋找] 。') ;
				</script>
				" ;
				$item_type_select_option = item_type_select_option("ro") ;
				$supplier_select_option = supplier_select_option($conn) ;
			}
			//地點名稱有輸入
			else {
				$find_name = create_name_option( "item", $conn, $item_name ) ;
				if( $find_name == "" ) {
					$sql_cmd = "select * from client_info.item_db where name='".$item_name."' and invalid='0'" ;

					//查詢的客戶有存在在資料庫中
					$result = $conn->query($sql_cmd) ;
					if ( $result->num_rows > 0 ) {
						$name_readonly = "readonly" ;
						// fetch result as an associate array
						while( $row = $result->fetch_assoc() ) {
							$item_id          = $row['item_id'] ;
							$item_s_id        = $row['s_id'] ;
							$item_name        = $row['name'] ;
							$item_name_backup = $row['name'] ;
							$item_supplier_id = $row['supplier_id'] ;
							$item_price       = $row['price'] ;
							$item_currency    = $row['currency'] ;
	    				}
	    				$supplier_select_option = supplier_select_option( $conn, $item_supplier_id ) ;

	    				// 建立 item 類型下拉式選單
	    				$item_type_select_option = item_type_select_option( $item_s_id ) ;
						$readonly = "" ;
						$disabled = "" ;
	    				$button2 = "<button type='submit' name='modify_button'>修改</button>" ;
	    				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
					}
				}
				else {
					$default_div_color = $default_sleep_input ;
					$readonly = "readonly";
					$disabled="disabled" ;
					$button1 = "<button type='submit' name='find_button'>尋找</button>" ;
					echo "
					<script>
						alert('錯誤！　物品　".$item_name."　的資料尚未建立') ;
					</script>
					" ;
					var_init() ;
					$button2="" ;
					$button3="" ;
				}
			}
		}


		//開始修改
		if(isset($_POST['modify_button'])) {
			$mode = "modify" ;
			item_get_html_input();
			$test=$test.' modify button<br/>';
			// 確認至少 name 不可以是空的
			if( $item_name != "" and $item_price >=0 ) {
				$go=1 ;
				//檢查 Database 有沒有重複建立的資料
				$sql_cmd = "select * from client_info.item_db where name='".$item_name."' and invalid='0'" ;
				$result = $conn->query($sql_cmd) ;
				if( $item_name != $item_name_backup ) {
					if($result->num_rows > 0) {
						$button2 = "<button type='submit' name='modify_button'>修改</button>" ;
						echo "
						<script>
							alert('錯誤！　物品　".$item_name."　不可重複建立！') ;
						</script>
						" ;
						$item_name = $item_name_backup ;
						$go=0 ;
					}
				}
				if($go) {
					// 建立流水號
					if( $item_type_id != $item_type_id_backup ) {
						$item_s_id = item_sid_create($conn, $item_type_id) ;
					}

					$sql_cmd = "update client_info.item_db set
						s_id        = '".$item_s_id."',
						name        ='".$item_name."',
						supplier_id ='".$item_supplier_id."',
						price       ='".$item_price."',
						currency    ='".$item_currency."'
					where item_id='".$item_id."'
					";

					$result = $conn->query($sql_cmd) ;
					if( $result > 0 ) {
						echo "
						<script>
							alert('成功修改物品　".$item_name."　的資料') ;
						</script>
						" ;
						var_init() ;
						$default_div_color = $default_sleep_input ;
						$readonly = "readonly" ;
						$disabled="disabled" ;
						$button1 = "<button type='submit' name='find_button'>尋找</button>" ;
						$button3 = "" ;
						$supplier_select_option = supplier_select_option( $conn ) ;
						$item_type_select_option = item_type_select_option( "ro" ) ;
					}
					else {
						echo "
						<script>
							alert('錯誤！　修改物品　".$item_name."　的資料錯誤！錯誤訊息：".$conn->error."') ;
						</script>
						" ;
						$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
						$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
					}
				}
			}
			else {
				echo "
				<script>
					alert('錯誤！　修改 ".$item_name."　的資料發生錯誤！ 錯誤訊息：請留意是否為空值，價格不可為負數') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			$button1 = "<button type='submit' name='find_button'>尋找</button>" ;

		}


		//開始建立
		if(isset($_POST['create_button'])) {
			$mode = "create" ;
			$test=$test.' create button<br/>';
			item_get_html_input();

			if ($item_name != "" and $item_price >=0 ) {

				//檢查 Database 有沒有重複建立的資料
				$sql_cmd = "select * from client_info.item_db where name='".$item_name."' and invalid='0'" ;
				$result = $conn->query($sql_cmd) ;
				if ($result->num_rows > 0) {
					$button2 = "<button type='submit' name='create_button'>建立</button>" ;
					echo "
					<script>
						alert('錯誤！　物品　".$item_name."　不可重複建立！') ;
					</script>
					" ;
				}
				else {
					$item_s_id = item_sid_create($conn, $item_type_id) ;
					// 建立新的 item 欄位
					$sql_cmd = "insert into client_info.item_db (
						s_id,
						name,
						supplier_id,
						price,
						currency
					) values (
						'".$item_s_id."',
						'".$item_name."',
						'".$item_supplier_id."',
						'".$item_price."',
						'".$item_currency."'
					)
					";

					if ($conn->query($sql_cmd) === TRUE) {
						echo "
						<script>
							alert('成功建立物品　".$item_name."。') ;
						</script>
						" ;
					}
					else {
						echo "
						<script>
							alert('錯誤！　建立物品　".$item_name."　的資料錯誤！錯誤訊息：".$conn->error."') ;
						</script>
						" ;
					}
					$button2 = "<button type='submit' name='create_button' id='create_button'>建立</button>" ;
				}

			}
			else {
				$button2 = "<button type='submit' name='create_button' id='create_button'>建立</button>" ;
				echo "
				<script>
					alert('錯誤！　請留意是否為空值，價格不可為負數！') ;
				</script>
				" ;
			}
			var_init() ;
		}


		// 按下作廢按鈕
		if( isset($_POST["invalid_button"]) ) {
			item_get_html_input();
			$test=$test.' invalid_button<br/>';
			$h1_mod_color="color:#5b88f6;";


			$sql_cmd = "update client_info.item_db set
				invalid='1'
			where item_id='".$item_id."'
			";
			$result = $conn->query($sql_cmd) ;
			if( $result > 0 ) {
				echo "
				<script>
					alert('成功 作廢 物品　".$supplier_name."　的資料。') ;
				</script>
				" ;

				var_init() ;
				$default_div_color = $default_sleep_input ;
				$disabled="disabled" ;
				$button2 = "" ;
				$button3 = "" ;
				$readonly = "readonly" ;
				$supplier_find_button='<button type="submit" name="find_button" >尋找</button>';
				$supplier_select_option = supplier_select_option( $conn ) ;
				$item_type_select_option = item_type_select_option( "ro" ) ;
			}
			else {
				echo "
				<script>
					alert('錯誤！　作廢物品 ".$item_name."　的資料發生錯誤！ 錯誤訊息：".$conn->error."') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;

			$button1='<button type="submit" name="find_button" class="com_info">尋找</button>';

		}

		// 在垃圾桶中，還原項目
		if($_POST["invalid_btn"]) {
			// 取得 id
			$id = $_POST["invalid_btn"] ;
			// 繼續庭僚在垃圾桶畫面
			$invalid_mode = 1 ;
			// 取得 id 與 name
			$id_arr = explode("-", $id[0]) ;
			// 檢查是不是已經有重複的 name
			$sql_cmd = "select name from client_info.item_db where name='".$id_arr[1]."' and invalid='0'" ;
			$result = $conn->query($sql_cmd) ;
			if ($result->num_rows > 0) {
				echo "
				<script>
					alert('錯誤！　".$id_arr[1]."有重複的資料存在，不可還原。') ;
				</script>
				" ;
			}
			else {
				// 設定該項目的 invalid 為 0
				$sql_cmd = "update client_info.item_db set invalid = 0 where item_id ='".$id_arr[0]."'";
				$result = $conn->query($sql_cmd) ;
			}
		}

		// 在垃圾桶中，刪除項目
		if($_POST["del_btn"]) {
			// 取得 id
			$id = $_POST["del_btn"] ;
			// 繼續庭僚在垃圾桶畫面
			$invalid_mode = 1 ;
			// 取得 id 與 name
			$id_arr = explode("-", $id[0]) ;

			// 設定該項目的 invalid 為 0
			$sql_cmd = "update client_info.item_db set invalid = 2 where item_id ='".$id_arr[0]."'";
			$result = $conn->query($sql_cmd) ;
		}

?>
<?php
//----------------------------------------------------------------------------------------------
//-                                        Context                                             -
//----------------------------------------------------------------------------------------------
?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<header>
			<?php echo $header_context; ?>
		</header>

		<nav>
			<ul>
				<div id='client' onclick="location.href='client.php?mode=modify'"><a href='client.php?mode=modify' id='client'>客戶<br/>資料</a></div>
				<div id='supplier' onclick="location.href='supplier.php?mode=modify'"><a href='supplier.php?mode=modify' id='supplier'>供應商<br/>資料</a></div>
				<div id='item' onclick="location.href='item.php?mode=modify'"><a href='item.php?mode=modify' id='item'>物品<br/>清單</a></div>
				<div id='location' onclick="location.href='location.php?mode=modify'"><a href='location.php?mode=modify' id='location'>地點<br/>資料</a></div>
			</ul>
		</nav>

		<div id='mode'>
			<ul>
				<li id='create'><button type=submit name='create_mode' id='create'>建立</button></li>
				<li id='modify'><button type=submit name='modify_mode' id='modify'>修改</button></li>
				<li id='find'><button type=submit name='find_mode' id='find'>查詢</button></li>
				<br/><br/>
				<li id='invalid'><button type=submit name='invalid_mode' id='invalid'><img src="trash can.png" style="width:80%;"></button></li>
			</ul>
		</div>
		<div id="right"><? echo $find_name ; ?></div>
		<content>
			<ul>
			<?php
				if( $invalid_mode == 1 ) {
					echo invalid_display( $conn, "item" ) ;
				}
				elseif( $only_get_info != 1 ) {
					echo "
					<input type='hidden' name='item_id' value='$item_id'>
					<input type='hidden' name='item_name_backup' value='$item_name_backup'>
					<input type='hidden' name='item_type_id_backup' value='$item_type_id_backup'>
					<li id='list1'>
						<div id='sid'>
							<label for='sid'>流水號</label>
							<input type=text id='sid' name='item_s_id' value='$item_s_id' readonly>
							<span>流水號為系統自動產生</span>
						</div>
						<div id='name'>
							<label for='name'>物品名稱</label>
							<input type=text id='name' name='item_name' value='$item_name' maxlength='100' $name_readonly>
							<span>請輸入完整名稱</span>
						</div>
					</li>
					<li id='list2'>
						<div id='type'>
							<label for='type'>物品類型</label>".
								$item_type_select_option
							."<span>請設定此物品的類型</span>
						</div>
						<div id='supplier'>
							<label for='supplier'>物品供應商</label>".
								$supplier_select_option
							."<span>選擇此物品的供應商</span>
						</div>
					</li>
					<li id='list3'>
						<div id='price'>
							<label for='price'>建議售價</label>
							<input type='number' id='price' name='item_price' max=2000000000 value='$item_price' $readonly>
							<span>請輸入台幣售價</span>
						</div>
						<div id='currency'>
							<label for='currency'>幣值</label>
							<input type=text id='currency' name='item_currency' value='TWD' readonly>
							<span></span>
						</div>

						<div id='empty'><label></label><input><input><input></div>
						<div id='empty'><label></label><input><input><input></div>
						<div id='empty'><label></label><input><input><input></div>
					</li>
					<li id='list4'>
						<div id='modify'>".$button1."</div>
						<div id='create'>".$button2."</div>
						<div id='invalid'>".$button3."</div>
					</li>

					" ;
				}
				else {
					echo find_all($conn, "item") ;
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
