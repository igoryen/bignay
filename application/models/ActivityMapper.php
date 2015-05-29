<?php

class Application_Model_ActivityMapper {

  protected $_dbTable;

  public function setDbTable($dbTable) {
    echo __METHOD__;
    if (is_string($dbTable)) {
      $dbTable = new $dbTable();
    }
    if (!$dbTable instanceof Zend_Db_Table_Abstract) {
      throw new Exception('Invalid table data gateway provided');
    }
    $this->_dbTable = $dbTable;
    return $this;
  }

  public function getDbTable() {
    echo __METHOD__;
    if (null === $this->_dbTable) {
      $this->setDbTable('Application_Model_DbTable_Activity');
    }
    return $this->_dbTable;
  }

  public function save(Application_Model_Activity $activity) {
    $data = array(
      'date' => date('Y-m-d H:i:s'),
      'description' => $activity->getDescription(),
      'deposit'     => $activity->getDeposit(),
      'withdrawal'  => $activity->getWithdrawal(),
      'balance'     => $activity->getBalance(),
    );
    if (null === ($id   = $activity->getId())) {
      unset($data['id']);
      $this->getDbTable()->insert($data);
    }
    else {
      $this->getDbTable()->update($data, array('id = ?' => $id));
    }
  }

  public function find($id, Application_Model_Activity $activity) {
    $result = $this->getDbTable()->find($id);
    if (0 == count($result)) {
      return;
    }
    $row = $result->current();
    $activity->setId($row->id)
      ->setDate($row->date)
      ->setDescription($row->description)
      ->setDeposit($row->deposit)
      ->setWithdrawal($row->withdrawal)
      ->setBalance($row->balance);
  }

  public function fetchAll() {
    echo __METHOD__;
//    echo 'tralala!' . __METHOD__;
    $resultSet = $this->getDbTable()->fetchAll();
    //echo '****' .var_dump($resultSet);
    $records   = array();
    foreach ($resultSet as $row) {
      $ar = new Application_Model_Activity(); // $ar = activity record
      $ar->setId($row->id)
        ->setDate($row->date)
        ->setDescription($row->description)
        ->setDeposit($row->deposit)
        ->setWithdrawal($row->withdrawal)
        ->setBalance($row->balance);
      $records[] = $ar;
      //echo '****' . print_r($records);
    }
    //var_dump($records);
    return $records;
  }

}
