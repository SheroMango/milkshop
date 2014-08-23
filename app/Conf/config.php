<?php
/**
 * 配置文件
 * @author chen
 * @version 2014-07-23
 */
return array(
        'URL_MODEL' => 0,
        'DB_TYPE'=>'mysql',
        'DB_HOST'=>'localhost',
        'DB_NAME'=>'milkshop',
        'DB_USER'=>'root',
        'DB_PWD'=>'',
        'DB_PORT'=>'3306',
        'DB_PREFIX'=>'m_',

        'TMPL_L_DELIM' => '{',
        'TMPL_R_DELIM' => '}',

        'APP_AUTOLOAD_PATH'=>'@.TagLib',

        'APP_GROUP_LIST'=>'Home, Admin',
        'DEFAULT_GROUP'=>'Admin',
        'SHOW_PAGE_TRACE'=>false,

);
?>
