<html>

<head>
	<title>產品資料建立/修改/查詢</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script language="JavaScript" type="text/javascript">
	$(document).keypress(function(e) {
		if(e.which == 13) {
			return false ;
		}
	});
	</script>
</head>


<body class='settings'>
<?
//----------------------------------------------------------------------------------------------
//-									   INITIALIZE						     				   -
//----------------------------------------------------------------------------------------------
		require("function.php") ;
		require("var.php") ;
		include("initialize.php") ;
		include("style.php") ;
		include("../config.php") ;
		$client_select_option = location_select_option($conn) ;
		$where_am_i = "client" ;


//----------------------------------------------------------------------------------------------
//-										 ACTION									        	   -
//----------------------------------------------------------------------------------------------

		//設定建立模式與修改模式的按鈕顏色
		if(isset($_POST['create_mode']) or ($_GET["mode"]=="create") ) {
			$mode = "create" ;
			var_init();
			$default_div_color = $default_active_input ;
			$test=$test.' create mode<br/>' ;
			$button2='<button type="submit" name="create_button" class="com_info" id="btn_button2">建立</button>';
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn) ;
		}
		if(isset($_POST['modify_mode']) or ($_GET["mode"]=="modify") ) {
			$mode = "modify" ;
			$button1='<button type="submit" name="find_button" class="com_info" id="find_button">尋找</button>';
			var_init();
			$default_div_color = $default_sleep_input ;
			$readonly = "readonly" ;
			$disabled="disabled" ;
			$test=$test.' edit mode<br/>';
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn) ;
		}
		if(isset($_POST['find_mode']) or ($_GET["mode"]=="find") ) {
			$mode = "find" ;
			$button1='<button type="submit" name="find_button" class="com_info" id="find_button">尋找</button>';
			var_init();
			$test=$test.' find mode<br/>';
			$only_get_info=1;
		}
		if( isset($_POST['invalid_mode']) or ($_GET["mode"]=="invalid") ) {
			$invalid_mode = 1 ;
		}

		//查詢
		if(isset($_POST['find_button'])) {
			$mode = "modify" ;

			$test=$test.' find button<br/>';
			client_get_html_input();

			//防止客戶名稱沒輸入
			if ($client_name == '') {
				$find_status = "請輸入要查詢的產品名稱";
				var_init();
				$default_div_color = $default_sleep_input ;
				$disabled="disabled" ;
				echo "
				<script>
					alert('錯誤！　請填寫 [客戶名稱] 後，再按下 [尋找] 。') ;
				</script>
				" ;
			}
			//產品名稱有輸入
			else {
				$find_name = create_name_option( "customer", $conn, $client_name ) ;
				if( $find_name == "" ) {
					$sql_cmd = 'select * from client_info.customer_db where name="'.$client_name.'" and invalid="0"' ;
					//查詢的客戶有存在在資料庫中
					$result = $conn->query($sql_cmd) ;
					if ( $result->num_rows > 0 ) {
						$name_readonly = "readonly" ;
						// fetch result as an associate array
						while( $row = $result->fetch_assoc() ) {
							$client_customer_id     = $row['customer_id'] ;
							$client_s_id            = $row['s_id'] ;
							$client_name            = $row['name'] ;
							$client_name_backup     = $row['name'] ;
							$client_nickname        = $row['nickname'] ;
							$client_ubn             = $row['ubn'] ;
							$client_company_phone   = $row['company_phone'] ;
							$client_company_fax     = $row['company_fax'] ;
							$client_email           = $row['email'] ;
							$client_location        = $row['location'] ;
							$client_location_backup = $row['location'] ;
							$client_address         = $row['address'] ;
							$client_contact         = $row['contact'] ;
							$client_contact_phone   = $row['contact_phone'] ;
						}
						$default_div_color = $default_active_input ;
						$find_status= "查詢成功!";
						$button2='<button type="submit" name="modify_button" class="com_info" id="btn_button2">修改</button>';
						$button3="<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
					}

				}
				//查詢的客戶不存在在資料庫中
				else {
					$find_status="$client_name 的資料尚未被建立 ...";
					$default_div_color = $default_sleep_input ;
					$disabled="disabled" ;
					echo "
					<script>
						alert('錯誤！　客戶　".$client_name."　的資料尚未建立！') ;
					</script>
					" ;
					var_init() ;
					$button2="" ;
					$button3="" ;
				}
			}
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;

			$button1='<button type="submit" name="find_button" class="com_info" id="find_button">尋找</button>';
		}



		//修改
		if(isset($_POST['modify_button'])) {
			$mode = "modify" ;
			client_get_html_input();
			$test=$test.' modify button<br/>';

			// 確認至少 name 不可以是空的
			if( $client_name != "" and is_numeric($client_ubn) ) {
				$go=1 ;
				//檢查 Database 有沒有重複建立的 client
				$sql_cmd = "select name from client_info.customer_db where name='".$client_name."' and invalid='0'" ;
				$result = $conn->query($sql_cmd) ;
				if($client_name != $client_name_backup) {
					if ($result->num_rows > 0) {
						echo "
						<script>
							alert('錯誤！　".$client_name."不可重複建立！') ;
						</script>
						" ;
						$client_name = $client_name_backup ;
						$go=0 ;
					}
				}
				if($go) {
					// 建立流水號
					if( $client_location != $client_location_backup ) {
						$client_s_id = sid_create($conn, "customer") ;
					}

					$sql_cmd = "update client_info.customer_db set
						s_id                   ='".$client_s_id."',
						name                   ='".$client_name."',
						nickname               ='".$client_nickname."',
						ubn                    ='".$client_ubn."',
						company_phone          ='".$client_company_phone."',
						company_fax            ='".$client_company_fax."',
						email                  ='".$client_email."',
						location               ='".$client_location."',
						address                ='".$client_address."',
						contact                ='".$client_contact."',
						contact_phone          ='".$client_contact_phone."'
					where customer_id ='".$client_customer_id."'
					";
					$result = $conn->query($sql_cmd) ;
					if( $result > 0 ) {
						echo "
						<script>
							alert('成功修改客戶　".$client_name."　的資料。') ;
						</script>
						" ;

						var_init() ;
						$default_div_color = $default_sleep_input ;
						$disabled="disabled" ;
						$button2 = "" ;
						$button3 = "" ;
					}
					else {
						echo "
						<script>
							alert('錯誤！　修改客戶".$client_name."　的資料發生錯誤！ 錯誤訊息：".$conn->error."') ;
						</script>
						" ;
						$button2 = '<button type="submit" name="modify_button" class="com_info" id="btn_button2">修改</button>';
						$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
					}
				}
			}
			else {
				echo "
				<script>
					alert('錯誤！　修改客戶".$client_name."　的資料發生錯誤！ 錯誤訊息：請留意輸入資料是否正確，名稱不可是空值，統編只能有數字') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info" id="btn_button2">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;

			$button1='<button type="submit" name="find_button" class="com_info" id="find_button">尋找</button>';
		}


		//建立
		if(isset($_POST['create_button'])) {
			$mode = "create" ;
			$test=$test.' create button<br/>';
			client_get_html_input();


			if ($client_name != "" and is_numeric($client_ubn) ) {

				//檢查 Database 有沒有重複建立的 client
				$sql_cmd = "select name from client_info.customer_db where name='".$client_name."' and invalid='0'" ;
				$result = $conn->query($sql_cmd) ;
				if ($result->num_rows > 0) {
					echo "
					<script>
						alert('錯誤！　".$client_name."不可重複建立！') ;
					</script>
					" ;
				}
				else {
					// 建立流水號
					$client_s_id = sid_create($conn, "customer") ;

					// 建立新的 客戶欄位
					$sql_cmd = "insert into client_info.customer_db (
						s_id,
						name,
						nickname,
						ubn,
						company_phone,
						company_fax,
						email,
						location,
						address,
						contact,
						contact_phone
					) values (
						'".$client_s_id."',
						'".$client_name."',
						'".$client_nickname."',
						'".$client_ubn."',
						'".$client_company_phone."',
						'".$client_company_fax."',
						'".$client_email."',
						'".$client_location."',
						'".$client_address."',
						'".$client_contact."',
						'".$client_contact_phone."'
					)
					";
					/*
					$sql_cmd = "insert into client_info.customer_db ( name ) valuse"
					*/

					if ($conn->query($sql_cmd) === TRUE) {
						var_init();
						echo "
						<script>
							alert('成功新增客戶　".$client_name."。') ;
						</script>
						" ;
					}
					else {
						echo "
						<script>
							alert('錯誤！　新增客戶　".$client_name." 失敗！ 錯誤訊息：".$conn->error."') ;
						</script>
						" ;
					}
				}

				var_init() ;
			}
			else {
				echo "
				<script>
					alert('錯誤訊息：請留意輸入資料是否正確，名稱不可是空值，統編只能有數字') ;
				</script>
				" ;
			}
			$button2='<button type="submit" name="create_button" class="com_info" id="btn_button2">建立</button>';

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;
		}

		// 按下作廢按鈕
		if( isset($_POST["invalid_button"]) ) {
			client_get_html_input();
			$test=$test.' invalid_button<br/>';
			$h1_mod_color="color:#5b88f6;";


			$sql_cmd = "update client_info.customer_db set
				invalid = '1'
			where customer_id ='".$client_customer_id."'
			";
			//update client_info.customer_db set invalid='1' where customer_id='33' ;
			$result = $conn->query($sql_cmd) ;
			if( $result > 0 ) {
				echo "
				<script>
					alert('成功 作廢 客戶　".$client_name."　的資料。') ;
				</script>
				" ;

				var_init() ;
				$default_div_color = $default_sleep_input ;
				$disabled="disabled" ;
				$button2 = "" ;
				$button3 = "" ;
			}
			else {
				echo "
				<script>
					alert('錯誤！　作廢客戶 ".$client_name."　的資料發生錯誤！ 錯誤訊息：".$conn->error."') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info" id="btn_button2">修改</button>';
				$button3="<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;

			$button1='<button type="submit" name="find_button" class="com_info" id="find_button">尋找</button>';

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
			$sql_cmd = "select name from client_info.customer_db where name='".$id_arr[1]."' and invalid='0'" ;
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
				$sql_cmd = "update client_info.customer_db set invalid = 0 where customer_id ='".$id_arr[0]."'";
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
			$sql_cmd = "update client_info.customer_db set invalid = 2 where customer_id ='".$id_arr[0]."'";
			$result = $conn->query($sql_cmd) ;
		}

?>
<?
//----------------------------------------------------------------------------------------------
//-										Context											 -
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
		<div id="right">
			<? echo $find_name ; ?>
		</div>
		<content>
			<ul>
			<?php
				if( $invalid_mode == 1 ) {
					echo invalid_display( $conn, "customer" ) ;
				}
				elseif( $only_get_info != 1 ) {
					echo "
					<input type='hidden' name='client_customer_id' value='$client_customer_id'>
					<input type='hidden' name='client_name_backup' value='$client_name_backup'>
					<input type='hidden' name='client_location_backup' value='$client_location_backup'>
					<li id='list1'>
						<div id='sid'>
							<label for='sid'>流水號</label>
							<input type=text id='sid' name='s_id' value='$client_s_id' readonly>
							<span>流水號為系統自動產生</span>
						</div>
						<div id='name'>
							<label for='name'>客戶名稱</label>
							<input type=text id='name' name=name value='$client_name' maxlength='50' $name_readonly>
							<span>請輸入完整名稱</span>
						</div>
					</li>
					<li id='list2'>
						<div id='nickname'>
							<label for='nickname'>簡稱</label>
							<input type=text id='nickname' name=nickname value='$client_nickname' $readonly>
							<span></span>
						</div>
						<div id='ubn'>
							<label for='ubn'>統編</label>
							<input type=text id='ubn' name=ubn value='$client_ubn' minlength='8' maxlength='8' $readonly>
							<span></span>
						</div>
						<div id='company_phone'>
							<label for='company_phone'>公司電話</label>
							<input type=text id='company_phone' name=company_phone value='$client_company_phone' $readonly>
							<span>格式範例： 02-7736-0456 </span>
						</div>
						<div id='company_fax'>
							<label for='company_fax'>傳真</label>
							<input type=text id='company_fax' name=company_fax value='$client_company_fax' $readonly>
							<span>格式建議同公司電話 </span>
						</div>
					</li>
					<li id='list3'>
						<div id='location'>
							<label for='location'>地點</label>
							".$location."
							<span>選擇所屬主要縣市</span>
						</div>
						<div id='address'>
							<label for='address'>完整地址</label>
							<input type=text id='address' name=address value='$client_address' $readonly>
							<span>輸入完整地址 Ex： 台北市南港區三重路777號</span>
						</div>
					</li>
					<li id='list4'>
						<div id='contact'>
							<label for='contact'>聯絡人</label>
							<input type=text id='contact' name=contact value='$client_contact' $readonly>
							<span> 主要聯繫的聯絡人 </span>
						</div>
						<div id='contact_phone'>
							<label for='contact_phone'>聯絡人電話</label>
							<input type=text id='contact_phone' name=contact_phone value='$client_contact_phone' $readonly>
							<span> 聯絡人的聯絡方式： 分機 或 手機</span>
						</div>
						<div id='email'>
							<label for='email'>Email</label>
							<input type=text id='email' name=email value='$client_email' $readonly  class='default'>
							<span>聯絡人 或是 公司電子信箱</span>
						</div>
					</li>
					<li id='list5'>
						<div id='modify'>".$button1."</div>
						<div id='create'>".$button2."</div>
						<div id='invalid'>".$button3."</div>
					</li>
					" ;
				}
				else {
					echo find_all($conn, "customer") ;
				}


			?>
			</ul>
		</content>

		<footer><?php echo $footer_context; ?></footer>





	</form>


	<script>
	function create_duplicate() {
		alert("建立失敗") ;
	}
	</script>


</body>
</html>



<?php
//----------------------------------------------------------------------------------------------
//-                                         Style                                              -
//----------------------------------------------------------------------------------------------
include("style.php") ;

?>