# features/apply_now.feature
Feature: Test Apply Now Form

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "Computer chair" to cart
    And I click on button has id "#customerInformationForm"
    And I wait "1" seconds
    And I fill "6009" to "Postcode" field
    And I select "Mr." from "Title" field
    And I fill "Trung" to "First name" field
    And I fill "Nguyen" to "Last name" field
    And I select day "11" from "Date of Birth" field
    And I select month "January" from "Date of Birth" field
    And I select year "1991" from "Date of Birth" field
    And I fill phone "1234567890" to "Home" field
    And I fill "trung@playhousedigital.com" to "Email address" field
    And I check on "Privacy Authorisation" field
    And I press on button "Next" field "next"
    And I wait "5" seconds
    #Then I should see "THANK YOU" in "#successPopup h3"
