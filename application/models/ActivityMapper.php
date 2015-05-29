<?php

class Application_Model_ActivityMapper {

  protected $_dbTable;

  public function setDbTable($dbTable) {
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
    $resultSet = $this->getDbTable()->fetchAll();
    $records   = array();
    foreach ($resultSet as $row) {
      $record = new Application_Model_Activity();
      $record->setId($row->id)
        ->setDate($row->date)
        ->setDescription($row->description)
        ->setDeposit($row->deposit)
        ->setWithdrawal($row->withdrawal)
        ->setBalance($row->balance);
      $records[] = $record;
    }
    return $records;
  }

}
