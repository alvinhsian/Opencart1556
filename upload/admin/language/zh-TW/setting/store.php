<?php
// Heading
$_['heading_title']           = '商店設置(Settings)';

// Text
$_['text_success']            = '已成功修改商店的設置';
$_['text_items']                   = 'Items';
$_['text_tax']                     = 'Taxes';
$_['text_account']                 = 'Account';
$_['text_checkout']                = 'Checkout';
$_['text_stock']                   = 'Stock';
$_['text_image_manager']      = '圖像管理(Image Manager)';
$_['text_browse']            = '瀏覽';
$_['text_clear']             = '清除';
$_['text_shipping']            = '配送地址';
$_['text_payment']             = '付款地址';

// Column
$_['column_name']               = '商店名稱(Store Name)';
$_['column_url']	            = '商店網址(Store URL)';
$_['column_action']             = '動作(Action)';

// Entry
$_['entry_url']               = '商店網址(Store URL)<br /><span class="help">請輸入你商店的完整網址. 注意在最後加上 \'/\' . 例 http//www.yourdomain.com/path/</span>';
$_['entry_ssl']               = '使用SSL加密(Use SSL)<br /><span class="help">要使用SSL，你需要在主機安裝SSL及在設定檔內設定SSL地址(To use SSL check with your host if a SSL certificate is installed and added the SSL URL to the admin config file.)</span>';
$_['entry_name']              = '商店名稱(Store Name)';
$_['entry_owner']               = '商店負責人(Store Owner)';
$_['entry_address']             = '地址(Address)';
$_['entry_email']          = '電子郵件';
$_['entry_telephone']      = '聯繫電話';
$_['entry_fax']            = '傳真電話';
$_['entry_title']             = '首頁標題(Title)';
$_['entry_meta_description']  = 'SEO 關鍵內容(Meta Tag Description)';
$_['entry_layout']              = '預設規劃(Default Layout)';
$_['entry_template']          = '模板(Template)';
$_['entry_country']           = '國家(Country)';
$_['entry_zone']              = '地區(Region / State)';
$_['entry_language']          = '語言(Language)';
$_['entry_currency']          = '貨幣(Currency)';
$_['entry_catalog_limit'] 	  = '前台列表每頁商品顯示的數量(Default Items per Page (Catalog))<br /><span class="help">商品分類中每頁顯示多少商品(Determines how many catalog items are shown per page (products, categories, etc))</span>';
$_['entry_tax']               = '顯示含稅價格(Display Prices With Tax)';
$_['entry_tax_default']        = '使用商店當地稅率(Use Store Tax Address)<br /><span class="help">Use the store address to calculate taxes if no one is logged in. You can choose to use the store address for the customers shipping or payment address.</span>';
$_['entry_tax_customer']       = '使用會員當地稅率(Use Customer Tax Address)<br /><span class="help">Use the customers default address when they login to calculate taxes. You can choose to use the default address for the customers shipping or payment address.</span>';
$_['entry_customer_group']    = '預設會員群組(Customer Group)';
$_['entry_customer_group_display'] = '顯示會員群組(Customer Groups):<br /><span class="help">顯示會員群組,讓新會員在加入時可以選擇(Display customer groups that new customers can select to use such as wholesale and business when signing up.)</span>';
$_['entry_customer_price']    = '登入後才顯示價格(Login Display Prices)';
$_['entry_customer_approval'] = '加入會員是否需要審核(Approve New Customers)<br /><span class="help">新註冊會員是否需要審核後才能登入(Don\'t allow new customer to login until their account has been approved.)</span>';
$_['entry_guest_checkout']    = '來賓結帳(Guest Checkout)<br /><span class="help">允許未註冊會員直接結帳，此項交易不適用於可下載的產品(Allow customers to checkout without creating an account. This will not be available when a downloadable product is in the shopping cart.)</span>';
$_['entry_account']           = '註冊條款(Account Terms)';
$_['entry_checkout']          = '結帳條款(Checkout Terms)';
$_['entry_stock_display']     = '顯示庫存數量(Display Stock)';
$_['entry_stock_checkout']    = '預售(Stock Checkout)<br /><span class="help">沒有庫存，仍然允許結帳(Allow customers to still checkout if the products they are ordering are not in stock.)</span>';
$_['entry_order_status']      = '預設訂單狀態(Order Status)';
$_['entry_cart_weight']       = '購物車內顯示商品重量(Display Weight on Cart Page)';
$_['entry_logo']              = '商店LOGO(Store Logo)';
$_['entry_icon']              = '網頁favicon圖(Icon)<br /><span class="help">必須為PNG格式尺寸為16px X 16px (The icon should be a PNG that is 16px x 16px.)</span>';
$_['entry_image_thumb']       = '商品圖尺寸(Product Image Thumb Size)';
$_['entry_image_popup']       = '商品放大圖尺寸(Product Image Popup Size)';
$_['entry_image_product']     = '商品列表時尺寸(Product List Size)';
$_['entry_image_category']    = '目錄圖尺寸(Category List Size)';
$_['entry_image_additional']  = '商品附加圖尺寸(Additional Product Image Size)';
$_['entry_image_related']     = '關聯商品圖尺寸(Related Product Image Size)';
$_['entry_image_compare']       = '商品比較圖尺寸(Compare Image Size)';
$_['entry_image_wishlist']      = '商品備忘簿列表尺寸(Wish List Image Size)';
$_['entry_image_cart']        = '購物車內商品圖尺寸(Cart Image Size)';
$_['entry_secure']             = '使用SSL憑證(Use SSL)<br /><span class="help">請安裝SSL憑證在你的主機上才能使用SSL(To use SSL check with your host if a SSL certificate is installed).</span>';

// Error
$_['error_warning']             = '發生錯誤，請再確認';
$_['error_permission']           = '您沒有權限更改商店設置';
$_['error_name']                 = '商店名稱必須在3至32個字元之間';
$_['error_owner']               = '商店負責人名稱必須在3到64個字元之間';
$_['error_address']             = '商店地址必須在10到256個字元之間';
$_['error_email']               = 'E-Mail錯誤';
$_['error_telephone']           = '電話必須在3到32個字元之間';
$_['error_url']                  = '商店網址無效';
$_['error_title']                = '首頁標題必須在3到32個數字之間';
$_['error_limit']                = '限制請求';
$_['error_image_thumb']          = '請輸入商品預覽圖片尺寸';
$_['error_image_popup']          = '請輸入商品放大圖片尺寸';
$_['error_image_product']        = '請輸入商品頁面中的圖片尺寸';
$_['error_image_category']       = '請輸入商品分類中的圖片尺寸';
$_['error_customer_group_display'] = '必須有預設的會員群組!';
$_['error_image_additional']     = '請輸入附加商品圖像尺寸';
$_['error_image_related']        = '請輸入關聯商品圖像尺寸';
$_['error_image_compare']       = '請輸入商品比較圖尺寸';
$_['error_image_wishlist']      = '請輸入商品備忘簿中圖片尺寸';
$_['error_image_cart']           = '請輸入購物車中的商品圖像尺寸';
$_['error_default']             = '不能刪除預設的商店';
$_['error_store']             = '商店無法刪除，因為已經有 %s 筆訂單';
?>