<?php
	include 'functions.php' ;
	include 'style.php' ;
?>
<html>
<head><title>公司資料設定</title></head>

<body bgcolor="#EEF">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<section>
		<?php						
			$action_choose = $_POST['action_choose'] ;
			$qu_id = $_POST['qu_id'] ;
			
			if(isset($_REQUEST['save_company_info'])) { 
				connect2db() ;
				global $conn ;
				
				$sql_cmd = "UPDATE client_info.company_db 
							SET	name='".$_REQUEST['name']."',
								ubn='".$_REQUEST['ubn']."',
								contact='".$_REQUEST['contact']."',
								company_phone='".$_REQUEST['company_phone']."',
								company_fax='".$_REQUEST['company_fax']."',
								address='".$_REQUEST['address']."' 
							WHERE company_id = 0";
				$temp = mysql_query( $sql_cmd, $conn ) ;
			
				echo_alert('《提醒》：\n賣方資料已修改完畢。') ;
			}					
		?>
		<div style="text-align: center ;">
		<input type="hidden" name="action_choose" value="<?php echo $_REQUEST["action_choose"];?>">
		<input type="hidden" name="qu_id" value="<?php echo $_REQUEST["qu_id"];?>">
		
	
		<table class="table_cpdf">
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					LOGO標題設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">			
					(上限五個字)
				</td>
				<td class="td_cpdf11" >
					<input	type="text" 
							name="name" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('name'); ?>" 							
							maxlength=5
							placeholder="預設值：立旺鐵工廠"
							required="required">
				</td>
				<td class="td_cpdf12">
				</td>
			</tr>
			
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					統一編號設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">	
					(限八個數字)				
				</td>
				<td class="td_cpdf11" >
					<input 	type="text" 
							name="ubn" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('ubn'); ?>" 
							minlength=8
							maxlength=8
							pattern="[0-9]*"
							placeholder="預設值：08319015"
							required="required">
				</td>				
				<td class="td_cpdf12">
				</td>
			</tr>
			
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					連絡人名稱設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">			
				(上限二十個字)
				</td>
				<td class="td_cpdf11" >
					<input 	type="text" 
							name="contact" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('contact'); ?>" 
							maxlength=20
							placeholder="預設值：詹愛珠"
							required="required">
				</td>
				<td class="td_cpdf12">
				</td>
			</tr>
			
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					聯絡電話設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">			
				(上限二十個字)
				</td>
				<td class="td_cpdf11" >
					<input 	type="text" 
							name="company_phone" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('company_phone'); ?>" 							
							maxlength=20
							pattern="[0-9\u002D\u0028\u0029\u002A\u0023]*"
							placeholder="預設值：(04)2527-6007"							
							required="required">
							
				</td>
				<td class="td_cpdf12">
				僅允許輸入：<br>0123456789-#*()
				</td>
			</tr>
			
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					聯絡傳真設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">		
					(上限二十個字)
				</td>
				<td class="td_cpdf11" >
					<input 	type="text" 
							name="company_fax" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('company_fax'); ?>" 
							maxlength=20
							pattern="[0-9\u002D\u0028\u0029\u002A\u0023]*"
							placeholder="預設值：(04)2520-0785"
							required="required">
				</td>
				<td class="td_cpdf12">
				僅允許輸入：<br>0123456789-#*()
				</td>
			</tr>
			
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=3>
					聯絡地址設定：
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">
					(上限二十四個字)
				</td>
				<td class="td_cpdf11" >
					<input 	type="text" 
							name="address" 
							class="input_cpdf_number" 
							value="<?php echo get_company_info('address'); ?>" 
							maxlength=24
							placeholder="預設值：臺中市神岡區豐洲里神洲路330巷33弄71號"
							required="required">
				</td>
				<td class="td_cpdf12">
				</td>
			</tr>
		</table>
			<div style="height: 5%; width: 100%; text-align: center ;"> 			
				
			</div>
			
			<div style="height: 20%; width: 50%; text-align: center ; float:left;"> 			
				<button type=button 
						class = 'btn_submit' 
						onclick="location.href='outputpdf.php?<?php echo "action_choose=".$_REQUEST['action_choose']."&qu_id=".$_REQUEST['qu_id']; ?>'"
						name=company_setting >
							回到<br>輸出PDF頁面
				</button>
			</div>
			<div style="height: 20%; width: 50%; text-align: center ; float:left;">
				<button type=submit 
						class = 'btn_submit' 						
						name=save_company_info 
						value='submit'>
							儲存公司資料
				</button>
			</div>			
		</div>
		</section>
	</form>
</body>
</html>

	
		

<style type="text/css">
.table_cpdf{
	font-size:100%;
	width:100%;
	height:70%;

}
.thr_cpdf{
	font-size:60%;
	width:100%;
	height:10%; 
}
.tdr_cpdf1{
	font-size:100%;
	width:100%;
	height:20%; 
}
.tdr_cpdf2{
	font-size:100%;
	width:100%;
	height:60%; 
}
.th_cpdf{
	font-size:100%;
	padding-left:1%;
	padding-right:1%;

}
.td_cpdf10{
	padding-right:0.5%;
	font-size:40%;
	width:10%;
	color:#999;
	text-align:right ;
}
.td_cpdf11{
	font-size:100%;
	width:40%;
	border:1px solid #bbc;
}
.td_cpdf12{
	padding-right:0.5%;
	font-size:40%;
	width:10%;
	color:#999;
	text-align:left ;
}
.input_cpdf_number{
	
	font-size:100%;
	width:100%;
	height:100%; 
	border:0;
	color:red;
	text-align: center ;
}
</style>
