<?php

//取得 產品名稱 數量 說明內容
function client_get_html_input() {

	require('var.php') ;

	$client_customer_id     = $_POST["client_customer_id"];
	$client_s_id            = $_POST["s_id"];
	$client_name            = $_POST["name"];
	$client_name_backup     = $_POST["client_name_backup"];
	$client_nickname        = $_POST["nickname"];
	$client_ubn             = $_POST["ubn"];
	$client_company_phone   = $_POST["company_phone"];
	$client_company_fax     = $_POST["company_fax"];
	$client_email           = $_POST["email"];
	$client_location        = $_POST["location"];
	$client_location_backup = $_POST["client_location_backup"];
	$client_address         = $_POST["address"];
	$client_contact         = $_POST["contact"];
	$client_contact_phone   = $_POST["contact_phone"];
}

function supplier_get_html_input() {

	require('var.php') ;

	$supplier_supplier_id     = $_POST["supplier_id"];
	$supplier_s_id            = $_POST["supplier_s_id"];
	$supplier_name            = $_POST["name"];
	$supplier_name_backup     = $_POST["supplier_name_backup"];
	$supplier_nickname        = $_POST["nickname"];
	$supplier_ubn             = $_POST["ubn"];
	$supplier_company_phone   = $_POST["company_phone"];
	$supplier_company_fax     = $_POST["company_fax"];
	$supplier_email           = $_POST["email"];
	$supplier_location        = $_POST["location"];
	$supplier_location_backup = $_POST["supplier_location_backup"];
	$supplier_address         = $_POST["address"];
	$supplier_contact         = $_POST["contact"];
	$supplier_contact_phone   = $_POST["contact_phone"];
}

function location_get_html_input() {

	require('var.php') ;

	$location_id                 = $_POST["location_id"];
	$location_s_id               = $_POST["location_s_id"];
	$location_country            = $_POST["location_country"];
	$location_country_sid        = $_POST["location_country_sid"];
	$location_country_sid_backup = $_POST["location_country_sid_backup"];
	$location_city               = $_POST["location_city"];
	$location_city_sid           = $_POST["location_city_sid"];
	$location_city_sid_backup    = $_POST["location_city_sid_backup"];
}

function item_get_html_input() {

	require('var.php') ;

	$item_id             = $_POST["item_id"];
	$item_s_id           = $_POST["item_s_id"];
	$item_name           = $_POST["item_name"];
	$item_name_backup    = $_POST["item_name_backup"];
	$item_type_id        = $_POST["item_type_id"];
	$item_type_id_backup = $_POST["item_type_id_backup"];
	$item_supplier_id    = $_POST["item_supplier_id"];
	$item_price          = $_POST["item_price"];
	$item_currency       = $_POST["item_currency"];
}

function var_init() {

	require('var.php') ;
	// Ctrl alt a 對齊
	$client_customer_id          = '' ;
	$client_s_id                 = '' ;
	$client_name                 = '' ;
	$client_name_backup          = '' ;
	$client_nickname             = '' ;
	$client_ubn                  = '' ;
	$client_company_phone        = '' ;
	$client_company_fax          = '' ;
	$client_email                = '' ;
	$client_location             = '' ;
	$client_location_backup      = '' ;
	$client_address              = '' ;
	$client_contact              = '' ;
	$client_contact_phone        = '' ;

	$supplier_supplier_id        = '' ;
	$supplier_s_id               = '' ;
	$supplier_name               = '' ;
	$supplier_name_backup        = '' ;
	$supplier_nickname           = '' ;
	$supplier_ubn                = '' ;
	$supplier_company_phone      = '' ;
	$supplier_company_fax        = '' ;
	$supplier_email              = '' ;
	$supplier_location           = '' ;
	$supplier_location_backup    = '' ;
	$supplier_address            = '' ;
	$supplier_contact            = '' ;
	$supplier_contact_phone      = '' ;

	$item_id                     = '' ;
	$item_s_id                   = '' ;
	$item_name                   = '' ;
	$item_name_backup            = '' ;
	$item_type_id                = '' ;
	$item_type_id_backup         = '' ;
	$item_supplier_id            = '' ;
	$item_price                  = '' ;
	$item_currency               = '' ;

	$location_id                 = '' ;
	$location_s_id               = '' ;
	$location_s_id_backup        = '' ;
	$location_country            = '' ;
	$location_country_sid        = '' ;
	$location_country_sid_backup = '' ;
	$location_city               = '' ;
	$location_city_sid           = '' ;
}

