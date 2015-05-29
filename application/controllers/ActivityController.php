<?php

class ActivityController extends Zend_Controller_Action {

  public function init() {
//    echo __METHOD__;
    /* Initialize action controller here */
  }

  public function indexAction() {
    echo __METHOD__;
    $am = new Application_Model_ActivityMapper();
    $this->view->records = $am->fetchAll();
  }

}
