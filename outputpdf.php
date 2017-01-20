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
	
		<input type="hidden" name="action_choose" value="<?php echo $_GET["action_choose"];?>">
		<input type="hidden" name="qu_id" value="<?php echo $_GET["qu_id"];?>">
		
		<div class='quo_option set_float_right'>
			<button type=submit class = 'btn_submit' name=view_pdf >直接預覽</button>
		</div>
		<div class='quo_option set_float_right'>
			<button type=submit class = 'btn_submit' name=save_pdf >下載</button>
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
	</form>
</body>
</html>

