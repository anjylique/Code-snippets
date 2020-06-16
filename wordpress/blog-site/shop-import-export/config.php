<?php
/**
 * Configuration file
 */

date_default_timezone_set( 'Asia/Tokyo' );

/**
 * Basename of the current file
 */
$shop_ie_basename = basename( $_SERVER["SCRIPT_FILENAME"] );
$config_site_url  = $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];

$config_site_type = 'tokyo';
if ( strpos( $config_site_url, 'miyagi' ) > -1 ) {
    $config_site_type = 'miyagi';
} else if ( strpos( $config_site_url, 'saitama' ) > -1 ) {
    $config_site_type = 'saitama';
}


/**
 * To configure the path automatically
 * for the staging and production
 */
$config_plugin_path = '';
if ( strpos( $config_site_url, 'cloud4.pripress.co.jp/wp' ) > -1 ) {
    $config_plugin_path = '/usr/share/nginx/html/wp/manager/wp-content/plugins/shop-import-export';

} else if ( strpos( $config_site_url, 'cloud4.pripress.co.jp/miyagiwp' ) > -1 ) {
    $config_plugin_path = '/usr/share/nginx/html/miyagiwp/manager/wp-content/plugins/shop-import-export';

} else if ( strpos( $config_site_url, 'cloud4.pripress.co.jp/saitama' ) > -1 ) {
    $config_plugin_path = '/usr/share/nginx/html/saitama/manager/wp-content/plugins/shop-import-export';

} else if ( strpos( $config_site_url, 'tokyo.machishiru.jp' ) > -1 ) {
    $config_plugin_path = '/var/www/vhosts/tokyo.machishiru.jp/manager/wp-content/plugins/shop-import-export';

} else if ( strpos( $config_site_url, 'miyagi.machishiru.jp' ) > -1 ) {
    $config_plugin_path = '/var/www/vhosts/miyagi.machishiru.jp/manager/wp-content/plugins/shop-import-export';

} else if ( strpos( $config_site_url, 'saitama.machishiru.jp' ) > -1 ) {
    $config_plugin_path = '/var/www/vhosts/saitama.machishiru.jp/manager/wp-content/plugins/shop-import-export';
}

/**
 * Which type of site is this
 */
define( 'SHOP_SITE_TYPE', $config_site_type );

/**
 * CSVファイルパス
 * ダウンロードのため
 */
define( 'SHOP_CSV_FILEPATH', 'tmp/shop-'.SHOP_SITE_TYPE.'-data.csv' );

/**
 * For 東京・埼玉
 *
 * This is the indentifier.
 * This is for the カスタム営業時間
 */
define('ACF_LAST_INPUT', '.acf-field.acf-field-textarea.acf-field-5bcd24f9ee5ea');

/**
 * 宮城
 *
 * This is the indentifier.
 * This is for the カスタム営業時間
 * Since they have different values
 * with 東京・埼玉. Since that
 * was the previous company has
 * done.
 */
define('MIYAGI_ACF_LAST_INPUT', '.acf-field.acf-field-text.acf-field-5cd4de7560630');

/**
 * ダウンロードファイルのため
 */
define( 'SHOP_PLUGIN_PATH_MAIN', $config_plugin_path );

if ( $shop_ie_basename !== 'download.php' ) {
    /**
     * プラグインURL
     * https://domain/manager/wp-content/plugins/shop-import-export
     */
    define( 'SHOP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    /**
     * プラグインパス
     * relative path
     * /{path}/manager/wp-content/plugins/shop-import-export
     */
    define( 'SHOP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

    /**
     * CSVファイルパス
     * {path}/manager/wp-content/plugins/shop-import-export/tmp/shop-data.csv
     */
    define( 'SHOP_CSV_FULL_FILEPATH', SHOP_PLUGIN_PATH.SHOP_CSV_FILEPATH );

    /**
     * カスタム営業時間CSVファイルパス
     * {path}/manager/wp-content/plugins/shop-import-export/tmp/shop-data.csv
     */
    define( 'SHOP_SCHED_CSV_FULL_FILEPATH', SHOP_PLUGIN_PATH.'tmp/shop-'.SHOP_SITE_TYPE.'-sched-data.csv' );

    /**
     * ダウングレード機能ファイル
     * This is the download function file
     * {path}/manager/wp-content/plugins/shop-import-export/download.php
     */
    define( 'SHOP_DOWNLOAD_FILE', SHOP_PLUGIN_URL.'download.php' );
}
