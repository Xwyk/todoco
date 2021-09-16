Feature: Register
  In order to create an account
  As a user
  I want to be able to register on the application

  Scenario: I register when I fill my username and password only
    Given I am on the registration page
    And I register with username "johndoe" and password "azerty123"
    When I submit the form
    Then I should see the registration confirmation