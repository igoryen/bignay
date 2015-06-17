<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see all records in the activity table');
$I->amOnPage('/activity');
$I->see('Our Activity Records:');

