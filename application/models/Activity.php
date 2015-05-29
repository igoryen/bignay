<?php

// application/models/Activity.php
class Application_Model_Activity {

  protected $_balance;
  protected $_date;
  protected $_deposit;
  protected $_description;
  protected $_id;
  protected $_withdrawal;

  public function __construct(array $options = null) {
    if (is_array($options)) {
      $this->setOptions($options);
    }
  }

  public function __set($name, $value) {
    $method = 'set' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
      throw new Exception('Invalid activity property');
    }
    $this->$method($value);
  }

  public function __get($name) {
    $method = 'get' . $name;
    if (('mapper' == $name) || !method_exists($this, $method)) {
      throw new Exception('Invalid activity property');
    }
    return $this->$method();
  }

  public function setOptions(array $options) {
    $methods = get_class_methods($this);
    foreach ($options as $key => $value) {
      $method = 'set' . ucfirst($key);
      if (in_array($method, $methods)) {
        $this->$method($value);
      }
    }
    return $this;
  }

  /**
   * Prepare the number for display: add format to it, or assign "" if there is no number.
   * @param float $number coming from the database
   * @return string to send to the view for display
   * 
   * @version 1
   * @date 2015-05-29
   * @author igoryen <igor.yentaltsev@gmail.com>
   */
  private function fixNumber($number){
    //$locale = new Zend_Locale('de_AT');
    if($number != null){
      $formatted_number = Zend_Locale_Format::toNumber($number, array('number_format' => '#,##0.00'));
    }
    else{
      $formatted_number = '';
    }
    
    return $formatted_number;
  }
  
  public function setBalance($blc) {    
    $this->_balance = $this->fixNumber($blc);
    return $this;
  }

  public function getBalance() {
    return $this->_balance;
  }

  public function setDate($date) {
    $this->_date = $date;
    return $this;
  }

  public function getDate(){
    return $this->_date;
  }

  public function setDeposit($dps){
    $this->_deposit = $this->fixNumber($dps);
    return $this;
  }

  public function getDeposit(){
    return $this->_deposit;
  }

  public function setDescription($description){
    $this->_description = (string) $description;
    return $this;
  }

  public function getDescription(){
    return $this->_description;
  }

  public function setId($id){
    $this->_id = (int) $id;
    return $this;
  }

  public function getId(){
    return $this->_id;
  }

  public function setWithdrawal($wtd){
    $this->_withdrawal = $this->fixNumber($wtd);
    return $this;
  }

  public function getWithdrawal(){
    return $this->_withdrawal;
  }
}

//class Application_Model_ActivityMapper {
//
//  public function save(Application_Model_Activity $activity);
//
//  public function find($id);
//
//  public function fetchAll();
//}
