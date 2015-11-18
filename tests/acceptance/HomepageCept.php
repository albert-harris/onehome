<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/home'); 
$I->see('For Sale');
$I->see('Latest Properties');
$I->see('Posted by:');
$I->see('Our Team');