function location_select_option($conn, $selected='') {

	require('var.php') ;
	$location_arr = array() ;
	$sql_cmd = "select * from client_info.location_db where invalid='0'" ;
	$html_code = "<select id='location' name='location' $disabled>" ;
	$result = $conn->query($sql_cmd) ;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if( $selected == $row['location_id'] ) {
				$html_code = $html_code."<option value='".$row['location_id']."' selected='selected'>".$row['city']."</option>" ;
			} else {
				$html_code = $html_code."<option value='".$row['location_id']."'>".$row['city']."</option>" ;
			}
			//array_push($location_arr,$row['city']);
		}
		$html_code = $html_code."</select>" ;
	} else {
		/*

		echo "
		<script>
			alert('讀取地點下拉選單錯誤') ;
		</script>
		" ;

		*/
		$html_code .= "<option value='none'>請先建立地點資料</option></select>" ;
	}
	return $html_code ;
}

function supplier_select_option($conn, $selected='') {
	require("var.php") ;
	$sql_cmd = "select * from client_info.supplier_db where invalid='0'" ;
	$html_code = "<select id='item_supplier_id' name='item_supplier_id' $disabled>" ;
	$result = $conn->query($sql_cmd) ;
	if( $result->num_rows > 0 ) {
		while($row = $result->fetch_assoc()) {
			if( $selected == $row['supplier_id'] ) {
				$html_code = $html_code."<option value='".$row['supplier_id']."' selected='selected'>".$row['name']."</option>" ;
			} else {
				$html_code = $html_code."<option value='".$row['supplier_id']."'>".$row['name']."</option>" ;
			}
		}
		$html_code = $html_code."</select>" ;
	} else {
		/*
		echo "
		<script>
			alert('讀取地點下拉選單錯誤') ;
		</script>
		" ;
		*/
		$html_code .= "<option value='none'>請先建立供應商資料</option></select>" ;
	}

	return $html_code ;
}

function item_type_select_option($selected='') {
	require('var.php') ;

	$html_code = "<select id='item_type_id' name='item_type_id'>" ;
	if( preg_match("/P/", $selected) ) {
		$item_type_id_backup = "P" ;
		$p_s = "selected='selected'" ;
		$html_code.=">" ;
	}
	elseif( preg_match("/M/", $selected) ) {
		$item_type_id_backup = "M" ;
		$m_s = "selected='selected'" ;
		$html_code.=">" ;
	}
	elseif( preg_match("/N/", $selected) ) {
		$item_type_id_backup = "N" ;
		$o_s = "selected='selected'" ;
		$html_code=$html_code.">" ;
	}
	elseif( preg_match("/ro/", $selected) ) {
		$html_code = "<select id='item_type_id' name='item_type_id' disabled>" ;
	}
	$html_code = $html_code."<option value='P' ".$p_s.">產品</option>
		<option value='M' ".$m_s.">材料</option>
		<option value='N' ".$o_s.">其他</option>
	</select>" ;
	return $html_code ;
}

function sid_create($conn, $w) {
	require('var.php') ;
	if( $w == "customer") {
		$str = 'C' ;
		$location = $client_location ;
	}
	elseif( $w == "supplier") {
		$str = 'S' ;
		$location = $supplier_location ;
	}
	$sql_cmd = "select * from client_info.location_db where location_id='".$location."'" ;
	$result = $conn->query($sql_cmd) ;
	if ($result->num_rows > 0) {
		// fetch result as an associate array
		while ($row = $result->fetch_assoc()) {
			$str=$str.$row['country_sid'].$row['city_sid'] ;
		}
	} else {
		echo "
		<script>
			alert('sid_create find location id ERROR') ;
		</script>
		" ;
	}
	// select s_id from client_info.customer_db where s_id like 'CTWTYN%' order by s_id ;
	$sql_cmd = "select s_id from client_info.".$w."_db where s_id like '".$str."%' order by s_id desc" ;
	$result = $conn->query($sql_cmd) ;

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc() ;
		$arr = explode( $str, $row['s_id'] ) ;
		$id_num = (int)$arr[1]+1 ;
		if( $id_num/100 >= 1 ) {
			return $str.$id_num ;
		}
		elseif( $id_num/10 >= 1 ) {
			return $str.'0'.$id_num ;
		}
		else {
			return $str.'00'.$id_num ;
		}
	}
	elseif( $result->num_rows == 0 ) {
		return $str.'001' ;
	}
	else {
		echo "
		<script>
			alert('sid_create 錯誤') ;
		</script>
		" ;
	}
}

