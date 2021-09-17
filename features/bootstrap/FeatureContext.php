<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on the registration page
     */
    public function iAmOnTheRegistrationPage()
    {
        throw new PendingException();
    }

    /**
     * @Given I register with username :arg1 and password :arg2
     */
    public function iRegisterWithUsernameAndPassword($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I submit the form
     */
    public function iSubmitTheForm()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the registration confirmation
     */
    public function iShouldSeeTheRegistrationConfirmation()
    {
        throw new PendingException();
    }
}
