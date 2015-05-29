<?php

// application/models/Activity.php
class Application_Model_Activity {

  protected $_balance;
  protected $_date;
  protected $_deposit;
  protected $_description;
  protected $_id;
  protected $_withdrawal;

  public function __set($name, $value);

  public function __get($name);

  
  public function setBalance($blc);

  public function getBalance();

  
  public function setDate($text);

  public function getDate();

  
  public function setDeposit($dps);

  public function getDeposit();

  
  public function setDescription($description);

  public function getDescription();

  
  public function setId($id);

  public function getId();

  
  public function setWithdrawal($wtd);

  public function getWithdrawal();
  
}

class Application_Model_ActivityMapper {

  public function save(Application_Model_Activity $activity);

  public function find($id);

  public function fetchAll();
}
