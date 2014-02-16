<?php echo $header; ?>
<h1>更新</h1>
<div id="column-right">
  <ul>
    <li><b>更新</b></li>
    <li>完成</li>
  </ul>
	<div style="text-align:center;margin-top:150px;border:#555555 1px solid;padding:10px 0;"><a href="http://www.dnono.com/" title="dnono" ><img src="view/image/dnono.png" alt="dnono" title="dnono" width="140" height="50" /></a><br /><br />
		<a href="http://www.dnono.com/" title="dnono" > 中文版提供者 </a>&nbsp;&nbsp;
		<a href="http://blog.dnono.com/" title="dnono" > 部落格 </a>
   </div>
</div>
<div id="content">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <p><b>請確實按照以下步驟進行版本更新</b></p>
    <ol>
		<li>如果有任何更新的問題請上論壇提出</li>
		<li>更新後，請先清除您的瀏覽器cookies資料以避免造成token錯誤</li>
		<li>在商店後台頁面，連續按下 Ctrl+F5 兩次確保載入的是新的css 樣式</li>
		<li>至商店後台管理者(Users)->管理者群組(User Groups)中編輯最高管理者群組權限(Top Adminstrator group)確定所有權限皆已勾選</li>
		<li>至商店後台編輯商店設定(System->Settings->edit)，然後儲存(如果沒有需要變更的資料也請執行此步驟)</li>
		<li>至商店前台頁面，連續按下 Ctrl+F5 兩次確保載入的是新的css 樣式</li>
    </ol>
    </fieldset>
    <div class="buttons">
	  <div class="right">
        <input type="submit" value="下一步" class="button" />
      </div>
	</div>
  </form>
</div>
<?php echo $footer; ?> 