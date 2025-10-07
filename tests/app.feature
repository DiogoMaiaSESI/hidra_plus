Describe: User Registration Validation
    Scenario: Registration with valid credentials
        Given that I am on the registration page,
        When I determine that the User_fullname variable corresponds to Bia Mota
        And the Email variable stores bia@example.com
        And the Password variable stores 133 as the corresponding value
        And the Confirm Password variable receives 133 as the corresponding value,
        Then it is "asserted" that the entered data matches the data in the database. 

    Scenario: Registration with an Email Address Already Used
        Given that I am on the registration page,
        When I determine that the User_fullname variable corresponds to Chata Mota
        And the Email variable stores bia@example.com
        And the Password variable stores 133 as the corresponding value
        And the Confirm Password variable receives 133 as the corresponding value
        Then it is assumed that the error message returned is "This email address is already registered.

    
Describe: Login Validation
    Scenario: Login with valid credentials
        Given that I am on the login page
        And the Email variable stores bia@example.com
        And the password variable stores 133 as the corresponding value
        Then it is asserted that the entered data is compared and confirmed with the data provided during the user's registration, which is in the database.

    Scenario: Login with invalid credentials
        Given that I am on the login page
        When the variable email stores the value bia@example.com
        And the variable password stores the value 132
        Then it is asserted (assertFalse) that the password used does not match the registered password, since the condition of password 132 being equal to the registered password (133) would never be true.


Describe: Water consumption calculation validation
    Scenario: Insertion of invalid data for water calculation
        Given that I am on the daily water calculation page
        When the variable weight stores the value -55
        Then it is asserted that the returned error message is equal to “Weight must contain positive values.
    
    Scenario: Water calculation with empty field
        Given that I am on the daily water calculation page
        When the variable weight stores no value
        Then it is asserted that the returned error message is equal to “Please enter your weight to obtain your daily water intake.

    Scenario: Daily water calculation
        Given that I am on the daily water calculation page
        When the variable weight stores the value 55
        Then it is asserted that the result stored in the database is equal to the value of the variable result
        And it is asserted that the returned message is equal to “The adequate daily water intake is: 1.93.

    Scenario: Saving the Daily Water Calculation
        Given that I am on the daily water calculation page
        And the weight variable receives the value corresponding to 55
        When the calculation is performed correctly
        Then the asserted result must be saved to the database.
