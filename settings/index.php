<html>

<head>
	<title>設定頁面</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
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
		</div>
		<div id="right">
		</div>
		<content id='info'>
			<table>
			<th>設定說明</th>
			<tr><td>
				<ol>建立時，請留意是否有重複名稱存在的資料，系統將會提醒您此項目已建立。</ol>
				<ol>修改可以使用項目名稱搜尋，可搜尋部分關鍵字，在提醒使用者該項目名稱不存在後，會在右側欄顯示類似項目名稱的提示。</ol>
				<ol>查詢功能可檢視所有已建立的項目。</ol>
				<ol>請勿在沒有工程師協助的環境下，直接到後端 SQL 資料庫修改內容。</ol>
			</td></tr>
			</table>
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