function item_sid_create($conn, $w) {
	require('var.php') ;
	$str = $w ;
	// select s_id from client_info.customer_db where s_id like 'CTWTYN%' order by s_id ;
	$sql_cmd = "select s_id from client_info.item_db where s_id like '".$str."%' order by s_id desc" ;

	$result = $conn->query($sql_cmd) ;

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc() ;
		// P002 -> p, 002
		$arr = explode( $str, $row['s_id'] ) ;
		$id_num = (int)$arr[1]+1 ;
		if( $id_num/100 >= 1 ) {
			return $str.$id_num ;
		}
		elseif( $id_num/10 >= 1 ) {
			return $str.'0'.$id_num ;
		}
		else {
			return $str.'00'.$id_num ;
		}
	}
	elseif( $result->num_rows == 0 ) {
		return $str.'001' ;
	}
	else {
		echo "
		<script>
			alert('item_sid_create 錯') ;
		</script>
		" ;
	}
}

function find_all($conn, $w) {
	require('var.php') ;
	if( $w == "item" )
		$sql_cmd = "(	SELECT I.name AS 'iname',I.s_id AS 'is_id',price,currency,S.name AS 'sname'
							FROM client_info.item_db AS I
						LEFT JOIN supplier_db AS S
							ON S.supplier_id=I.supplier_id
						WHERE I.s_id LIKE 'P%' AND I.invalid=0	)
					UNION
					(	SELECT I.name AS 'iname',I.s_id AS 'is_id',price,currency,S.name AS 'sname'
							FROM client_info.item_db AS I
						LEFT JOIN supplier_db AS S
							ON S.supplier_id=I.supplier_id
						WHERE I.s_id LIKE 'M%' AND I.invalid=0	)
					UNION
					(	SELECT I.name AS 'iname',I.s_id AS 'is_id',price,currency,S.name AS 'sname'
							FROM client_info.item_db AS I
						LEFT JOIN supplier_db AS S
							ON S.supplier_id=I.supplier_id
						WHERE I.s_id LIKE 'N%' AND I.invalid=0	)" ;
	else if( $w == "location" )
		$sql_cmd = "SELECT * FROM client_info.location_db AS L WHERE invalid = 0 ORDER BY L.country_sid DESC, L.location_id ASC" ;
	else if( $w == "supplier" )
		$sql_cmd = "SELECT * FROM client_info.supplier_db AS S WHERE invalid = 0 ORDER BY S.location ASC, S.s_id ASC" ;
	else if( $w == "customer" )
		$sql_cmd = "SELECT * FROM client_info.customer_db AS C WHERE invalid = 0 ORDER BY C.location ASC, C.s_id ASC" ;
	else
		$sql_cmd = "select * from client_info.".$w."_db where invalid='0'" ;
	$result = $conn->query($sql_cmd) ;
	if( $result->num_rows>0 ) {
		if( $w == "location" ) {
			$find_all = "
			<table>
				<tr>
					<th>國家</th>
					<th>國家 code</th>
					<th>城市</th>
					<th>城市 code</th>
				</tr>
			" ;
			while( $row = $result->fetch_assoc() ) {
				$find_all .= "
				<tr>
					<td>".$row['country']."</td>
					<td>".$row['country_sid']."</td>
					<td>".$row['city']."</td>
					<td>".$row['city_sid']."</td>
				</tr>
				" ;
			}
			$find_all .= "</table>" ;
		}
		elseif( $w == "customer" ) {
			$find_all = "
			<table>
				<tr>
					<th>名稱</th>
					<th>電話</th>
					<th>地址</th>
					<th>聯絡人</th>
					<th>聯絡人電話</th>
				</tr>
			" ;
			while( $row = $result->fetch_assoc() ) {
				$find_all .= "
				<tr>
					<td>".$row['name']."</td>
					<td>".$row['company_phone']."</td>
					<td>".$row['address']."</td>
					<td>".$row['contact']."</td>
					<td>".$row['contact_phone']."</td>
				</tr>
				" ;
			}
			$find_all .= "</table>" ;
		}
		elseif( $w == "supplier" ) {
			$find_all = "
			<table>
				<tr>
					<th>名稱</th>
					<th>電話</th>
					<th>地址</th>
					<th>聯絡人</th>
					<th>聯絡人電話</th>
				</tr>
			" ;
			while( $row = $result->fetch_assoc() ) {
				$find_all .= "
				<tr>
					<td>".$row['name']."</td>
					<td>".$row['company_phone']."</td>
					<td>".$row['address']."</td>
					<td>".$row['contact']."</td>
					<td>".$row['contact_phone']."</td>
				</tr>
				" ;
			}
			$find_all .= "</table>" ;
		}
		elseif( $w == "item" ) {
			$find_all = "
			<table>
				<tr>
					<th>物品種類</th>
					<th>物品名稱</th>
					<th>供應商</th>
					<th>建議售價</th>
				</tr>
			" ;
			while( $row = $result->fetch_assoc() ) {
				if($row['is_id'][0]=='P')
					$i_type='產品';
				else if($row['is_id'][0]=='M')
					$i_type='材料';
				else
					$i_type='其他';
				$find_all .= "
				<tr>
					<td>".$i_type."</td>
					<td>".$row['iname']."</td>
					<td>".$row['sname']."</td>
					<td>".$row['currency']."$ ".number_format($row['price'])."</td>
				</tr>
				" ;
			}
			$find_all .= "</table>" ;
		}
	}
	return $find_all ;
}

