<?php

class ActivityController extends Zend_Controller_Action {

  public function init() {
    /* Initialize action controller here */
  }

  public function indexAction() {
    $am = new Application_Model_ActivityMapper();
    $this->view->records = $am->fetchAll();
  }

}
