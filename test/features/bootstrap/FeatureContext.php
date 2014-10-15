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

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
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
    public function __construct(array $parameters)
    {
        // Initialize your context here
		$mink = new Mink(array(
            'selenium2' => new Session(new Selenium2Driver($parameters['wd_capabilities']['browser'], $parameters['wd_capabilities'], $parameters['wd_host'])),
        ));

        $this->gui = $mink->getSession('selenium2');
    }

	/**
	 * @Given /^I\'m on "([^"]*)"$/
	 */
	public function iMOn($arg1)
	{
		$this->gui->start();
		$this->gui->visit($arg1);
	}
	/**
	 * @Given /^I search for "([^"]*)"$/
	 */
	public function iSearchFor($arg1)
	{
		$page = $this->gui->getPage();
		$page->fillField("gbqfq", $arg1);
		$page->find("css", "#gbqfb")->click();
        $this->gui->wait(5000);
	}
	/**
	 * @Then /^I should see "([^"]*)" as the first result$/
	 */
	public function iShouldSeeAsTheFirstResult($arg1)
	{
        $page = $this->gui->getPage();
        $text =  $page->find('css', '.rc .r a')->getText();
		if(strcmp($text,$arg1)==0){
            $this->gui->stop();
        }
	}
	/**
	 * @When /^wait (\d+) seconds?$/
	 */
	public function waitSeconds($seconds)
	{
		$this->getSession()->wait(1000*$seconds);
	}
}
