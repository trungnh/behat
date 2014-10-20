# features/apply_now.feature
Feature: apply_now_previous_residential

  Scenario: Test Apply Now Form included Previous Residential
    Given I view category name "Furniture"
    When I add product name "4-PIECE QUEEN BED PACKAGE" to cart
    And I click Apply now button
    And I wait "1" seconds

    #Step 1
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
    And I wait "5" seconds
    And I wait Element has class "residential-details-form"
    Then I should see the text "PERSONAL DETAILS" in ".residential-details-form h2"
    And I wait "1" seconds

    #Step 2
    And I select "Single" from Marital dropdown
    And I select "1" from "Years" of "How long have you been at your current address?" field
    And I select "1" from "Months" of "How long have you been at your current address?" field
    And I wait "1" seconds
    And I wait residential details form "residential-details"
    And I wait "2" seconds
    And I fill "193 Coach Rd" to "Address" field
    And I fill "BENALLA" to "Suburb / Town" field
    And I select State "Victoria" dropdown
    And I fill "3672" to "Postcode" field
    And I select "Renting" from "Residential status" dropdown
    And I fill "Trung" to "Mortgagee / Landlord name" field
    And I fill "1234567890" to "Mortgagee / Landlord phone" field
    And I fill "193 Coach Rd" to "Address" field in Previous form
    And I fill "BENALLA" to "Suburb / Town" field in Previous form
    And I select "Victoria" from dropdown "State" in Previous form
    And I fill "3672" to "Postcode" field in Previous form
    And I select "1" from dropdown "Years" in Previous form
    And I select "2" from dropdown "Months" in Previous form
    And I wait "2" seconds
    And I press on button "Next" field "next"
    And I wait Element has class "income-and-identification-form"
    And I wait "5" seconds
    Then I should see the text "INCOME & IDENTIFICATION" in ".income-and-identification-form h2"

    #Step 3
    And I choose Status "Employed Full Time"
    And I wait "5" seconds
    And I fill "Trung Nguyen" to "Employer Name" field
    And I select Occupation "Labourer"
    And I fill "193 Coach Rd" to "Address" field
    And I fill "BENALLA" to "Suburb/Town" field
    And I select State "Victoria" dropdown
    And I fill "3672" to "Postcode" field
    And I fill "1234567890" to "Employer Phone" field
    And I select "2" from "Years" field
    And I select "2" from "Month" field
    And I fill "4000" to "Weekly net income" field
    And I fill "1000" to "Other encumbrances" field
    And I select "2" from "Number of dependants" dropdown
    And I select "Birth Certificate" from "Identification type" dropdown
    And I fill "1234567" to "ID number" field
    And I select Expiry date "Year" value "2015"
    And I select Expiry date "Month" value "January"
    And I wait "2" seconds
    And I press on button "Next" field "next"
    And I wait Element has class "referees"
    And I wait "5" seconds
    Then I should see the text "REFEREES (FAMILY & FRIENDS)" in ".referees h2"

    #Step 4
    And I select "Mr." from "Title" dropdown
    And I fill "Long" to "First name" field
    And I fill "Pham" to "Last name" field
    And I fill "193 Coach Rd" to "Address" field
    And I fill "BENALLA" to "Suburb/Town" field
    And I select State "Victoria" dropdown
    And I fill "3672" to "Postcode" field
    And I fill phone "1234567890" to "Mobile" field
    And I fill "long@playhousedigital.com" to "Email address" field
    And I select "Employer" from "Relationship" dropdown
    And I press on button "Submit My Application" field "submitApplicationForm"
    And I wait "5" seconds
    Then I should see "THANK YOU" in "#successPopup h3"