function create_name_option( $where='', $conn, $input  ) {
	$sql_cmd = "select * from client_info.".$where."_db where name like '%".$input."%' and invalid='0'" ;
	$result = $conn->query( $sql_cmd ) ;
	$str = "<table><tr><td colspan='2'>" ;
	$str .= " <br/>您查詢的 <b>".$input."</b> 不存在在資料庫中<br/><br/>不過有以下類似的參考資料<br/><br/>" ;
	$str .= "</td></tr>" ;
	if( $where=="customer" or $where=="supplier" ) {
		$str .= "<tr><th>名稱</th><th>聯絡人</th></tr>" ;
	}
	elseif( $where=="item" ) {
		$str .= "<tr><th>名稱</th><th>價格</th></tr>" ;
	}
	if( $result->num_rows>0 ) {
		while( $row = $result->fetch_assoc() ) {
			$str .= "<tr>" ;
			if( $row["name"]==$input ) {
				$str="" ;
				return $str ;
			}
			else {
				$str .= "<td>".$row["name"]."</td>" ;
				if( $where=="customer" || $where=="supplier" ) {
					$str .= "<td>".$row["contact"]."</td>" ;
				}
				elseif( $where=="item" ) {
					$str .= "<td>$".$row["price"]." ".$row["currency"]."</td>" ;
				}
			}
			$str .= "</tr>" ;
		}
		$str .= "</table>" ;
	}
	else {
		$str = "<table><tr><th>沒有任何類似符合".$input."的項目</th></tr></table>" ;
	}
	return $str ;
}

function invalid_display( $conn, $db ) {
	$html_code ="
		<table>
			<tr>
				<th>名稱</th>
				<th>動作</th>
			</tr>
		" ;
	$sql_cmd = "select * from client_info.".$db."_db where `invalid` = 1" ;
	$result = $conn->query($sql_cmd) ;
	if ( $result->num_rows > 0 ) {
		while( $row = $result->fetch_assoc() ) {
			$html_code .= "<tr><td>" ;

			if( $db == "location" ) {
				$html_code .= $row['country_sid'].$row['city_sid'] ;
			}
			else {
				$html_code .= $row['name'] ;
			}

			$html_code .= "</td>
				<td>
					<button type='submit' name='invalid_btn[]' value='".$row[$db.'_id']."-" ;

			if( $db == 'location' ) {
				$html_code .= $row['country_sid']."-".$row['city_sid'] ;
			}
			else {
				$html_code .= $row['name'] ;
			}

			$html_code .= "' class='invalid_btn' id='".$row[$db.'_id']."' >還原</button>
					<button type='submit' name='del_btn[]' value='".$row[$db.'_id']."-" ;

			if( $db == 'location' ) {
				$html_code .= $row['country_sid']."-".$row['city_sid'] ;
			}
			else {
				$html_code .= $row['name'] ;
			}

			$html_code .= "' class='del_btn' id='".$row[$db.'_id']."' >刪除</button>
				</td>
				</tr>" ;
		}
	}
	else {
		$html_code .= "<tr><td colspan='2'>垃圾桶是空的</td></tr>" ;
	}
	$html_code .= "</table>" ;
	return $html_code ;
}

?>