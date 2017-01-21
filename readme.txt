== Description ==
　　此為管理報價單以及最終成交訂單的商業管理系統。

== Installation ==
	※SQL 帳號密碼存放在以下文件中
		/function.php
		/settings/initialize.php

	※賣方的設定資料並沒有建立頁面
	　必須手動在資料庫中的 Company_db 中加入資料
	　另外，請將 Company_id 設定為 0
		
	※若未經設定，初次輸出PDF必會失敗，請至 /outputpdf.php 中，將68行跟77行的註解( /* 以及 */ )去除，
	　重新整理一次輸出PDF的頁面後，回到/outputpdf.php 中，將68行跟77行的註解( /* 以及 */ )補回去，
	  即可正常輸出PDF報價單以及訂單。



※　此系統由　　開發