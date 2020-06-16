<?php

require 'Test.php';
/**
* CheckTest Class
*/
class CheckTest extends PHPUnit_Framework_TestCase
{
    /**
     * TestClassのインスタンス
     */
    public $test;

    /**
     * のインスタンス
     *
     * @var resource
     */
    public $check;

    /**
     * このコンストラクタはインスタンスに使います。
     */
    public function __construct()
    {
        $this->test = new Test();
        $this->check = new Check();
    }

    /**
     * checkEmailParams機能をテストします。
     */
    public function testEmailParams()
    {
        // 送信情報は空です
        $params = array();
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // toとccは空です
        $params = array(
            'bcc' => 'padon.mary@gmail.com'
        );
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // fromは空です
        $params = array(
            'to'    => 'padon.mary@gmail.com',
        );
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // toは文字列か配列ではありません。
        $params = array(
            'to'    => true,
            'from' => 'mary.angeleque.padon@pripress.co.jp'
        );
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // ccは文字列か配列ではありません。
        $params = array(
            'cc'    => true,
            'from' => 'mary.angeleque.padon@pripress.co.jp'
        );
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // bccは文字列か配列ではありません。
        $params = array(
            'to'    => 'padon.mary@gmail.com',
            'bcc'    => true,
            'from' => 'mary.angeleque.padon@pripress.co.jp'
        );
        $res = $this->check->checkEmailParams($params);
        $this->assertFalse($res);

        // すべてのパラメータは大丈夫です。
        $params = array(
            'subject' => 'sample subject',
            'body' => 'sample body',
            'to'    => 'padon.mary@gmail.com',
            'from' => 'mary.angeleque.padon@pripress.co.jp'
        );

        $res = $this->check->checkEmailParams($params);
        $this->assertTrue($res);
    }

    /**
     * checkRecipient機能をテストします。
     */
    public function testRecipient()
    {
        /*********************/
        /** Toをチェック **/
        /*********************/

        // toは文字列か配列ではありません。
        $params = array(
            'recipient' => true,
            'type' => 'To'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertFalse($res);

        // Toは配列です
        $params = array(
            'recipient' => array(
                'padon.mary@gmail.com',
                'mary.angeleque.padon@pripress.co.jp'
            ),
            'type' => 'To'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);

        // Toは文字列です
        $params = array(
            'recipient' => array('padon.mary@gmail.com'),
            'type' => 'To'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);

        /*********************/
        /** ccをチェック **/
        /*********************/

        // ccは文字列か配列ではありません。
        $params = array(
            'recipient' => true,
            'type' => 'Cc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertFalse($res);

        // ccは配列です
        $params = array(
            'recipient' => array(
                'padon.mary@gmail.com',
                'mary.angeleque.padon@pripress.co.jp'
            ),
            'type' => 'Cc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);

        // ccは文字列です
        $params = array(
            'recipient' => array('padon.mary@gmail.com'),
            'type' => 'Cc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);

        /*********************/
        /** bccをチェック **/
        /*********************/

        // bccは文字列か配列ではありません。
        $params = array(
            'recipient' => true,
            'type' => 'Bcc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertFalse($res);

        // bccは配列です
        $params = array(
            'recipient' => array(
                'padon.mary@gmail.com',
                'mary.angeleque.padon@pripress.co.jp'
            ),
            'type' => 'Bcc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);

        // bccは文字列です
        $params = array(
            'recipient' => array('padon.mary@gmail.com'),
            'type' => 'Bcc'
        );
        $res = $this->test->invokeMethod($this->check, 'checkRecipient', $params);
        $this->assertTrue($res);
    }

    /**
     * checkEmailFormat機能をテストします。
     */
    public function testEmailFormat()
    {
        // if email is not an email format
        $params = array('email' => 'padon.mary');
        $res = $this->test->invokeMethod($this->check, 'checkEmailFormat', $params);
        $this->assertFalse($res);

        // if email is an email format
        $params = array('email' => 'mary.angeleque.padon@pripress.co.jp');
        $res = $this->test->invokeMethod($this->check, 'checkEmailFormat', $params);
        $this->assertTrue($res);
    }

    /**
     * checkEmailFormat機能をテストします。
     */
    public function testConnection()
    {
        // ホストは空です
        $params = array('port' => 587);
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ポートは空です
        $params = array('host' => 'hs10.wadax.ne.jp');
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ホストは文字列ではありません
        $params = array('host' => true, 'port'=> 587);
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ホストはintではありません
        $params = array('host' => 'hs10.wadax.ne.jp', 'port' => '87');
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ポートが共通ポートリストに存在しません
        $params = array('host' => 'hs10.wadax.ne.jp', 'port' => 123);
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ホストかポートが間違っています
        $params = array('host' => 'hs10.wadax.ne.jps', 'port' => 587);
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ユーザー名とパスワードは空ですがsmtpauthはtrueです
        $params = array(
            'SMTPAuth' => true,
            'host' => 'hs10.wadax.ne.jp',
            'port' => 587
        );
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ユーザー名は空ですがsmtpauthはtrueです
        $params = array(
            'SMTPAuth' => true,
            'host' => 'hs10.wadax.ne.jp',
            'password' => 'pr2726670',
            'port' => 587
        );
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // パスワードは空ですがsmtpauthはtrueです
        $params = array(
            'SMTPAuth' => true,
            'host' => 'hs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'port' => 587
        );
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // ユーザー名が間違っています
        $params = array(
            'SMTPAuth' => true,
            'host' => 'hs10.wadax.ne.jp',
            'username' => 'spri-test@pripress.co.jp',
            'password' => 'pr2726670',
            'port' => 587
        );
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);

        // パスワードが間違っています
        $params = array(
            'SMTPAuth' => true,
            'host' => 'hs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'spr2726670',
            'port' => 587
        );
        $res = $this->check->checkConnection($params);
        $this->assertFalse($res);
    }
}
