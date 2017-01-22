<?php
	include 'config.php' ;
	include 'functions.php' ;
?>

<html>
<head><title>六妖資訊帳務管理系統</title>
<style>
.select_item{
	font-size:30px;
	width:200px;
}

</style>
</head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<header>
	</header>
	<article>
	<section>
		<div>
		<input type=text name=type_value value= 2 >
		<input type=text name=info_value value= 11 >
		<button type=submit name=btn_edit_quo >創造或修改報價單</button>		
		</div>
		<div>
		<?php
			if(isset($_POST['btm_confirm_client'])) {
				quotation_products_list( $_POST['btm_confirm_client'] ) ;
			}
			
			if(isset($_POST['btn_edit_quo'])) {
				modify_quo( $_POST['type_value'] , $_POST['info_value'] ) ;
			}
			
			if(isset($_POST['submit_yo'])) {
				showresult() ;
			}

		?>
		</div>
	</section>
	</article>

	<footer>
	</footer>
</form>
</body>
</html>

<?php 
function quotation_products_list($customer){
	
	
	connect2db() ;
	global $conn ;
	global $item_arr ;
	
	$item_arr=array() ;
	$sql_cmd = "select * from client_info.customer_db where customer_id=".$customer ;	
	$result = mysql_query( $sql_cmd, $conn ) ;
	$row = mysql_fetch_array( $result);
	
	echo "hi".$row['customer_id']."<br>";
}
//$NewOrADD=1 新增
//$NewOrADD=2 修改
function modify_quo( $NewOrADD , $info ){
	echo "NewOrADD:".$NewOrADD." info:".$info."<br>";
	echo "<input type='hidden' name='NewOrADD' value='".$NewOrADD."' >";
	
	connect2db() ;
	global $conn ;
	global $item_arr ;
	
	$item_arr=array() ;
	
	$sql_cmd = "	(SELECT item_id,name ,s_id ,price,currency
							FROM client_info.item_db AS I 
						WHERE I.s_id LIKE 'P%' AND I.invalid=0	)
					UNION
					(SELECT item_id,name ,s_id ,price,currency
							FROM client_info.item_db AS I 
						WHERE I.s_id LIKE 'M%' AND I.invalid=0	)
					UNION
					(SELECT item_id,name ,s_id ,price,currency
							FROM client_info.item_db AS I 
						WHERE I.s_id LIKE 'N%' AND I.invalid=0	)" ;	
						
	$result = mysql_query( $sql_cmd, $conn ) ;
	
	for( $i=0 ; $row = mysql_fetch_array($result) ; $i++){
				$item_arr[$i][0]=$row['item_id'];
				$item_arr[$i][1]=$row['s_id'];	
				$item_arr[$i][2]=$row['name'];	
				$item_arr[$i][3]=$row['currency'];
				$item_arr[$i][4]=$row['price'];
	}
	
	if($NewOrADD == 2){
		$target_quo = $info ;	
		echo "<input type='hidden' name='quo_id' value='".$target_quo."' >";
	}
	else
		$target_quo = 0 ;
	
	$sql_cmd = "SELECT QD.* ,I.name,I.price AS origin_price
				FROM client_info.quotation_detail_db AS QD 
				LEFT JOIN client_info.item_db AS I
					ON QD.item_id = I.item_id
				WHERE QD.invalid = 0 AND QD.quo_id=".$target_quo ;
					
	$result = mysql_query( $sql_cmd, $conn ) ;
	//$row = mysql_fetch_array( $result);
	
	if(mysql_num_rows($result)>0){
		$already_amount=mysql_num_rows($result);
	}
	else
		$already_amount=0;
	
	echo "<input type='hidden' name='already_amount' value='".$already_amount."' >";
	
	
	echo "<table>";
	echo "<tr>";
		echo "<th>刪除";
		echo "</th>";
		echo "<th>項次";
		echo "</th>";
		echo "<th>物品選擇";
		echo "</th>";
		echo "<th>數量，已有資料數：".$already_amount;
		echo "</th>";
		echo "<th>報價金額";
		echo "</th>";
	echo "</tr>";
	
	for( $i=0 ; $i<20 ; $i++){
		
		if($i<$already_amount){
			$row = mysql_fetch_array( $result );
			echo "<tr>";
				echo "<td>";
				echo "<input type='checkbox' name='delete[]' value=".$i."><BR/>";
				echo "</td>";
				echo "<input type='hidden' name='quo_item_id[]' value='".$row['quo_item_id']."' >";
				
				
				echo "<td>";	
				echo ($i+1);
				echo "</td>";
				
				
				echo "<td>";	
				echo $row['item_id'].",".$row['name'];
				echo "<input type=hidden name='selector_item[]' value=".$row['item_id'].">";
				echo "</td>";
				
				
				echo "<td>";	
				echo "<input type=number name='amount[]' value=".$row['amount']." required=1>";
				echo "</td>";
				
				//每次增加量為 建議售價/500
				$step=($row['origin_price'])/500;
				$step=(int)$step;
				if($step==0)
					$step+=1;
				echo "<td>";
				echo "<input type=number name='price[]' value=".$row['price']." required=1 step = ".$step.">";
				echo "</td>";
				
			echo "</tr>";
		}
		else{
			echo "<tr>";
				echo "<td>";
				echo "</td>";
				
				
				echo "<td>";	
				echo ($i+1);
				echo "</td>";
				
				
				echo "<td>";	
				//echo "<input type=text name='selector_item[]' ><BR/>";
					echo "<select name='selector_item[]' class='select_item'>";
						echo "<option value=NULL> -- 請選擇物品 -- </option>";
					for( $j=0 ; $j<sizeof($item_arr) ; $j++){
						echo "<option value=".$item_arr[$j][0]." >《".$item_arr[$j][0].",".$item_arr[$j][1].",".$item_arr[$j][3]."$ ".$item_arr[$j][4]." 》 ".$item_arr[$j][2]."</option>";
					}
				echo "</select>";
				echo "</td>";
				
				
				echo "<td>";	
				echo "<input type=number name='amount[]' value=0 required=1>";
				echo "</td>";
				
				echo "<td>";
				echo "<input type=number name='price[]' value=0 required=1 step = 10>";
				echo "</td>";
				
			echo "</tr>";
		}		
	}
	/*
	echo "<input type='text' name='good[]' value='1'/><BR/>";
	echo "<input type='text' name='price[]' value='V1'/><BR/>";
	echo "<input type='text' name='good[]' value='2'/><BR/>";
	echo "<input type='text' name='price[]' value='V2'/><BR/>";
	echo "<input type='text' name='good[]' value='3'/><BR/>";
	echo "<input type='text' name='price[]' value='V3'/><BR/>";
	echo "<input type='text' name='good[]' value='4'/><BR/>";
	echo "<input type='text' name='price[]' value='V4'/><BR/>";	
	*/
	echo "</table>";
	echo "<td>";		
			echo "<button type=submit name='submit_yo' value='submit'>hellothere</button>";
	echo "</td>";
	
}

