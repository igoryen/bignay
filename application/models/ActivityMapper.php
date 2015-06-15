<?php
// for table Activity
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
  public function fetchAll() {
    // SELECT * FROM <table> ORDER BY date DESC
    $select = $this->getDbTable()->select();
    $select->order('date DESC');
    $resultSet = $this->getDbTable()->fetchAll($select);
    
    return $this->retvalar($resultSet);
  }
  
  /**
   * Display records by date
   * @param type $date
   * @return type
   */
  public function getByDate($date) {
    // SELECT * FROM <table> ORDER BY date DESC
    $select = $this->getDbTable()->select();
    if($date != null){
      $select->where('YEAR(date) = ?', substr($date, 0,4));
    }
    $select->order('date DESC');
    $resultSet = $this->getDbTable()->fetchAll($select);
    
    return $this->retvalar($resultSet);
    
  }
  
  
  public function getByDescription($string) {

    $columns = $this->getDbTable()->info(Zend_Db_Table_Abstract::COLS);
    
    # QUERY 1
    # SELECT * FROM <table> {...} ORDER BY date DESC
    $select1 = $this->getDbTable()->select();
    if($string != null){
      $select1->where('LOWER(description) LIKE ?', '%'.$string .'%');
    }    
    $select1->order('date DESC');
    $resultSet1 = $this->getDbTable()->fetchAll($select1);
    #TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
//    $file = $_SERVER['DOCUMENT_ROOT'] . '/igoryen.txt';
//    $sql = $select1->__toString();
//    $data = $sql . PHP_EOL;
//    file_put_contents($file, $data, FILE_APPEND);
    #LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL    
    
    foreach ($resultSet1 as $row) {
      $ar = new Application_Model_Activity(); // $ar = activity record
      $ar->setId($row->id)
        ->setDate($row->date)
        ->setDescription($row->description)
        ->setDeposit($row->deposit)
        ->setWithdrawal($row->withdrawal)
        ->setBalance($row->balance);
      $records[] = $ar;
    }
    $outbox['records'] = $records;
    $outbox['columns'] = $columns;
    
    # QUERY 2
    # SELECT sum() where ...
    $select2 = $this->getDbTable()->select();
    $select2->from(array('a'=>'activity'), 
                  array('SUM(`a`.`withdrawal`) AS sum'));
    if($string != null){
      $select2->where('LOWER(description) LIKE ?', '%'.$string .'%');
    }    
    $resultSet2 = $this->getDbTable()->fetchAll($select2);
    #TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
//    $file = $_SERVER['DOCUMENT_ROOT'] . '/igoryen.txt';
//    $sql = $select2->__toString();
//    $data = $sql . PHP_EOL;
//    file_put_contents($file, $data, FILE_APPEND);
    #LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL
    foreach ($resultSet2 as $row) {
      $sum = $row->sum;
    }
    
    $outbox['sum'] = Application_Model_Activity::fixNumber($sum);
    
    return $outbox;
  }
  



  // retvalar = ret(urn) var(iables') ar(ray)
  public function retvalar($resultSet){
    $columns = $this->getDbTable()->info(Zend_Db_Table_Abstract::COLS);
    $outbox = []; 
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
    $outbox['records'] = $records;
    $outbox['columns'] = $columns;
    return $outbox;
  }
  
}
