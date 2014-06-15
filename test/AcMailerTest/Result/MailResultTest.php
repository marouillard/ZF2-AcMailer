<?php
namespace AcMailerTest\Result;

use AcMailer\Result\MailResult;

/**
 * Mail result test case
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class MailResultTest extends \PHPUnit_Framework_TestCase
{
    
    private $mailResult;
    
    public function testDefaultValues()
    {
        $this->mailResult = new MailResult();
        $this->assertTrue($this->mailResult->isValid());
        $this->assertEquals("Success!!", $this->mailResult->getMessage());
        $this->assertFalse($this->mailResult->hasException());
        $this->assertNull($this->mailResult->getException());
    }
    
    public function testCustomValues()
    {
        $expectedError = "Custom error message";
        $this->mailResult = new MailResult(false, $expectedError);
        $this->assertFalse($this->mailResult->isValid());
        $this->assertEquals($expectedError, $this->mailResult->getMessage());
        $this->assertFalse($this->mailResult->hasException());
        $this->assertNull($this->mailResult->getException());
    }

    public function testWithException()
    {
        $e = new \Exception("The exception", -2);
        $this->mailResult = new MailResult(false, $e->getMessage(), $e);
        $this->assertFalse($this->mailResult->isValid());
        $this->assertEquals($e->getMessage(), $this->mailResult->getMessage());
        $this->assertTrue($this->mailResult->hasException());
        $this->assertEquals($e, $this->mailResult->getException());
    }
    
}