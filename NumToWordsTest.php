<?php

require_once 'PHPUnit/Framework.php';
require_once 'NumToWords.php';

class NumToWordsTest extends PHPUnit_Framework_TestCase {
    public function checkTest(){

    	$new = new NumToWords();
    	this->assertTrue($new->convert('111354543.77'));
    	this->assertTrue($new->convert('1110000543.77'));
    	this->assertTrue($new->convert('111354541'));
    	this->assertTrue($new->convert('111354543.5'));
    	this->assertTrue($new->convert('111354543.06'));
    	this->assertEquals('двa мільярди один мільйон одна тисячa гривень , одинадцять копійок ',$new->convert('2001001000.11'));
    	

    }
}