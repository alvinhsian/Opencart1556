<?php
class ControllerStep2 extends Controller {
	private $error = array();
	
	public function index() {
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->redirect($this->url->link('step_3'));
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';	
		}
		
		$this->data['action'] = $this->url->link('step_2');

		$this->data['config_catalog'] = DIR_OPENCART . 'config.php';
		$this->data['config_admin'] = DIR_OPENCART . 'admin/config.php';
		
		$this->data['cache'] = DIR_SYSTEM . 'cache';
		$this->data['logs'] = DIR_SYSTEM . 'logs';
		$this->data['image'] = DIR_OPENCART . 'image';
		$this->data['image_cache'] = DIR_OPENCART . 'image/cache';
		$this->data['image_data'] = DIR_OPENCART . 'image/data';
		$this->data['download'] = DIR_OPENCART . 'download';
		
		$this->data['back'] = $this->url->link('step_1');
		
		$this->template = 'step_2.tpl';
		$this->children = array(
			'header',
			'footer'
		);		
		
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (phpversion() < '5.0') {
			$this->error['warning'] = '您需要使用PHP5 或 以上的版本才能正常使用OpenCart!';
		}

		if (!ini_get('file_uploads')) {
			$this->error['warning'] = '必須開啟 file_uploads 功能!';
		}
	
		if (ini_get('session.auto_start')) {
			$this->error['warning'] = '請關閉session.auto_start 否則OpenCart 無法正常工作!';
		}
		
		if (!extension_loaded('mysql')) {
			$this->error['warning'] = '必須載入 MySQL extension !';
		}
				
		if (!extension_loaded('gd')) {
			$this->error['warning'] = '必須載入 GD extension !';
		}

		if (!extension_loaded('curl')) {
			$this->error['warning'] = '必須載入 CURL extension !';
		}

		if (!function_exists('mcrypt_encrypt')) {
			$this->error['warning'] = '必須載入 mCrypt extension !';
		}
				
		if (!extension_loaded('zlib')) {
			$this->error['warning'] = '必須載入 ZLIB extension !';
		}
		
		if (!file_exists(DIR_OPENCART . 'config.php')) {
			$this->error['warning'] = 'config.php檔案未找到! (您需要先將檔案 config-dist.php 更名成 config.php)';
		} elseif (!is_writable(DIR_OPENCART . 'config.php')) {
			$this->error['warning'] = '警告: config.php 檔案必須可讀寫才能安裝!';
		}
		
		if (!file_exists(DIR_OPENCART . 'admin/config.php')) {
			$this->error['warning'] = 'admin/config.php檔案未找到! (您需要先將admin目錄下的檔案config-dist.php 更名成 config.php)';
		} elseif (!is_writable(DIR_OPENCART . 'admin/config.php')) {
			$this->error['warning'] = '警告: admin/config.php 檔案必須可讀寫才能安裝!';
		}

		if (!is_writable(DIR_SYSTEM . 'cache')) {
			$this->error['warning'] = 'Cache 目錄必須設定成可讀寫才能安裝!';
		}
		
		if (!is_writable(DIR_SYSTEM . 'logs')) {
			$this->error['warning'] = 'Logs 目錄必須設定成可讀寫才能安裝!';
		}
		
		if (!is_writable(DIR_OPENCART . 'image')) {
			$this->error['warning'] = 'Image 目錄必須設定成可讀寫才能安裝!';
		}

		if (!is_writable(DIR_OPENCART . 'image/cache')) {
			$this->error['warning'] = 'Image/cache 目錄必須設定成可讀寫才能安裝!';
		}
		
		if (!is_writable(DIR_OPENCART . 'image/data')) {
			$this->error['warning'] = 'Image/data 目錄必須設定成可讀寫才能安裝!';
		}
		
		if (!is_writable(DIR_OPENCART . 'download')) {
			$this->error['warning'] = 'Download 目錄必須設定成可讀寫才能安裝!';
		}
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
?>