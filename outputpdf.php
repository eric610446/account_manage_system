<?php
	//必須要有ob_start(); 不然後面用ob_end_clean();會變成空白畫面
	ob_start();
	include 'functions.php' ;
	include 'style.php' ;
?>
<html>
<head><title>PDF</title></head>

<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<section>
		<div style="text-align: center ;">
		<input type="hidden" name="action_choose" value="<?php echo $_GET["action_choose"];?>">
		<input type="hidden" name="qu_id" value="<?php echo $_GET["qu_id"];?>">
		
		<table class="table_cpdf">
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=4>
					營業稅設定：(單位為百分之一)
				</th>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">
				</td>
				<td class="td_cpdf11" >
					<input type="number" name="sales_tax_number" class="input_cpdf_number" value=5.0 step=0.1>
				</td>
				<td class="td_cpdf12">
					%
				</td>
				<td class="td_cpdf10">
				</td>
			</tr>
			<tr class="thr_cpdf">
				<th class="th_cpdf" COLSPAN=4>
					備註撰寫：
				</th>
			</tr>
			<tr class="tdr_cpdf2">
				<td class="td_cpdf2" COLSPAN=4>
					<textarea name="other_memo" placeholder="備註請撰寫在此處 (建議文字、特殊符號、標點符號合計不要超過九十三字，超過可能會造成排版混亂)" class="ta_cpdf"></textarea>
				</td>
			</tr>
			<tr class="tdr_cpdf1">
				<td class="td_cpdf10">(輸入過大值易造成排版混亂，建議在排版混亂時再調整縮小)
				</td>
				<td class="td_cpdf11" >
					<input type="number" name="paper_break" class="input_cpdf_number" value=10 step=1>
				</td>
				<td class="td_cpdf12"  COLSPAN=2>
				筆資料自動換頁
				</td>
			</tr>
		</table>
			<div style="height: 10%; width: 80%; text-align: center ;"> 
			</div>

			<div style="height: 20%; width: 100%; text-align: center ;"> 
				<button type=submit class = 'btn_submit btn_create_pdf' name=view_pdf >直接預覽</button>
			</div>
			<div style="height: 20%; width: 100%; text-align: center ;">
				<button type=submit class = 'btn_submit btn_create_pdf' name=save_pdf >下載</button>
			</div>
			
			<?php
			
			/*
			// new font ，第一次加入 ttf 字型到 tcpdf 
			// 刪除本區的前後註解跑一次輸出網頁，再回到這個網頁加回註解
			// (可能會有錯誤訊息，fatal error:SetFont()之類的，理論上應該是可以忽視不理)
			require_once('tcpdf/config/tcpdf_config.php') ;
			require_once('tcpdf/tcpdf.php') ;
			$fontname=TCPDF_FONTS::addTTFfont('tcpdf/fonts/big5/kaiu.ttf', 'TrueTypeUnicode'); //DroidSansFallback kaiu.ttf
			$pdf->SetFont('kaiu', '', 12, true);
			define ('PDF_FONT_NAME_MAIN', 'kaiu');
			*/

			
				$action_choose = $_POST['action_choose'] ;
				$qu_id = $_POST['qu_id'] ;
				
				if(isset($_POST['view_pdf'])) { //view_pdf > $view_or_save =1
					create_quo_pdf($action_choose,$qu_id,1) ;
				}	
				if(isset($_POST['save_pdf'])) {	//save_pdf > $view_or_save =2
					create_quo_pdf($action_choose,$qu_id,2) ;
				}
				
			?>
			
		</div>
		</section>
	</form>
</body>
</html>

<style type="text/css">
.table_cpdf{
	font-size:100%;
	width:100%;
	height:50%;
	border:1px solid #fff;
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
	border:1px solid #fff;
}
.td_cpdf10{
	font-size:50%;
	width:40%;
	color:#aaa;
	text-align:right ;
}
.td_cpdf11{
	font-size:100%;
	width:10%;
	border:1px solid #000;
}
.td_cpdf12{
	font-size:100%;
	width:10%;
	text-align:left ;
}
.td_cpdf2{
	padding-left:5%;
	padding-right:5%;
	font-size:100%;
	width:100%;
}
.ta_cpdf{
	font-size:100%;
	width:100%;
	height:100%; 
	border:1px solid #000;
	
}
.input_cpdf_number{
	font-size:100%;
	width:100%;
	height:100%; 
	border:0;
	color:red;
	text-align:right ;
}
</style>
