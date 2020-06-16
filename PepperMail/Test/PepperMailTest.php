<?php

require 'Test.php';
/**
* PepperMailTest Class
*/
class PepperMailTest extends PHPUnit_Framework_TestCase
{
    /**
     * TestClassのインスタンス
     */
    public $test;

    /**
     * PepperMailのインスタンス
     *
     * @var resource
     */
    public $peppermail;

    /**
     * このコンストラクタはインスタンスに使います。
     */
    public function __construct()
    {
        $this->test = new Test();
        $this->peppermail = new PepperMail();
    }

    /**
     * sendMail機能をテストします。
     */
    public function testSendMail()
    {
        // 送信情報は空です
        $params = array();
        $res = $this->peppermail->sendMail($params);
        $this->assertFalse($res);

        // ポートが間違っています
        $emailParams = array(
            'subject'    => 'sample subject',
            'body'       => 'sample body',
            'from'       => 'pri-test@pripress.co.jp',
            'fromName'   => '一般財団法人 ピンネ農業公社',
            'returnPath' => 'pri-test@pripress.co.jp',
            'to'         => array(
                'mary.angeleque.padon@pripress.co.jp',
            ),
        );

        $configParams = array(
            'SMTPAuth' => false,
            'host' => 'hs10.wadax.ne.jp',
            'port' => 5876
        );
        $res = $this->peppermail->sendMail($emailParams, $configParams);
        $this->assertFalse($res);

        // ホストが間違っています
        $emailParams = array(
            'subject'    => 'sample subject',
            'body'       => 'sample body',
            'from'       => 'pri-test@pripress.co.jp',
            'fromName'   => '一般財団法人 ピンネ農業公社',
            'returnPath' => 'pri-test@pripress.co.jp',
            'to'         => array(
                'mary.angeleque.padon@pripress.co.jp',
            ),
        );

        $configParams = array(
            'SMTPAuth' => true,
            'host' => 'shs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'pr2726670',
            'port' => 587
        );
        $res = $this->peppermail->sendMail($emailParams, $configParams);
        $this->assertFalse($res);

        // すべてのパラメータは大丈夫です。
        $configParams = array(
            'host' => 'hs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'pr2726670',
            'port' => 587
        );
        $emailParams = array(
            'subject'    => 'sample subject',
            'body'       => 'sample body',
            'from'       => 'pri-test@pripress.co.jp',
            'fromName'   => '一般財団法人 ピンネ農業公社',
            'returnPath' => 'pri-test@pripress.co.jp',
            'to'         => array(
                'mary.angeleque.padon@pripress.co.jp',
            ),
        );

        $res = $this->peppermail->sendMail($emailParams, $configParams);
        $this->assertTrue($res);
    }

    /**
     * getMailConfig機能をテストします。
     */
    public function testMailConfig()
    {
        // ホストはありません。
        $params = array(
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'pr2726670',
            'port'     => 25,
        );
        $res = $this->test->invokeMethod($this->peppermail, 'getMailConfig', $params);
        $expected = array(
            'host'        => 'hs10.wadax.ne.jp',
            'port'        => 25,
            'username'    => '',
            'password'    => '',
            'smtpsecure'  => '',
            'smtpoptions' => array(),
            'SMTPAuth'    => false
        );
        $this->assertEquals($expected, $res);

        // ポートはありません。
        $params = array(
            'host'     => 'hs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'pr2726670',
        );
        $res = $this->test->invokeMethod($this->peppermail, 'getMailConfig', $params);
        $expected = array(
            'host'        => 'hs10.wadax.ne.jp',
            'port'        => 25,
            'username'    => '',
            'password'    => '',
            'smtpsecure'  => '',
            'smtpoptions' => array(),
            'SMTPAuth'    => false
        );
        $this->assertEquals($expected, $res);

        // ユーザー名かパスワードはありません。
        $params = array(
            'host'     => 'hs10.wadax.ne.jp',
            'port'     => 25,
        );
        $res = $this->test->invokeMethod($this->peppermail, 'getMailConfig', $params);
        $expected = array(
            'host'        => 'hs10.wadax.ne.jp',
            'port'        => 25,
            'username'    => '',
            'password'    => '',
            'smtpsecure'  => '',
            'smtpoptions' => array(),
            'SMTPAuth'    => false
        );
        $this->assertEquals($expected, $res);

        // ユーザー名かパスワードはあります。
        $params = array(
            'host'     => 'hs10.wadax.ne.jp',
            'username' => 'pri-test@pripress.co.jp',
            'password' => 'pr2726670',
            'port'     => 25,
        );
        $res = $this->test->invokeMethod($this->peppermail, 'getMailConfig', $params);
        $expected = array(
            'host'        => 'hs10.wadax.ne.jp',
            'port'        => 25,
            'username'    => '',
            'password'    => '',
            'smtpsecure'  => '',
            'smtpoptions' => array(),
            'SMTPAuth'    => false
        );
        $this->assertEquals($expected, $res);
    }
}
