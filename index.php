
<?php
	include 'config.php' ;
	include 'functions.php' ;
	include 'style.php' ;

?>

<html>
<head><title><?php echo $header_context; ?></title></head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<header>
		<?php echo $header_context; ?>
	</header>

<aside class='Aside_Style_1'>

	<div class='Main_aside_Style_1 Main_aside'>
	
		<div class='div_Main_aside'>
			<button type=button 
					class='btn_main btn_main_disable'
					onclick="location.href='index2.php?main_choose=1'">
						建立<br>報價單
			</button>
		</div>
	
		<div class='div_Main_aside'>
			<button type=button 
					class='btn_main btn_main_disable'
					onclick="location.href='index2.php?main_choose=2'">
						查詢<br>報價單
			</button>
		</div>

			
		<div class='div_Main_aside'>
			<button type=button 
					class='btn_main btn_main_disable'
					onclick="location.href='index2.php?main_choose=3'">
						查詢<br>成交訂單
			</button>
		</div>

		<div class='div_Main_aside'>
			<button type=button
					onclick=window.open('./settings/index.php')
					class='btn_main btn_main_disable' >
					設定<br>資料
			</button>
		</div>
	</div>
</aside>

	<?php
	//尚未動作時 article 寬度為90%
	if($action_choose<1)
		echo "<article class='article_Style_1'>";
	//有按下主選單按鈕後 article 寬度為80%
	else
		echo "<article class='article_Style_2'>";
	echo "<section>";
	
		echo "<div class ='srch_docun srch_docun_Style_index'>";
			echo "<table class='table_srch_docun'>";
			
				echo "<tr>";
				echo "<th class='th_srch_docun'>按鈕名稱";
				echo "</th>";
				echo "<th class='th_srch_docun'>功能說明";
				echo "</th>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun_index'>";
				echo "<td class='td_srch_docun'>建立報價單";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						選擇客戶來創建一筆<b>全新的報價單</b>。";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun_index'>";
				echo "<td class='td_srch_docun'>查詢報價單";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						依照客戶或流水碼來列出所有<b>尚未交易完成</b>的<b>一般報價單</b>，<br>
						可在此查詢詳細報價單內容、客戶以及物品供應商資料，<br>
						並可以在完成交易後把<b>一般報價單</b>設定為<b>已為成訂單</b>。";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun_index'>";
				echo "<td class='td_srch_docun'>查詢訂單";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						依照客戶或流水碼來列出所有<b>已經交易完成的訂單</b>，<br>
						可在此查詢詳細訂單內容、客戶以及物品供應商資料，<br>
						並可以在取消交易或者要繼續修改報價時，把<b>已完成訂單</b>恢復為<b>一般報價單</b>。";
				echo "</td>";
				echo "</tr>";
				
				echo "<tr class='tr_srch_docun_index'>";
				echo "<td class='td_srch_docun'>設定資料";
				echo "</td>";
				echo "<td class='td_srch_docun'>
						列出有<b>".$content_qorp."</b>紀錄的月份，<br>
						選擇月份後，列出該月所有<b>".$content_qorp."</b>。";
				echo "</td>";
				echo "</tr>";
				
			echo "</table>";
		echo "</div>";
	
	?>
	
	</section>
	</article>
	<footer>
			<?php echo $footer_context; ?>
	</footer>
</form>
</body>
</html>

