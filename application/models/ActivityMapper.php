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

  /**
   * Fetch (1) all values from the database (SELECT * FROM...) and (2)
   * the names of the table columns
   * @return array $retvalar holds two arrays: 
   * records[] (values of records) and 
   * columns[] (names of columns)
   */
  public function fetchAll($date = null) {
    $retvalar = []; // retvalar = ret(urn) var(iables') ar(ray)
    $columns = $this->getDbTable()->info(Zend_Db_Table_Abstract::COLS);
    
    // SELECT * FROM <table> ORDER BY date DESC
    $select = $this->getDbTable()->select();
    if($date != null){
      $select->where('date = ? ', $date);
    }
    $select->order('date DESC');
    $resultSet = $this->getDbTable()->fetchAll($select);
    
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
    }
    $retvalar['records'] = $records;
    $retvalar['columns'] = $columns;
    return $retvalar;
  }
  
}
