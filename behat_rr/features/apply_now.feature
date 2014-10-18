# features/apply_now.feature
Feature: Test Apply Now Form

  Scenario: Add a product to cart
    Given I view category name "Furniture"
    When I add product name "Computer chair" to cart
    And I click Apply now button
    And I wait "1" seconds
    And I fill "6009" to "Postcode" field
    And I select "Mr." from "Title" dropdown
    And I fill "Trung" to "First name" field
    And I fill "Nguyen" to "Last name" field
    And I select day "12" from "Date of Birth" field
    And I select month "January" from "Date of Birth" field
    And I select year "1991" from "Date of Birth" field
    And I fill phone "1234567890" to "Home" field
    And I fill "trung@playhousedigital.com" to "Email address" field
    And I check on "Privacy Authorisation" field
    And I press on button "Next" field "next"
    And I wait Element has class "residential-details-form"
    Then I should see the text "PERSONAL DETAILS" in ".residential-details-form h2"
    And I wait "1" seconds
    And I select "Single" from "What’s your marital status?" dropdown
    And I select "1" from "Years" of "How long have you been at your current address?" field
    And I select "1" from "Months" of "How long have you been at your current address?" field
    And I fill "193 Coach Rd" to "Address" field
    And I fill "BENALLA" to "Suburb / Town" field
    And I select State "Victoria" dropdown
    And I fill "3672" to "Postcode" field
    And I select "Renting" from "Residential status" dropdown
    And I fill "Trung" to "Mortgagee / Landlord name" field
    And I fill "1234567890" to "Mortgagee / Landlord phone" field
    And I press on button "Next" field "next"
    #Then I should see "THANK YOU" in "#successPopup h3"
