<?php
class ControllerStep3 extends Controller {
	private $error = array();
	
	public function index() {		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('install');
			
			$this->model_install->database($this->request->post);
			
			$output  = '<?php' . "\n";
			$output .= '// HTTP' . "\n";
			$output .= 'define(\'HTTP_SERVER\', \'' . HTTP_OPENCART . '\');' . "\n\n";
			
			$output .= '// HTTPS' . "\n";
			$output .= 'define(\'HTTPS_SERVER\', \'' . HTTP_OPENCART . '\');' . "\n\n";
									
			$output .= '// DIR' . "\n";
			$output .= 'define(\'DIR_APPLICATION\', \'' . DIR_OPENCART . 'catalog/\');' . "\n";
			$output .= 'define(\'DIR_SYSTEM\', \'' . DIR_OPENCART. 'system/\');' . "\n";
			$output .= 'define(\'DIR_DATABASE\', \'' . DIR_OPENCART . 'system/database/\');' . "\n";
			$output .= 'define(\'DIR_LANGUAGE\', \'' . DIR_OPENCART . 'catalog/language/\');' . "\n";
			$output .= 'define(\'DIR_TEMPLATE\', \'' . DIR_OPENCART . 'catalog/view/theme/\');' . "\n";
			$output .= 'define(\'DIR_CONFIG\', \'' . DIR_OPENCART . 'system/config/\');' . "\n";
			$output .= 'define(\'DIR_IMAGE\', \'' . DIR_OPENCART . 'image/\');' . "\n";
			$output .= 'define(\'DIR_CACHE\', \'' . DIR_OPENCART . 'system/cache/\');' . "\n";
			$output .= 'define(\'DIR_DOWNLOAD\', \'' . DIR_OPENCART . 'download/\');' . "\n";
			$output .= 'define(\'DIR_LOGS\', \'' . DIR_OPENCART . 'system/logs/\');' . "\n\n";
		
			$output .= '// DB' . "\n";
			$output .= 'define(\'DB_DRIVER\', \'' . addslashes($this->request->post['db_driver']) . '\');' . "\n";
			$output .= 'define(\'DB_HOSTNAME\', \'' . addslashes($this->request->post['db_host']) . '\');' . "\n";
			$output .= 'define(\'DB_USERNAME\', \'' . addslashes($this->request->post['db_user']) . '\');' . "\n";
			$output .= 'define(\'DB_PASSWORD\', \'' . addslashes($this->request->post['db_password']) . '\');' . "\n";
			$output .= 'define(\'DB_DATABASE\', \'' . addslashes($this->request->post['db_name']) . '\');' . "\n";
			$output .= 'define(\'DB_PREFIX\', \'' . addslashes($this->request->post['db_prefix']) . '\');' . "\n";
			$output .= '?>';				
		
			$file = fopen(DIR_OPENCART . 'config.php', 'w');
		
			fwrite($file, $output);

			fclose($file);
	 
			$output  = '<?php' . "\n";
			$output .= '// HTTP' . "\n";
			$output .= 'define(\'HTTP_SERVER\', \'' . HTTP_OPENCART . 'admin/\');' . "\n";
			$output .= 'define(\'HTTP_CATALOG\', \'' . HTTP_OPENCART . '\');' . "\n\n";
			
			$output .= '// HTTPS' . "\n";
			$output .= 'define(\'HTTPS_SERVER\', \'' . HTTP_OPENCART . 'admin/\');' . "\n";
			$output .= 'define(\'HTTPS_CATALOG\', \'' . HTTP_OPENCART . '\');' . "\n\n";
			
			$output .= '// DIR' . "\n";
			$output .= 'define(\'DIR_APPLICATION\', \'' . DIR_OPENCART . 'admin/\');' . "\n";
			$output .= 'define(\'DIR_SYSTEM\', \'' . DIR_OPENCART . 'system/\');' . "\n";
			$output .= 'define(\'DIR_DATABASE\', \'' . DIR_OPENCART . 'system/database/\');' . "\n";
			$output .= 'define(\'DIR_LANGUAGE\', \'' . DIR_OPENCART . 'admin/language/\');' . "\n";
			$output .= 'define(\'DIR_TEMPLATE\', \'' . DIR_OPENCART . 'admin/view/template/\');' . "\n";
			$output .= 'define(\'DIR_CONFIG\', \'' . DIR_OPENCART . 'system/config/\');' . "\n";
			$output .= 'define(\'DIR_IMAGE\', \'' . DIR_OPENCART . 'image/\');' . "\n";
			$output .= 'define(\'DIR_CACHE\', \'' . DIR_OPENCART . 'system/cache/\');' . "\n";
			$output .= 'define(\'DIR_DOWNLOAD\', \'' . DIR_OPENCART . 'download/\');' . "\n";
			$output .= 'define(\'DIR_LOGS\', \'' . DIR_OPENCART . 'system/logs/\');' . "\n";
			$output .= 'define(\'DIR_CATALOG\', \'' . DIR_OPENCART . 'catalog/\');' . "\n\n";
			$output .= 'define(\'DNONO_SUPPORT\', \'中文支援(Dnono.com)\');' . "\n";
			$output .= 'define(\'DNONO\', \'中文版本提供\');' . "\n\n";
			
			$output .= '// DB' . "\n";
			$output .= 'define(\'DB_DRIVER\', \'' . addslashes($this->request->post['db_driver']) . '\');' . "\n";
			$output .= 'define(\'DB_HOSTNAME\', \'' . addslashes($this->request->post['db_host']) . '\');' . "\n";
			$output .= 'define(\'DB_USERNAME\', \'' . addslashes($this->request->post['db_user']) . '\');' . "\n";
			$output .= 'define(\'DB_PASSWORD\', \'' . addslashes($this->request->post['db_password']) . '\');' . "\n";
			$output .= 'define(\'DB_DATABASE\', \'' . addslashes($this->request->post['db_name']) . '\');' . "\n";
			$output .= 'define(\'DB_PREFIX\', \'' . addslashes($this->request->post['db_prefix']) . '\');' . "\n";
			$output .= '?>';	

			$file = fopen(DIR_OPENCART . 'admin/config.php', 'w');
		
			fwrite($file, $output);

			fclose($file);
			
			$this->redirect($this->url->link('step_4'));
		}
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
        
