<?php


namespace Acme\Tests\Behat\Context\Registration;



use Behat\Behat\Context\Context;

class IntegrationRegisterContext implements Context
{
    /**
     * Registerer
     */
    protected $registerer;

    /**
     * User
     */
    protected $user;

    /**
     * boolean
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param Registerer $registerer
     */
    public function __construct(Registerer $registerer)
    {
        $this->registerer = $registerer;
    }

    /**
     * @Given I am on the registration page
     */
    public function iAmOnTheRegistrationPage()
    {
        $this->user = new User();
    }

    /**
     * @Given /I register with username "(?P<username>[^"]*)" and password "(?P<password>[^"]*)"/
     */
    public function iRegisterWithUsernameAndPassword($username, $password)
    {
        $this->user->setUsername($username);
        $this->user->setPassword($password);
    }

    /**
     * @When I submit the form
     */
    public function iSubmitTheForm()
    {
        $this->response = $this->registerer->register($this->user);
    }

    /**
     * @Then I should see the registration confirmation message
     */
    public function iShouldSeeTheRegistrationConfirmation()
    {
        if (!$this->response) {
            throw new \RuntimeException('User is not registered.');
        }
    }
}