<?php

class ActivityController extends Zend_Controller_Action {

  public function init() {
    /* Initialize action controller here */
  }

  public function indexAction() {
    $am = new Application_Model_ActivityMapper();
    $date = $this->_getParam('date');
    if($date != null){
      $this->view->retvalar = $am->fetchAll($date);
    }
    else{
      $this->view->retvalar = $am->fetchAll();
    }
  }
  
}
