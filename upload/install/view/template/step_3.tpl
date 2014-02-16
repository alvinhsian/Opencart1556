<?php echo $header; ?>
<h1>步驟 3 - 配置</h1>
<div id="column-right">
  <ul>
    <li>授權</li>
    <li>系統</li>
    <li><b>配置</b></li>
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
    <p>1. 請輸入您的資料庫資料<span style="color:#ADADAD;">(如尚未建立，請先建立資料庫後再安裝)</span></p>
    <fieldset>
      <table class="form">
        <tr>
          <td>資料庫程式:</td>
          <td><select name="db_driver">
              <option value="mysqli">MySQLi</option>
              <option value="mysql">MySQL</option>
            </select>
            <br />
            <?php if ($error_db_driver) { ?>
            <span class="required"><?php echo $error_db_driver; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> 主機:</td>
          <td><input type="text" name="db_host" value="<?php echo $db_host; ?>" />
            <br />
            <?php if ($error_db_host) { ?>
            <span class="required"><?php echo $error_db_host; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> 使用者名稱:</td>
          <td><input type="text" name="db_user" value="<?php echo $db_user; ?>" />
            <br />
            <?php if ($error_db_user) { ?>
            <span class="required"><?php echo $error_db_user; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td>密碼:</td>
          <td><input type="text" name="db_password" value="<?php echo $db_password; ?>" /></td>
        </tr>
        <tr>
          <td><span class="required">*</span> 資料庫名稱:</td>
          <td><input type="text" name="db_name" value="<?php echo $db_name; ?>" />
            <br />
            <?php if ($error_db_name) { ?>
            <span class="required"><?php echo $error_db_name; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td>資料庫前綴詞:</td>
          <td><input type="text" name="db_prefix" value="<?php echo $db_prefix; ?>" />
            <br />
            <?php if ($error_db_prefix) { ?>
            <span class="required"><?php echo $error_db_prefix; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </fieldset>
    <p>2. 請設定您的商店後台管理員帳號資料</p>
    <fieldset>
      <table class="form">
        <tr>
          <td><span class="required">*</span> 帳號:</td>
          <td><input type="text" name="username" value="<?php echo $username; ?>" />
            <br />
            <?php if ($error_username) { ?>
            <span class="required"><?php echo $error_username; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> 密碼:</td>
          <td><input type="text" name="password" value="<?php echo $password; ?>" />
            <br />
            <?php if ($error_password) { ?>
            <span class="required"><?php echo $error_password; ?></span>
            <?php } ?></td>
        </tr>
        <tr>
          <td><span class="required">*</span> 電子郵件:</td>
          <td><input type="text" name="email" value="<?php echo $email; ?>" />
            <br />
            <?php if ($error_email) { ?>
            <span class="required"><?php echo $error_email; ?></span>
            <?php } ?></td>
        </tr>
      </table>
    </fieldset>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button">回上一步</a></div>
      <div class="right">
        <input type="submit" value="下一步" class="button" />
      </div>
    </div>
  </form>
</div>
<?php echo $footer; ?>