<?php
// Heading
$_['heading_title']    = '會員群組(Customer Group)';

// Text
$_['text_success']     = '已成功修改會員群組的設置';

// Column
$_['column_name']      = '群組名稱(Customer Group Name)';
$_['column_sort_order']         = '排序(Sort Order)';
$_['column_action']    = '動作(Action)';

// Entry
$_['entry_name']       = '群組名稱(Customer Group Name)';
$_['entry_description']         = '內容:';
$_['entry_approval']			= '加入會員是否需要審核(Approve New Customers)<br /><span class="help">新註冊會員是否需要審核後才能登入(Don\'t allow new customer to login until their account has been approved.)</span>';
$_['entry_company_id_display']  = '是否顯示統一編號(Display Company No.):<br /><span class="help">會員資料中出現統一編號欄位</span>';
$_['entry_company_id_required'] = '統一編號是否為必填欄位(Company No. Required):<br /><span class="help">會員必須填入統一編號才能結帳</span>';
$_['entry_tax_id_display']      = '是否顯示稅籍編號(Display Tax ID.):<br /><span class="help">帳單地址中出現稅籍編號欄位</span>';
$_['entry_tax_id_required']     = '稅籍編號是否為必填欄位(Tax ID Required):<br /><span class="help">會員必須填入稅籍編號才能結帳</span>';
$_['entry_sort_order']          = '排序:';

// Error
$_['error_permission'] = '您沒有權限修改會員群組的設置';
$_['error_name']       = '群組名稱必須在3至32個字元之間';
$_['error_default']    = '不能刪除預設的群組';
$_['error_store']      = '不能被刪除，因為目前尚有%s 間商店使用此群組';
$_['error_customer']   = '不能被刪除，因為目前尚有%s 位會員屬於此群組';
?>