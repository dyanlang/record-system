$(function(){
    $('#simpleBtn').click(function(){
      Tour.run([
        {
          //LOGIN STEP
          step: 1,
          target: "#login_id_login",
          element: $('#login_id_login'),
          content: '<strong>Username: </strong>Input Username of User Account',
          position: 'bottom',
        },
        {
          step: 2,
          element: $('#password_id_login'),
          content: '<strong>Password: </strong>Enter Your Account Password',
          position: "bottom",
        },
        {
            step: 3,
            element: $('#forgoting_password_id_login'),
            content: 'Forgot your password?, <strong>Recover It</strong>',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#remember_id_login'),
            content: '<strong>Remember:</strong> Your Credential, Just Click Check!',
            position: 'top'
        },
        {
          step: 5,
            element: $('#login_button_id_login'),
            content: '<strong>Click! </strong>Login Button',
            position: 'bottom'
        },
        //MEMBER STEP
        {
          step: 1,
            element: $('#navigation_dashboard'),
            content: '<strong>Navigation Bar: </strong>Includes of Dashboard, <i>Home, Pending Request, Settings, Logout</i>',
            position: 'right'
        },
        {
          step: 2,
            element: $('#live_notification_dashboard'),
            content: '<strong>Live Notifications: </strong>To see the details of the live notification, the user opens the notification bell to see activity in system</i>',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#admin_profile_dashboard'),
            content: '<strong>Dropdown Menu: </strong> <i>Click Need Help?</i> the Tour Guide Plugin Appeared',
            position: 'bottom'
        },
        // PROFILE
        {
          step: 1,
            element: $('#profile_picture_online_payment'),
            content: '<strong>Online Payment Button: </strong>Click Online Payment Button to display the Records of Online Payment',
            position: 'bottom'
        },
        {
          step: 1,
            element: $('#profile_picture_member_profile'),
            content: '<strong>Profile Picutre: </strong>Display the profile picture of user',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#add_tithes_member_profile'),
            content: '<strong>Add Tithes and Offerings: </strong>Add and Input Records of Tithes and Offerings',
            position: 'top'
        },
        {
          step: 2,
            element: $('#add_tithes_member_profile_payment_button'),
            content: '<strong>Payment Transaction: </strong>Click Payment Transaction Button to add records of Tithes and Offerings',
            position: 'top'
        },
        {
          step: 3,
            element: $('#tithes_amount_member_profile'),
            content: '<strong>Add Tithes Amount: </strong>Input and Add Desire Tithes Amount',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#offering_plan_amount_member_profile'),
            content: '<strong>Add Offering Plan Amount: </strong>Input and Add Desire Offering Plan Amount',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#offering_gifts_amount_member_profile'),
            content: '<strong>Add Other Gifts Amount: </strong>Input Add and Others Gifts Amount',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#descripton_member_profile'),
            content: '<strong>Add Description: </strong>Type a Description about of Tithes and Offerings you added',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#type'),
            content: '<strong>Select Type: </strong>Select Type<i>Cash, Online Payment, Specify</i>',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#add_date_member_profile'),
            content: '<strong>Select Date: </strong>Select and Choose Date of Tithes and Offerings',
            position: 'bottom'
        },
        /////////// ADD DATE
        {
          step: 8,
            element: $('#submit_button_member_profile'),
            content: '<strong>Submit Button: </strong>Click Button Submit if you add Tithes and Offerings',
            position: 'bottom'
        },
        //MY TITHES AND OFFERINGS CONTRIBUTION
        {
          step: 9,
            element: $('#datefrom_member_profile'),
            content: '<strong>Select Date From: </strong>Select date from the date of records',
            position: 'bottom'
        },
        {
          step: 10,
            element: $('#dateto_member_profile'),
            content: '<strong>Select Date To: </strong>Select date to the date of Records',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#search_button_member_profile'),
            content: '<strong>Search Button: </strong>Search Button to display Record',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#search_bar_member_profile'),
            content: '<strong>Search Bar: </strong>Search the specific user or data in the search bar',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#list_of_record_member_profile'),
            content: '<strong>List of Record: </strong>List of Record of Tithes and Offerings of Member',
            position: 'top'
        },
        //TITHES AND OFFERINGS REQUESTS
        {
          step: 1,
            element: $('#list_pending_request'),
            content: '<strong>Pending Request: </strong>List of Pending of Request Records that need to approved by Admin',
            position: 'top'
        },
        {
          step: 2,
            element: $('#goback_pending_request'),
            content: '<strong>Go Back: </strong>Go back to the recent page',
            position: 'bottom'
        },
        //Personal Info
        {
          step: 1,
            element: $('#profile_picture_settings'),
            content: '<strong>Profile Picture: </strong>Display Profile Picture of Member',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#upload_button_settings'),
            content: '<strong>Change Profile Picture: </strong>Click Change Profile Picture Button to Update your profile picture',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#change_password_settings'),
            content: '<strong>Change Password Button: </strong>Click Change Password to change your password',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#retrieve_email_settings'),
            content: '<strong>On/Off Recieve Email: </strong>Click On to allowed to Receive Email Notification, Off when not allowed to receive notification email',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#profile_information_settings'),
            content: '<strong>Profile Information: </strong>Edit and Update your Profile Information',
            position: 'top'
        },
        {
          step: 6,
            element: $('#save_button_settings'),
            content: '<strong>Save Button: </strong>Click Save Button to save your information and update',
            position: 'top'
        },
        {
          step: 7,
            element: $('#goback_settings'),
            content: '<strong>Go Back: </strong>Go back to the recent page',
            position: 'bottom'
        },
      ]);
    });
  });