function showresult(){
	for($i=0 ; $i<20 ; $i++){
	echo "delete: ".$_POST['delete'][$i]." "; 
	//echo "number: ".$_POST['number'][$i]." "; 
	echo "selector_item: ".$_POST['selector_item'][$i]." "; 
	echo "amount: ".$_POST['amount'][$i]." "; 
	echo "price: ".$_POST['price'][$i]." <br>"; 
	}
	
	$sql_cmd_arr=array();
	
	$sql_cmd_amt=0;
	
	//已存在的資料數量
	$ardy_amt=$_POST['already_amount'];
	//要寫入的報價單
	$nora=$_POST['NewOrADD'];
	if($nora==2)
		$quo_id=$_POST['quo_id'];
	else
		$quo_id=( get_biggest_quo_id()+1 );
	
	echo "Target quo_id: ".$quo_id."<br>";
	
	//買最貴的物品
	$most_buy_item = 0;
	//買最貴的物品總金額
	$most_buy_price = 0;
	//報價單總金額
	$quo_price = 0;
	//修改已存在的物品資料
	for($i=0 ; $i<$ardy_amt ; $i++){
		$cancel=0;
		for($j=0 ; $j<$ardy_amt ; $j++){
			if(isset($_POST['delete'][$j]))
				if($i==$_POST['delete'][$j]){
					$sql_cmd_arr[$sql_cmd_amt]="UPDATE client_info.quotation_detail_db SET invalid=1 WHERE quo_item_id=".$_POST['quo_item_id'][$i];
					echo ">>Sql Cmd[".$sql_cmd_amt."]: ".$sql_cmd_arr[$sql_cmd_amt]."<br>";
					$sql_cmd_amt++;
					$cancel=1;
					//echo "<br>抓到".$i."已被".$j."刪除";
				}
				
		}
		if($cancel==0){
			$sql_cmd_arr[$sql_cmd_amt]="UPDATE client_info.quotation_detail_db SET amount=".$_POST['amount'][$i].", price=".$_POST['price'][$i]." WHERE quo_item_id=".$_POST['quo_item_id'][$i];
			echo ">>Sql Cmd[".$sql_cmd_amt."]: ".$sql_cmd_arr[$sql_cmd_amt]."<br>";
			$sql_cmd_amt++;
			if( ($_POST['price'][$i]*$_POST['amount'][$i])> $most_buy_price){
				$most_buy_price=($_POST['price'][$i]*$_POST['amount'][$i]);
				echo "most_buy_price:".$most_buy_price;
				$most_buy_item=$_POST['selector_item'][$i];
				echo " most_buy_item:".$most_buy_item."<br>";
			}
		}
	}
	//新增不存在的物品資料進quo_detail
	if((20-$ardy_amt)!=0){
		//如果是新增的話，要設定目標quo_id=Max(quo_id)
	}
}

function get_biggest_quo_id(){
	connect2db() ;
	global $conn ;
	
	return 10;
}

?>
