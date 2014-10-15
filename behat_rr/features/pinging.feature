# features/pinging.feature
Feature: Test Pinging Application Form

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "Computer chair" to cart
    And I click on button has id "#customerInformationForm"
    Then I should see the Element "#customerInformationFormContainer"

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "Computer chair" to cart
    And I click on button has id "#requestCallbackForm"
    Then I should see the Element "#requestCallbackFormContainer"
