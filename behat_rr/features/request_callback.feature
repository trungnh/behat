# features/request_callback.feature
Feature: request_callback

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "4-PIECE QUEEN BED PACKAGE" to cart
    And I click on button has id "#requestCallbackForm"
    And I wait "1" seconds
    And I fill "6009" to "Postcode" field "applicationForm_callbackRequest-postCode"
    And I select "Mr." from "Title" field "applicationForm_callbackRequest-title"
    And I fill "Trung" to "First name" field "applicationForm_callbackRequest-firstName"
    And I fill "Nguyen" to "Last name" field "applicationForm_callbackRequest-lastName"
    And I fill "1234567890" to "Phone number" field "applicationForm_callbackRequest-homeNumber"
    And I fill "trung@playhousedigital.com" to "Email address" field "applicationForm_callbackRequest-email"
    And I check on "Privacy Authorisation" field "applicationForm_callbackRequest-iAgree"
    And I press on button "Submit" field "request-submit"
    And I wait "5" seconds
    Then I should see "THANK YOU" in "#successPopup h3"
