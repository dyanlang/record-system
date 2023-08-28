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
        //DASHBOARD STEP
        {
          step: 1,
            element: $('#navigation_dashboard'),
            content: '<strong>Navigation Bar: </strong>Includes of Dashboard, Tithes & Offerings, Church Member List, Disbursement, Trash',
            position: 'right'
        },
        {
          step: 2,
            element: $('#search_dashboard'),
            content: '<strong>Search Bar: </strong>Search Where do you want? <i>Example: Offering</i>',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#live_notification_dashboard'),
            content: '<strong>Notifications: </strong>Live Notifications of many activity in a system</i>',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#admin_profile_dashboard'),
            content: '<strong>Dropdown Menu: </strong>You can update your <i>Profile, Settings</i>, and <i>Logout</i>',
            position: 'bottom'
        },
        // {
        //   step: 5,
        //     element: $('#card_members_dashboard'),
        //     content: '<strong>Record of Members: </strong>You can see the total number of church member',
        //     position: 'bottom'
        // },
        {
          step: 6,
            element: $('#card_tithes_dashboard'),
            content: '<strong>Record of Tithes: </strong>You can see the monthly tithes',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#card_offerings_offerings_dashboard'),
            content: '<strong>Record of Offerings: </strong>You can see the monthly offerings',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#card_othergifts_dashboard'),
            content: '<strong>Others Gift: </strong>You can see the others gifts',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#card_sabbath_dashboard'),
            content: '<strong>Sabbath Offerings: </strong>You can see the monthly Sabbath Offerings',
            position: 'bottom'
        },
         {
          step: 9,
            element: $('#card_totalaverage_dashboard'),
            content: '<strong>Total Average: </strong>You can see the total Average of All',
            position: 'bottom'
        },
        //GRAPH
        {
          step: 10,
            element: $('#card_tithes_overview_dashboard'),
            content: '<strong>Tithes Overview: </strong>Overview of tithes in graph  ',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#card_offerings_overview_dashboard'),
            content: '<strong>Offerings Overview: </strong>Overview of offerings in graph  ',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#card_others_overview_dashboard'),
            content: '<strong>Others Overview: </strong>Overview of others gift in graph  ',
            position: 'bottom'
        },
        //PIE
        {
          step: 13,
            element: $('#card_disbursement_overview_dashboard'),
            content: '<strong>Disbursement Overview: </strong>Pie graph and overview of different department of disbursement ',
            position: 'bottom'
        },
        {
          step: 14,
            element: $('#card_recent_disbursement_dashboard'),
            content: '<strong>Recent Disbursement: </strong>List of Recent add of Disbursement',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#card_view_all_disbursement_dashboard'),
            content: '<strong>View All: </strong>View All of Disbursement',
            position: 'bottom'
        },
        //CONTRIBUTOR
        {
          step: 16,
            element: $('#card_first_contributor_dashboard'),
            content: '<strong>Summary Contributor: </strong>list of First time contributor',
            position: 'bottom'
        },
        {
          step: 17,
            element: $('#card_recent_contributor_dashboard'),
            content: '<strong>Recent Contributor: </strong>list of Recent of contributor',
            position: 'bottom'
        },
        {
          step: 18,
            element: $('#card_frequent_contributor_dashboard'),
            content: '<strong>Frequent Contributor: </strong>list of Frequent of contributor',
            position: 'bottom'
        },
        {
          step: 19,
            element: $('#card_lapsed_contributor_dashboard'),
            content: '<strong>Lapsed Contributor: </strong>list of Lapsed of contributor',
            position: 'bottom'
        },
        //OFFICER, MEMBERS, USER ACTIVITY
        {
          step: 20,
            element: $('#card_officer_dashboard'),
            content: '<strong>Officer: </strong>list of Officer in Church',
            position: 'top'
        },
        {
          step: 21,
            element: $('#card_members_members_dashboard'),
            content: '<strong>Members: </strong>list of Members in Church',
            position: 'top'
        },
        {
          step: 22,
            element: $('#card_user_activity_dashboard'),
            content: '<strong>User Activity: </strong>list of active status of user',
            position: 'top'
        },
      ]);
    });
  });
  