		if (isset($this->error['db_driver'])) {
			$this->data['error_db_driver'] = $this->error['db_driver'];
		} else {
			$this->data['error_db_driver'] = '';
		}

		if (isset($this->error['db_host'])) {
			$this->data['error_db_host'] = $this->error['db_host'];
		} else {
			$this->data['error_db_host'] = '';
		}
		
		if (isset($this->error['db_user'])) {
			$this->data['error_db_user'] = $this->error['db_user'];
		} else {
			$this->data['error_db_user'] = '';
		}
		
		if (isset($this->error['db_name'])) {
			$this->data['error_db_name'] = $this->error['db_name'];
		} else {
			$this->data['error_db_name'] = '';
		}
		
		if (isset($this->error['db_prefix'])) {
			$this->data['error_db_prefix'] = $this->error['db_prefix'];
		} else {
			$this->data['error_db_prefix'] = '';
		}
		
		if (isset($this->error['username'])) {
			$this->data['error_username'] = $this->error['username'];
		} else {
			$this->data['error_username'] = '';
		}
		
		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}		
		
		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}	
		
		$this->data['action'] = $this->url->link('step_3');
		
		if (isset($this->request->post['db_driver'])) {
			$this->data['db_driver'] = $this->request->post['db_driver'];
		} else {
			$this->data['db_driver'] = 'mysqli';
		}
		
		if (isset($this->request->post['db_host'])) {
			$this->data['db_host'] = $this->request->post['db_host'];
		} else {
			$this->data['db_host'] = 'localhost';
		}
		
		if (isset($this->request->post['db_user'])) {
			$this->data['db_user'] = html_entity_decode($this->request->post['db_user']);
		} else {
			$this->data['db_user'] = '';
		}
		
		if (isset($this->request->post['db_password'])) {
			$this->data['db_password'] = html_entity_decode($this->request->post['db_password']);
		} else {
			$this->data['db_password'] = '';
		}

		if (isset($this->request->post['db_name'])) {
			$this->data['db_name'] = html_entity_decode($this->request->post['db_name']);
		} else {
			$this->data['db_name'] = '';
		}
		
		if (isset($this->request->post['db_prefix'])) {
			$this->data['db_prefix'] = html_entity_decode($this->request->post['db_prefix']);
		} else {
			$this->data['db_prefix'] = 'oc_';
		}
		
		if (isset($this->request->post['username'])) {
			$this->data['username'] = $this->request->post['username'];
		} else {
			$this->data['username'] = 'admin';
		}

		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = '';
		}
		
		$this->data['back'] = $this->url->link('step_2');
		
		$this->template = 'step_3.tpl';
		$this->children = array(
			'header',
			'footer'
		);
		
		$this->response->setOutput($this->render());		
	}
	
	private function validate() {
		if (!$this->request->post['db_host']) {
			$this->error['db_host'] = '請輸入主機名稱!';
		}

		if (!$this->request->post['db_user']) {
			$this->error['db_user'] = '請輸入資料庫使用者名稱!';
		}

		if (!$this->request->post['db_name']) {
			$this->error['db_name'] = '請輸入資料庫名稱!';
		}
		
		if ($this->request->post['db_prefix'] && preg_match('/[^a-z0-9_]/', $this->request->post['db_prefix'])) {
			$this->error['db_prefix'] = '資料庫前綴詞僅能使用小寫英文字母或阿拉伯數字以及"_"符號!';
		}
				
		if ($this->request->post['db_driver'] == 'mysql') {
			if(function_exists('mysql_connect')) {
                if (!$connection = @mysql_connect($this->request->post['db_host'], $this->request->post['db_user'], $this->request->post['db_password'])) {
                    $this->error['warning'] = '錯誤: 不能與資料庫連線 , 請確定主機名稱,使用者名稱和密碼是正確的!';
                } else {
                    if (!@mysql_select_db($this->request->post['db_name'], $connection)) {
                        $this->error['warning'] = '錯誤: 該資料庫尚未建立!';
                    }
                    
                    mysql_close($connection);
                }
			} else {
				$this->error['db_driver'] = '您的主機不支援 MySQL 資料庫! 請嘗試選擇 MySQLi 資料庫';
			}
		}
        
		if ($this->request->post['db_driver'] == 'mysqli') {
			if(function_exists('mysqli_connect')) {
				$connection = new mysqli($this->request->post['db_host'], $this->request->post['db_user'], $this->request->post['db_password'], $this->request->post['db_name']);

				if (mysqli_connect_error()) {
                    $this->error['warning'] = '錯誤: 不能與資料庫連線 , 請確定主機名稱,使用者名稱和密碼是正確的!';
				} else {
					$connection->close();
				}
			} else {
				$this->error['db_driver'] = '您的主機不支援 MySQLi 資料庫! 請嘗試選擇 MySQL 資料庫';
			}
		}
				
		if (!$this->request->post['username']) {
			$this->error['username'] = '請輸入使用者名稱!';
		}

		if (!$this->request->post['password']) {
			$this->error['password'] = '請輸入密碼!';
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			$this->error['email'] = '電子郵件錯誤!';
		}
		
		if (!is_writable(DIR_OPENCART . 'config.php')) {
			$this->error['warning'] = '錯誤: 不能寫入 config.php 請確定' . DIR_OPENCART . 'config.php 已設置了正確的讀寫權限!';
		}
	
		if (!is_writable(DIR_OPENCART . 'admin/config.php')) {
			$this->error['warning'] = '錯誤: 不能寫入 config.php 請確定' . DIR_OPENCART . 'admin/config.php 已設置了正確的讀寫權限!';
		}	
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}		
	}
}
?>
