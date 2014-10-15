# features/request_callback.feature
Feature: Test Request Callback Form

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "Computer chair" to cart
    And I click on button has id "#requestCallbackForm"
    And I wait "1" seconds
    And I fill "6009" in "applicationForm_callbackRequest-postCode"
    And I select "Mr." from "applicationForm_callbackRequest-title"
    And I fill "Trung" in "applicationForm_callbackRequest-firstName"
    And I fill "Nguyen" in "applicationForm_callbackRequest-lastName"
    And I fill "1234567890" in "applicationForm_callbackRequest-homeNumber"
    And I fill "trung@playhousedigital.com" in "applicationForm_callbackRequest-email"
    And I check on "applicationForm_callbackRequest-iAgree"
    And I press on "request-submit"
    And I wait "5" seconds
    Then I should see "THANK YOU" in "#successPopup h3"