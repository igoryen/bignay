<?php

class ActivityController extends Zend_Controller_Action {

  public function init() {
    /* Initialize action controller here */
  }

  public function indexAction() {
    $am = new Application_Model_ActivityMapper();
    $this->view->retvalar = $am->fetchAll();
  }

  /**
   * bignay.com/activity/date?dt=2000
   */
  public function dateAction() {
    $date = $this->_getParam('dt');
    $am = new Application_Model_ActivityMapper();
    $this->view->retvalar = $am->getByDate($date);
  }

  /**
   * bignay.com/activity/description?d=bought
   */
  public function descriptionAction() {
    $description = $this->_getParam('d');
    $column = $this->_getParam('c');
    $am = new Application_Model_ActivityMapper();
    $this->view->inbox = $am->getByDescription($description, $column);
  }

}
