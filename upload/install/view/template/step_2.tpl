<?php echo $header; ?>
<h1>步驟 2 - 系統</h1>
<div id="column-right">
  <ul>
    <li>授權</li>
    <li><b>系統</b></li>
    <li>配置</li>
    <li>完成</li>
  </ul>
	<div style="text-align:center;margin-top:150px;border:#555555 1px solid;padding:10px 0;"><a href="http://www.dnono.com/" title="dnono" ><img src="view/image/dnono.png" alt="dnono" title="dnono" width="140" height="50" /></a><br /><br />
<a href="http://www.dnono.com/" title="dnono" > 中文版提供者</a>&nbsp;&nbsp;
<a href="http://blog.dnono.com/" title="dnono" > 部落格 </a>
   </div>
</div>
<div id="content">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <p>1. 請調整你的PHP設置，符合下列要求<span style="color:#ADADAD;">(如有疑問，可請您的主機商協助確認)</span></p>
    <fieldset>
      <table>
        <tr>
          <th width="35%" align="left"><b>PHP設定</b></th>
          <th width="25%" align="left"><b>目前設定</b></th>
          <th width="25%" align="left"><b>系統要求</b></th>
          <th width="15%" align="center"><b>狀態</b></th>
        </tr>
        <tr>
          <td>PHP 版本:</td>
          <td><?php echo phpversion(); ?></td>
          <td>5.0+</td>
          <td align="center"><?php echo (phpversion() >= '5.0') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>Register Globals:</td>
          <td><?php echo (ini_get('register_globals')) ? 'On' : 'Off'; ?></td>
          <td>Off</td>
          <td align="center"><?php echo (!ini_get('register_globals')) ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>Magic Quotes GPC:</td>
          <td><?php echo (ini_get('magic_quotes_gpc')) ? 'On' : 'Off'; ?></td>
          <td>Off</td>
          <td align="center"><?php echo (!ini_get('magic_quotes_gpc')) ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>File Uploads:</td>
          <td><?php echo (ini_get('file_uploads')) ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo (ini_get('file_uploads')) ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>Session Auto Start:</td>
          <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
          <td>Off</td>
          <td align="center"><?php echo (!ini_get('session_auto_start')) ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
      </table>
    </fieldset>
    <p>2. 請確定下列PHP擴充模組已安裝<span style="color:#ADADAD;">(如有疑問，可請您的主機商協助確認)</span></p>
    <fieldset>
      <table>
        <tr>
          <th width="35%" align="left"><b>模組名稱</b></th>
          <th width="25%" align="left"><b>目前設定</b></th>
          <th width="25%" align="left"><b>系統要求</b></th>
          <th width="15%" align="center"><b>狀態</b></th>
        </tr>
        <tr>
          <td>MySQL:</td>
          <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo extension_loaded('mysql') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>GD:</td>
          <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo extension_loaded('gd') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>cURL:</td>
          <td><?php echo extension_loaded('curl') ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo extension_loaded('curl') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>mCrypt:</td>
          <td><?php echo function_exists('mcrypt_encrypt') ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo function_exists('mcrypt_encrypt') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
        <tr>
          <td>ZIP:</td>
          <td><?php echo extension_loaded('zlib') ? 'On' : 'Off'; ?></td>
          <td>On</td>
          <td align="center"><?php echo extension_loaded('zlib') ? '<img src="view/image/good.png" alt="Good" />' : '<img src="view/image/bad.png" alt="Bad" />'; ?></td>
        </tr>
      </table>
    </fieldset>
    <p>3. 請確定下列檔案已設定為可寫入的檔案權限<span style="color:#ADADAD;">(請先確定已將下列文件夾內的config-dist.php檔案更名為config.php)</span></p>
    <fieldset>
      <table>
        <tr>
          <th align="left"><b>檔案</b></th>
          <th align="left"><b>狀態</b></th>
        </tr>
        <tr>
          <td><?php echo $config_catalog; ?></td>
          <td><?php if (!file_exists($config_catalog)) { ?>
            <span class="bad">檔案遺失</span>
            <?php } elseif (!is_writable($config_catalog)) { ?>
            <span class="bad">不能寫入</span>
          <?php } else { ?>
          <span class="good">可寫入</span>
          <?php } ?>
            </td>
        </tr>
        <tr>
          <td><?php echo $config_admin; ?></td>
          <td><?php if (!file_exists($config_admin)) { ?>
            <span class="bad">檔案遺失</span>
            <?php } elseif (!is_writable($config_admin)) { ?>
            <span class="bad">不能寫入</span>
          <?php } else { ?>
          <span class="good">可寫入</span>
          <?php } ?>
             </td>
        </tr>
      </table>
    </fieldset>
    <p>4. 請確定下列文件夾已設定為可寫入的檔案權限</p>
    <fieldset>
      <table>
        <tr>
          <th align="left"><b>文件夾</b></th>
          <th align="left"><b>狀態</b></th>
        </tr>
        <tr>
          <td><?php echo $cache . '/'; ?></td>
          <td><?php echo is_writable($cache) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
        </tr>
        <tr>
          <td><?php echo $logs . '/'; ?></td>
          <td><?php echo is_writable($logs) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
        </tr>
        <tr>
          <td><?php echo $image . '/'; ?></td>
          <td><?php echo is_writable($image) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
        </tr>
        <tr>
          <td><?php echo $image_cache . '/'; ?></td>
          <td><?php echo is_writable($image_cache) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
        </tr>
        <tr>
          <td><?php echo $image_data . '/'; ?></td>
          <td><?php echo is_writable($image_data) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
        </tr>
        <tr>
          <td><?php echo $download . '/'; ?></td>
          <td><?php echo is_writable($download) ? '<span class="good">可寫入</span>' : '<span class="bad">不能寫入</span>'; ?></td>
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
