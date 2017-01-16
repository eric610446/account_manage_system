<html>

<head>
	<title>產品資料建立/修改/查詢</title>
</head>

<body class='settings'>

<?

//----------------------------------------------------------------------------------------------
//-									   INITIALIZE										   -
//----------------------------------------------------------------------------------------------
		require("function.php") ;
		require("var.php") ;
		include("initialize.php") ;
		include("style.php") ;
		include("../config.php") ;
		$supplier_select_option = supplier_select_option($conn) ;
		$where_am_i = "supplier" ;


//----------------------------------------------------------------------------------------------
//-										 ACTION											 -
//----------------------------------------------------------------------------------------------

		//設定建立模式與修改模式的按鈕顏色
		if( isset($_POST['create_mode']) or ($_GET["mode"]=="create") ) {
			$mode = "create" ;
			var_init();
			$readonly = "" ;						
			$default_div_color = $default_active_input ;
			$final_status='';
			$test=$test.' create mode<br/>';
			$button2='<button type="submit" name="create_button" >建立</button>';
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn) ;		
		}
		if(isset($_POST['modify_mode']) or ($_GET["mode"]=="modify") ) {
			$mode = "modify" ;
			$button1='<button type="submit" name="find_button" >尋找</button>';
			var_init();
			$readonly = "readonly" ;				
			$default_div_color = $default_sleep_input ;			
			$disabled="disabled" ;
			$test=$test.' edit mode<br/>';
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn) ;	
		}
		if(isset($_POST['find_mode']) or ($_GET["mode"]=="find") ) {
			$mode = "find" ;
			$button1='<button type="submit" name="find_button" >尋找</button>';
			var_init();
			$test=$test.' find mode<br/>';
			$only_get_info=1;
		}

		//查詢
		if(isset($_POST['find_button'])) {
			$mode = "modify" ;
			$test=$test.' find button<br/>';
			supplier_get_html_input();
			$h1_mod_color="color:#5b88f6;";
			
			//防止供應商名稱沒輸入
			if ($supplier_name == '') {
				$find_status = "請輸入要查詢的產品名稱";
				var_init();
				$readonly = "readonly" ;				
				$default_div_color = $default_sleep_input ;			
				$disabled="disabled" ;
				echo "			
				<script>
					alert('錯誤！　請輸入供應商名稱後再[尋找]。') ;
				</script>
				" ;
			}
			//產品名稱有輸入
			else {
				$find_name = create_name_option( "supplier", $conn, $supplier_name ) ;
				if( $find_name == "" ) {
					$sql_cmd = 'select * from client_info.supplier_db where name="'.$supplier_name.'" and invalid="0"' ;

					//查詢的供應商有存在在資料庫中
					$result = $conn->query($sql_cmd) ;
					if ( $result->num_rows > 0 ) {
						// fetch result as an associate array
						while( $row = $result->fetch_assoc() ) {
							$supplier_s_id          = $row['s_id'] ;
							$supplier_supplier_id   = $row['supplier_id'] ;
							$supplier_name          = $row['name'] ;
							$supplier_nickname      = $row['nickname'] ;
							$supplier_ubn           = $row['ubn'] ;
							$supplier_company_phone = $row['company_phone'] ;
							$supplier_company_fax   = $row['company_fax'] ;
							$supplier_email         = $row['email'] ;
							$supplier_location      = $row['location'] ;
							$supplier_address       = $row['address'] ;
							$supplier_contact       = $row['contact'] ;
							$supplier_contact_phone = $row['contact_phone'] ;
						}	

						$find_status= "查詢成功!";

						$readonly = "" ;			
						$default_div_color = $default_active_input ;
						$button2='<button type="submit" name="modify_button" >修改</button>';
						$button3="<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;

					}
				}
				//查詢的產品不存在在資料庫中
				else {
					$find_status="$supplier_name 的資料尚未被建立 ...";
					$readonly = "readonly" ;				
					$default_div_color = $default_sleep_input ;		
					$disabled="disabled" ;
					echo "			
					<script>
						alert('錯誤！　供應商　".$supplier_name."　的資料尚未建立！') ;
					</script>
					" ;
					var_init() ;
					$button2="" ;
					$button3="" ;
				}
			}
			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $supplier_location) ;	

			$button1='<button type="submit" name="find_button" >尋找</button>';
		}			
		


		//修改
		if(isset($_POST['modify_button'])) {
			$mode = "modify" ;
			supplier_get_html_input();
			$test=$test.' modify button<br/>';
			$h1_mod_color="color:#5b88f6;";


			// 確認至少 name 不可以是空的
			if( $supplier_name != "" ) {
				// 建立流水號
				$supplier_s_id = sid_create($conn, "supplier") ;

				$sql_cmd = "update client_info.supplier_db set 
					s_id='".$supplier_s_id."',
					name='".$supplier_name."',
					nickname='".$supplier_nickname."',
					ubn='".$supplier_ubn."',
					company_phone='".$supplier_company_phone."',
					company_fax='".$supplier_company_fax."',
					email='".$supplier_email."',
					location='".$supplier_location."',
					address='".$supplier_address."',
					contact='".$supplier_contact."',
					contact_phone='".$supplier_contact_phone."' 
				where supplier_id='".$supplier_supplier_id."'
				";
				$result = $conn->query($sql_cmd) ;
				if( $result > 0 ) {
					$final_status = $final_status.' <br/>成功修改供應商資料 ...<br/>';
					echo "			
					<script>
						alert('成功修改供應商　".$supplier_name."　的資料。') ;
					</script>
					" ;
					$button2="" ;
					$button3="" ;
					var_init() ;
					$readonly = "readonly" ;				
					$default_div_color = $default_sleep_input ;
					$disabled = "disabled" ;
				} 
				else {			
					$final_status = $final_status.' <br/>修改供應商資料失敗，錯誤訊息:'.$conn->error.'<br/>';
					echo "			
					<script>
						alert('錯誤！　供應商　".$supplier_name."　的資料修改錯誤！錯誤訊息：".$conn->error."') ;
					</script>
					" ;
					$button2='<button type="submit" name="modify_button" >修改</button>';
					$button3="<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
				}
			}
			else {
				echo "			
				<script>
					alert('錯誤！　修改供應商 ".$supplier_name."　的資料發生錯誤！ 錯誤訊息：名稱不可是空值') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}
			

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $supplier_location) ;


			$button1='<button type="submit" name="find_button" >找商品</button>';
		}


		//建立
		if(isset($_POST['create_button'])) {
			$mode = "create" ;
			$test=$test.' create button<br/>';
			supplier_get_html_input();	
			
			if ($supplier_name != "") {	
				
				//檢查 Database 有沒有重複建立的 client
				$sql_cmd = "select name from client_info.supplier_db where name='".$supplier_name."' and invalid='0'" ;
				$result = $conn->query($sql_cmd) ;
				if ($result->num_rows > 0) {
					$final_status = $final_status.'<br/>建立產品資料失敗！<br/>原因：'.$supplier_name.' 不可重複建立！<br/>';

					echo "			
					<script>
						alert('供應商　".$supplier_name."　不可重複建立！') ;
					</script>
					" ;
					var_init() ;
				}
				else {
					// 建立流水號
					$supplier_s_id = sid_create($conn, "supplier") ;

					// 建立新的 供應商欄位					
					$sql_cmd = "insert into client_info.supplier_db (
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
						'".$supplier_s_id."',
						'".$supplier_name."',
						'".$supplier_nickname."',
						'".$supplier_ubn."',
						'".$supplier_company_phone."',
						'".$supplier_company_fax."',
						'".$supplier_email."',
						'".$supplier_location."',
						'".$supplier_address."',
						'".$supplier_contact."',
						'".$supplier_contact_phone."'
					)
					";
					/*
					$sql_cmd = "insert into client_info.supplier_db ( name ) valuse"
					*/
			
					if ($conn->query($sql_cmd) === TRUE) {
						$final_status = $final_status.' <br/>成功新增供應商 ...<br/>';
						var_init() ;
						echo "			
						<script>
							alert('成功建立供應商　".$supplier_name."　的資料。') ;
						</script>
						" ;
					} 
					else {
						$final_status = $final_status.' <br/>新增供應商失敗，錯誤訊息:'.$conn->error.'<br/>';
						echo "			
						<script>
							alert('錯誤！　建立供應商　".$supplier_name."　的資料錯誤！錯誤訊息：".$conn->error."') ;
						</script>
						" ;
					}
				}
				
			} 
			else {
				echo "			
				<script>
					alert('錯誤！　建立供應商　".$supplier_name."　的資料錯誤！錯誤訊息：".$conn->error."') ;
				</script>
				" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn) ;

			$button2='<button type="submit" name="create_button" >建立</button>';
		}	


		// 按下作廢按鈕
		if( isset($_POST["invalid_button"]) ) {
			supplier_get_html_input();
			$test=$test.' invalid_button<br/>';
			$h1_mod_color="color:#5b88f6;";
			

			$sql_cmd = "update client_info.supplier_db set 
				invalid='1'
			where supplier_id='".$supplier_supplier_id."'
			";
			$result = $conn->query($sql_cmd) ;
			if( $result > 0 ) {
				$final_status = $final_status.' <br/>成功 作廢 供應商資料 ...<br/>';
				echo "			
				<script>
					alert('成功 作廢 供應商　".$supplier_name."　的資料。') ;
				</script>
				" ;

				var_init() ;
				$input_color = "#f0f0f0" ;
				$disabled="disabled" ;	
				$button2 = "" ;
				$button3 = "" ;				
				$readonly = "readonly" ;				
				$default_div_color = $default_sleep_input ;
			} 
			else {			
				$final_status = $final_status.' <br/>失敗！ 作廢供應商資料失敗，錯誤訊息:'.$conn->error.'<br/>';
				echo "			
				<script>
					alert('錯誤！　作廢供應商 ".$supplier_name."　的資料發生錯誤！ 錯誤訊息：".$conn->error."') ;
				</script>
				" ;
				$button2 = '<button type="submit" name="modify_button" class="com_info">修改</button>';
				$button3 = "<button type='submit' name='invalid_button' class='com_info' id='btn_button3'>作廢</button>" ;
			}

			// 建立選取地點的下拉式選單
			$location = location_select_option($conn, $client_location) ;

			$button1='<button type="submit" name="find_button" class="com_info">找商品</button>';

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
			<!--<h1>SIX MONSTER ACCOUNT MANAGEMENT SYSTEM</h1>
			<h2><font face="Droid Serif"><<供應商>></font></h2>-->
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
		<div id="right"><? echo $find_name ; ?></div>
		<content>
			<ul>
			<?php

				if( $only_get_info != 1 ) {
					echo "	
					<input type='hidden' name='supplier_id' value='$supplier_supplier_id'>	
					<li id='list1'>
						<div id='sid'>
							<label for='sid'>流水號</label>
							<input type=text id='sid' name='supplier_s_id' value='$supplier_s_id' readonly>
							<span>流水號為系統自動產生</span>
						</div>	
						<div id='name'>
							<label for='name'>供應商名稱</label>
							<input type=text id='name' name=name value='$supplier_name'>
							<span>請輸入完整名稱</span>
						</div>
					</li>
					<li id='list2'>
						<div id='nickname'>
							<label for='nickname'>簡稱</label>
							<input type=text id='nickname' name=nickname value='$supplier_nickname' $readonly>
							<span></span>
						</div>						
						<div id='ubn'>
							<label for='ubn'>統編</label>
							<input type=text id='ubn' name=ubn value='$supplier_ubn' $readonly>
							<span></span>
						</div>						
						<div id='company_phone'>
							<label for='company_phone'>公司電話</label>
							<input type=text id='company_phone' name=company_phone value='$supplier_company_phone' $readonly>
							<span>格式範例： 02-7736-0456 </span>
						</div>						
						<div id='company_fax'>
							<label for='company_fax'>傳真</label>
							<input type=text id='company_fax' name=company_fax value='$supplier_company_fax' $readonly>
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
							<input type=text id='address' name=address value='$supplier_address' $readonly>
							<span>輸入完整地址 Ex： 台北市南港區三重路777號</span>
						</div>
					</li>
					<li id='list4'>					
						<div id='contact'>
							<label for='contact'>聯絡人</label>	
							<input type=text id='contact' name=contact value='$supplier_contact' $readonly>	
							<span> 主要聯繫的聯絡人 </span>
						</div>						
						<div id='contact_phone'>
							<label for='contact_phone'>聯絡人電話</label>
							<input type=text id='contact_phone' name=contact_phone value='$supplier_contact_phone' $readonly>
							<span> 聯絡人的聯絡方式： 分機 或 手機</span>
						</div>		
						<div id='email'>
							<label for='email'>Email</label>
							<input type=text id='email' name=email value='$supplier_email' $readonly  class='default'>
							<span>聯絡人 或是 公司電子信箱</span>
						</div>		
					</li>		
					<li id='list5'>
						<div id='modify'>".$button1."</div>
						<div id='create'>".$button2."</div>
						<!--<div id='invalid'>".$button3."</div>-->
					</li>
					" ;
				}
				else {
					echo find_all($conn, "supplier") ;
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

