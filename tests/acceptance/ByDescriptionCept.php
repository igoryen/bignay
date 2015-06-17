<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('see the rows with Bought and sum of withdrawals');
$I->amOnPage('/activity/description?d=bought&c=withdrawal');
$I->see('Bought a laptop');

$I->wantTo('see gifts and how much was deposited');
$I->amOnPage('/activity/description?d=gift&c=deposit');
$I->see('gift');

