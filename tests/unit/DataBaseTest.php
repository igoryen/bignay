<?php

class DataBaseTest extends \Codeception\TestCase\Test {

  /**
   * @var \UnitTester
   */
  protected $tester;

  function testSavingUser() {
    spl_autoload_register('my_autoloader', 1);
    //my_autoloader('Activity');
    
    $a = new Activity();
    $a->setId();
    $a->setDate('2015-06-17');
    $a->setDescription('Found on the road');
    $a->setDeposit('5000');
    $a->setWithdrawal('');
    $a->setBalance('7500');
    
    $a->save();
    $this->assertEquals('Found on the road', $a->getDescription());
    $this->tester->seeInDatabase('as', array('date' => '2015-06-17', 'deposit' => '5000'));
  }

  protected function _before() {
    
  }

  protected function _after() {
    
  }

  // tests
  public function testMe() {
    
  }

}
