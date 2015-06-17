<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('see the rows with Bought and sum of withdrawals');
$I->amOnPage('/activity/description?d=bought&c=withdrawal');
$I->see('Bought a laptop');

$I->wantTo('see gifts and how much was deposited');
$I->amOnPage('/activity/description?d=gift&c=deposit');
$I->see('gift');

$I->wantTo('see all rows with the word Interest');
$I->amOnPage('/activity/description?d=Interest&c=deposit');
$I->see('Interest');

$I->wantTo('see all the rows for the year 2000');
$I->amOnPage('/activity/date?dt=2000');
$I->see('2000-');

$I->wantTo('see all the rows for the year 2009');
$I->amOnPage('/activity/date?dt=2009');
$I->see('2009-');

$I->wantTo('see all the rows for the year 2004');
$I->amOnPage('/activity/date?dt=2004');
$I->see('2004-');