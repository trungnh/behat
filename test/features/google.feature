Feature: Visit Google and search

Scenario: Run a search for Behat
    Given I'm on "https://www.google.com.vn/"
    And I search for "selenium"
    Then I should see "Selenium - Web Browser Automation" as the first result