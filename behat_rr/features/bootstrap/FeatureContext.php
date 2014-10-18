<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\Selenium2Driver,
    Behat\MinkExtension\Context\MinkContext;

use Selenium\Client as SeleniumClient;

//
// Require 3rd-party libraries here:
//
   require_once 'PHPUnit/Autoload.php';
   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    private $_base_url = 'http://rr-aws-dev.playhousedigital.com/';

    public function __construct(array $parameters)
    {
		$mink = new Mink(array(
            'selenium2' => new Session(new Selenium2Driver($parameters['wd_capabilities']['browser'], $parameters['wd_capabilities'], $parameters['wd_host'])),
        ));

        $this->gui = $mink->getSession('selenium2');
    }

	 /**
     * @Given /^I am on "([^"]*)"$/
     */
    public function iAmOn($arg1, $condition = '')
    {
		try{
			$this->gui->start();
			$this->gui->visit($arg1);
            $this->gui->wait(5000, $condition);
		}catch(PendingException $e){
			throw $e;
		}
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($arg1)
    {
		try{
			$page = $this->gui->getPage();
			$text = $page->find('css', ".page-title h1")->getText();
            assertEquals($text, $arg1);
            $this->gui->stop();
		}catch(PendingException $e){
			throw $e;
		}
    }

    /**
     * @Given /^I view category name "([^"]*)"$/
     */
    public function iViewCategoryName($arg1)
    {
        try{
            $page = $this->gui->getPage();
            $this->iAmOn($this->_base_url, 'document.getElementsByClassName("cart").length > 0');
            $_categoryLinks = $page->findAll('css', 'a.level-top');
            foreach($_categoryLinks as $_cat){
                if(!is_object($_cat)) continue;
                if(strtolower($_cat->getText()) == strtolower($arg1)){
                    $_cat->click();
                    $this->gui->wait(5000, 'document.getElementsByClassName("product-details").length > 0');
                }
            }
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @When /^I add product name "([^"]*)" to cart$/
     */
    public function iAddProductNameToCart($arg1)
    {
        try{
            $page = $this->gui->getPage();
            $_products = $page->findAll('css','.product-details');
            foreach($_products as $p){
                $a = $p->find('css', 'h3 a');
                if(!is_object($a)) continue;
                if(strtolower($a->getText()) == strtolower($arg1)){
                    $p->find('css', '.actions button')->click();
                    $this->gui->wait(5000,'document.getElementsByClassName("cart").length > 0');
                }
            }
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Then /^I go to "([^"]*)" page$/
     */
    public function iGoToPage($arg1)
    {
        $this->iShouldSee($arg1);
    }

    /**
     * @Given /^I click Apply now button$/
     */
    public function iClickApplyNowButton()
    {
        try{
            $_script = <<<JS
jQuery("#customerInformationForm").click();
JS;
            $_script1 = <<<JS
jQuery("#applicationFormTabsDescription").show();
jQuery("#applicationFormTabs").show();
jQuery("#customerInformationFormContainer").show();
JS;
            $this->gui->executeScript($_script);
            $this->gui->wait(5000);
            $this->gui->executeScript($_script1);
            $this->gui->wait(1000);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I click on button has id "([^"]*)"$/
     */
    public function iClickOnButtonHasId($arg1)
    {
        try{
            $_script = <<<JS
jQuery("$arg1").click();
JS;
            $this->gui->executeScript($_script);
            $this->gui->wait(5000);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Then /^I should see the Element "([^"]*)"$/
     */
    public function iShouldSeeTheElement($arg1)
    {
        try{
            $page = $this->gui->getPage();
            $_element = $page->find('css',$arg1);
            assertTrue($_element->isVisible());
            $this->gui->stop();
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I fill "([^"]*)" to "([^"]*)"$/
     */
    public function iFillTo($arg1, $arg2)
    {
        try{
            $page = $this->gui->getPage();
            $page->fillField($arg2,$arg1);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I select "([^"]*)" from "([^"]*)"$/
     */
    public function iSelectFrom($arg1, $arg2)
    {
        try{
            $_script = <<<JS
jQuery('.select-opener').click();
jQuery('li').each(function(){
    var a = jQuery(this).find('a span').text();
    var b = a.trim();
    if(b == "$arg2"){
        jQuery(this).click();
    }
});
JS;
            $this->gui->executeScript($_script);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I check on "([^"]*)"$/
     */
    public function iCheckOn($arg1)
    {
        try{
            $page = $this->gui->getPage();
            $page->checkField($arg1);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I press on "([^"]*)"$/
     */
    public function iPressOn($arg1)
    {
        try{
            $page = $this->gui->getPage();
            $page->pressButton($arg1);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I fill "([^"]*)" to "([^"]*)" field "([^"]*)"$/
     */
    public function iFillToField($arg1, $arg2, $arg3)
    {
        $this->iFillTo($arg1,$arg3);
    }

    /**
     * @Given /^I select "([^"]*)" from "([^"]*)" field "([^"]*)"$/
     */
    public function iSelectFromField($arg1, $arg2, $arg3)
    {
        $this->iSelectFrom($arg1, $arg3);
    }

    /**
     * @Given /^I check on "([^"]*)" field "([^"]*)"$/
     */
    public function iCheckOnField($arg1, $arg2)
    {
        $this->iCheckOn($arg2);
    }

    /**
     * @Given /^I press on button "([^"]*)" field "([^"]*)"$/
     */
    public function iPressOnButtonField($arg1, $arg2)
    {
        $this->iWaitSeconds(2);
        $this->iPressOn($arg2);
    }

    /**
     * @Given /^I fill phone "([^"]*)" to "([^"]*)" field$/
     */
    public function iFillPhoneToField($arg1, $arg2)
    {
        try{
            $_script = <<<JS
jQuery('.phone-group').find('li').each(function(){
    var a = jQuery(this).find('label').text();
    var b = a.split(':')[0].trim();
    if(b == "$arg2"){
        jQuery(this).find('input').val('$arg1');
    }
});
JS;
            $this->gui->executeScript($_script);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I fill "([^"]*)" to "([^"]*)" field$/
     */
    public function iFillToField2($arg1, $arg2)
    {
        try{
            $_script = <<<JS
jQuery('li').each(function(){
    var a = jQuery(this).find('label').text();
    var b = a.split('*')[0].trim();
    if(b == "$arg2"){
        jQuery(this).find('input').val('$arg1');
    }
});
JS;
            $this->gui->executeScript($_script);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I select "([^"]*)" from "([^"]*)" field$/
     */
    public function iSelectFromField2($arg1, $arg2)
    {
        try{
            $_script = <<<JS
var optionEvens = document.getElementsByClassName("option-even");
for (i=0; i<optionEvens.length; i++){
    if(optionEvens[i].textContent.trim() == "$arg1"){
        optionEvens[i].click();
    }
}
JS;
            $this->gui->executeScript($_script);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I check on "([^"]*)" field$/
     */
    public function iCheckOnField2($arg1)
    {
        try{
            $_script = <<<JS
jQuery('.check-fields').each(function(){
    var a = jQuery(this).find('h3.sub-title').text();
    var b = a.split('*')[0].trim();
    if(b == "$arg1"){
        jQuery(this).find('input[type=checkbox]').prop('checked', true);
    }
});
JS;
            $this->gui->executeScript($_script);
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I select day "([^"]*)" from "([^"]*)" field$/
     */
    public function iSelectDayFromField($arg1, $arg2)
    {
        $this->iSelectFrom($arg2,$arg1);
    }

    /**
     * @Given /^I select month "([^"]*)" from "([^"]*)" field$/
     */
    public function iSelectMonthFromField($arg1, $arg2)
    {
        $this->iSelectFrom($arg2,$arg1);
    }

    /**
     * @Given /^I select year "([^"]*)" from "([^"]*)" field$/
     */
    public function iSelectYearFromField($arg1, $arg2)
    {
        $this->iSelectFrom($arg2,$arg1);
    }

    /**
     * @Then /^I should see the text "([^"]*)" in "([^"]*)"$/
     */
    public function iShouldSeeTheText($arg1, $arg2)
    {
        try{
            $page = $this->gui->getPage();
            $text = $page->find('css', "$arg2");
            if(!is_object($text)){assertTrue(false);}

            if(strcmp($text->getText(), $arg1) == 0){
                return true;
            }
            assertEquals($text->getText(), $arg1);
            $this->gui->stop();
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Then /^I should see "([^"]*)" in "([^"]*)"$/
     */
    public function iShouldSeeIn($arg1, $arg2)
    {
        try{
            $page = $this->gui->getPage();
            $text = $page->find('css', $arg2)->getText();
            assertEquals($text, $arg1);
            $this->gui->stop();
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I wait Element has class "([^"]*)"$/
     */
    public function iWaitElementHasClass($arg1)
    {
        try{
            $this->gui->wait(5000,'document.getElementsByClassName("'.$arg1.'").length > 0');
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I wait Element has id "([^"]*)"$/
     */
    public function iWaitElementHasId($arg1)
    {
        try{
            $this->gui->wait(5000,'document.getElementById("'.$arg1.'").length > 0');
        }catch(PendingException $e){
            throw $e;
        }
    }

    /**
     * @Given /^I wait "([^"]*)" seconds$/
     */
    public function iWaitSeconds($arg1)
    {
        try{
            $this->gui->wait((int)$arg1*1000);
        }catch(PendingException $e){
            throw $e;
        }
    }
}
