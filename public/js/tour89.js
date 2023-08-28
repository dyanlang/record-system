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
            content: '<strong>Search Bar: </strong>Search bar Where do you want to go? <i>Example: Offering</i>',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#live_notification_dashboard'),
            content: '<strong>Notifications: </strong>To see the details of the live notification, the user opens the notification bell to see activity in system.</i>',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#admin_profile_dashboard'),
            content: '<strong>Dropdown Menu: </strong>You can update your <i>Profile, Settings</i>, and <i>Logout</i>',
            position: 'bottom'
        },
        //CARD
        {
          step: 5,
            element: $('#card_membering_dashboard'),
            content: '<strong>Number of Members: </strong>You can see the total average number of church member and the average of new member',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#card_tithes_dashboard'),
            content: '<strong>Montly Tithes: </strong>You can see the total average of monthly tithes and the total percentage was added',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#card_offerings_offerings_dashboard'),
            content: '<strong>Montly Offerings: </strong>You can see the total average of monthly offerings and the total percentage was added',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#card_othergifts_dashboard'),
            content: '<strong>Others Gift: </strong>Display the total average of others gift in tithes and offerings and the total percentage of added',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#card_sabbath_dashboard'),
            content: '<strong>Monthly Sabbath Offerings: </strong>Display the total average of Sabbath offerings monthly and the total percentage of added offerings',
            position: 'bottom'
        },
         {
          step: 9,
            element: $('#card_totalaverage_dashboard'),
            content: '<strong>Total Average: </strong>Over all average of computation in Sabbath, Other Gifts, Tithes and Offerings',
            position: 'bottom'
        },
        //GRAPH
        {
          step: 10,
            element: $('#card_monthly_average_dashboard'),
            content: '<strong>Montly Average Disbursement: </strong>In graph the monthly average of Disbursement including of Monthly Disbursement, Monthly Average, and Monthly Total',
            position: 'top'
        },
        {
          step: 10,
            element: $('#card_tithes_overview_dashboard'),
            content: '<strong>Tithes Overview: </strong>Displaying Tithes Graph and the total average amount of record every Montly',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#card_offerings_overview_dashboard'),
            content: '<strong>Offerings Overview: </strong>Displaying Offerings Graph and the total average amount of record every Monthly',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#card_others_overview_dashboard'),
            content: '<strong>Others Overview: </strong>Displaying Others Gifts total in graph to see the average amount of record every Monthly',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#card_sabbath_overview_dashboard'),
            content: '<strong>Sabbath Overview: </strong>Displaying Sabbath Offering in graph to see the total average amount of record every Monthly',
            position: 'bottom'
        },
        //PIE
        {
          step: 13,
            element: $('#card_disbursement_overview_dashboard'),
            content: '<strong>Disbursement Overview: </strong>Displaying the Disbursement Overview Using Pie graph to determine which department have many amount of Disbursement',
            position: 'bottom'
        },
        {
          step: 14,
            element: $('#card_recent_disbursement_dashboard'),
            content: '<strong>Recent Disbursement: </strong>Displaying the list of Records of recent disbursement.',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#card_view_all_disbursement_dashboard'),
            content: '<strong>View All: </strong>Click View All button to see the all records of Disbursement',
            position: 'bottom'
        },
        //CONTRIBUTOR
        {
          step: 16,
            element: $('#card_first_contributor_dashboard'),
            content: '<strong>First-Time Contributor: </strong>Records of First-Time contributor of tithes and offerings and when they are contribute',
            position: 'bottom'
        },
        {
          step: 17,
            element: $('#card_recent_contributor_dashboard'),
            content: '<strong>Recent Contributor: </strong>Records of Recent User that contribute in tithes and offerings',
            position: 'bottom'
        },
        {
          step: 18,
            element: $('#card_frequent_contributor_dashboard'),
            content: '<strong>Frequent Contributor: </strong>Records of User that often or frequently contribute in tithes and offerings',
            position: 'bottom'
        },
        {
          step: 19,
            element: $('#card_lapsed_contributor_dashboard'),
            content: '<strong>Lapsed Contributor: </strong>Record of User that doesnt often contribute in tithes and offerings',
            position: 'bottom'
        },
        //OFFICER, MEMBERS, USER ACTIVITY
        {
          step: 20,
            element: $('#card_officer_dashboard'),
            content: '<strong>Officer: </strong>Record and list of Officer in Church',
            position: 'top'
        },
        {
          step: 21,
            element: $('#card_members_members_dashboard'),
            content: '<strong>Members: </strong>Record and list of Members in Church',
            position: 'top'
        },
        {
          step: 22,
            element: $('#card_user_activity_dashboard'),
            content: '<strong>User Activity: </strong>Record and list of active status of user',
            position: 'top'
        },
        //TITHES AND OFFERINGS
        //BUTTON
        {
          step: 1,
            element: $('#button_onlinepayment_tithes_offerings'),
            content: '<strong>Online Payment Details: </strong>If you click Online Payment Button you direct to the record of online payment',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#button_pendinglist_tithes_offerings'),
            content: '<strong>Pending List: </strong>If you click you Co-Admin Pending Button you can see the pending request of Co-Admin',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#button_forapproval_tithes_offerings'),
            content: '<strong>Approval List: </strong>If you click For Approval List Button you direct to the list of record that need to approve',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#button_churchmemberrequest_tithes_offerings'),
            content: '<strong>Church Member Request: </strong>If you click the Member Request Button you can see the record of member that need to approve',
            position: 'bottom'
        },
        // BUTTON CO ADMIN
        {
          step: 1,
            element: $('#button_forapproval_tithes_offerings_co_admin'),
            content: '<strong>For Approval: </strong>If you click you can see the list of approval list of tithes and offerings',
            position: 'bottom'
        },
        //ADD NEW RECORD
        {
          step: 5,
            element: $('#add_selectmember_tithes_offerings'),
            content: '<strong>Select Member: </strong>Choose and Select Member',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#add_tithes_tithes_offerings'),
            content: '<strong>Tithes Amount: </strong>Input amount of tithes',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#add_offerings_tithes_offerings'),
            content: '<strong>Offerings Amount: </strong>Input amount of offerings',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#add_othersgift_tithes_offerings'),
            content: '<strong>Others Gift: </strong>Input amount of gift',
            position: 'bottom'
        },
        {
          step: 9,
            element: $('#specify'),
            content: '<strong>Description: </strong>Description of tithes and offerings if dont have descrition choose none',
            position: 'bottom'
        },
        {
          step: 10,
            element: $('#type'),
            content: '<strong>Type of Tithes and Offerings: </strong>Type of Tithes and offerings if this is Cash, Online Payment or other type that need to specify',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#add_date_tithes_offerings'),
            content: '<strong>Select Date: </strong>Select Date when Tithes and Offerings issued',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#add_button_add_tithes_offerings'),
            content: '<strong>Add Button: </strong>Click add Button when you done input credentials',
            position: 'bottom'
        },
        //All Records
        {
          step: 13,
            element: $('#list_searchfrom_tithes_offerings'),
            content: '<strong>Select Date From: </strong>Select date from the date of records',
            position: 'bottom'
        },
        {
          step: 14,
            element: $('#list_searchto_tithes_offerings'),
            content: '<strong>Date to: </strong>Select date to the date of Records',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#list_search_button_tithes_offerings'),
            content: '<strong>Search Button: </strong>Click Search Button to search data in the date you select',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#list_generatepdf_tithes_offerings'),
            content: '<strong>Export PDF Button: </strong>Click EXPORT PDF button to Generated Report PDF of tithes and offerings in the date you select',
            position: 'bottom'
        },
        //SEARCH BAR
        {
          step: 16,
            element: $('#search_tithes_offerings'),
            content: '<strong>Search Bar: </strong>Search the specific user or data in the search bar',
            position: 'bottom'
        },
        //TITHES AND OFFERINGS LIST
        {
          step: 17,
            element: $('#add_records_tithes_offerings'),
            content: '<strong>All Records of Tithes and Offerings: </strong>List of Record of member in tithes and Offerings',
            position: 'top'
        },
        //DROPDOWN
        {
          step: 18,
            element: $('#dropdown_tithes_offerings'),
            content: '<strong>Dropdown list: </strong>List of <i>View, Edit, Move to Trash and Revision History</i>',
            position: 'bottom'
        },
        //ONLINE PAYMENT DETAILS TITHES AND OFFERNGS
        {
          step: 19,
            element: $('#gcash_bank_list_online_payments'),
            content: '<strong>Gcash/Bank Records list: </strong>Displaying of Records of Online payment thru Gcash/Bank Records',
            position: 'right'
        },
        {
          step: 20,
            element: $('#gcash_bank_list__record_online_payments'),
            content: '<strong>Gcash/Bank Records: </strong>Display the recent record of Online Payment Details in tithes and offerings, <i>Instruction</i> if you want to Click Visible/Hide Button to change into Visible or Hide the Records, Click Remove Button to remove the records of Gcash/Bank in Tithes and Offerings',
            position: 'bottom'
        },

        // {
        //   step: 20,
        //     element: $('#gcash_bank_list_view_button_record_online_payments'),
        //     content: '<strong>Visible/Hide Button: </strong>Click Visible/Hide Button to change into Visible or Hide the Records',
        //     position: 'bottom'
        // },

        // {
        //   step: 20,
        //     element: $('#gcash_bank_list_view_remove_record_online_payments'),
        //     content: '<strong>Remove Button: </strong>Click Remove Button to remove the records of Gcash/Bank in Tithes and Offerings',
        //     position: 'bottom'
        // },

        //ADD PAYMENT
        {
          step: 21,
            element: $('#gcash__bank_add_payment_online_payments'),
            content: '<strong>Add Gcash/Bank Records: </strong>Add Records of Online Payment its either Gcash/Bank payments',
            position: 'right'
        },
        {
          step: 22,
            element: $('#gcash__bank_credentials_online_payments'),
            content: '<strong>Gcash/Bank Add Credentials: </strong>Add and input Credentials of Gcash/Bank',
            position: 'top'
        },
        {
          step: 23,
            element: $('#gcash_bank_button_submit_online_payments'),
            content: '<strong>Submit Button: </strong>Click Submit Button if you done and want to add records',
            position: 'bottom'
        },
        {
          step: 24,
            element: $('#gcash_bank_goback_online_payments'),
            content: '<strong>Go Back: </strong>Click Go Back button to the recent page',
            position: 'bottom'
        },
        //Tithes & Offerings / Pending List co admin
        {
          step: 25,
            element: $('#list_pending_co_admin'),
            content: '<strong>Pending List: </strong>List of Records of Pending in tithes and Offerings',
            position: 'bottom'
        },
        {
          step: 26,
            element: $('#list_pending_view_co_admin'),
            content: '<strong>View Request Button: </strong>Click View Request button to view the user request and the details about tithes and offerings',
            position: 'bottom'
        },
        {
          step: 27,
            element: $('#list_approved_view_co_admin'),
            content: '<strong>Approved Request Button: </strong>Click Mark as Approved Button to tell the pending records are approve',
            position: 'bottom'
        },
        {
          step: 28,
            element: $('#list_goback_view_co_admin'),
            content: '<strong>Go Back: </strong>Click Go back to go to recent page',
            position: 'bottom'
        },
        //Tithes & Offerings / CO-ADMIN APPROVAL REQUESTS
        {
          step: 27,
            element: $('#approval_list_approval_payments'),
            content: '<strong>Approval Request: </strong>List of Record of Approval Request of Co-Admin that needs to review for approval',
            position: 'bottom'
        },
        {
          step: 28,
            element: $('#approval_mark_as_review_approval_payments'),
            content: '<strong>Mark as Review: </strong>Click Mark as Reviewed Button for the request of Co-Admin is set to Reviewed',
            position: 'bottom'
        },
        {
          step: 29,
            element: $('#approval_list_goback_payments'),
            content: '<strong>Go Back: </strong>Click Go back to the recent page',
            position: 'bottom'
        },
        //Tithes & Offerings / CHURCH MEMBER REQUESTS
        {
          step: 29,
            element: $('#request_church_member_list'),
            content: '<strong>Member Request: </strong>Church Member Records Request that need to approve',
            position: 'bottom'
        },
        {
          step: 30,
            element: $('#approved_church_member_list'),
            content: '<strong>Approved Button: </strong>Click Approved Button if the request of Member are approve',
            position: 'bottom'
        },
        {
          step: 31,
            element: $('#decline_church_member_list'),
            content: '<strong>Decline Button: </strong>Click Decline Button if the request of Member does not match in record',
            position: 'bottom'
        },
        {
          step: 32,
            element: $('#goback_church_member_list'),
            content: '<strong>Go Back: </strong>Click Go back to the recent page',
            position: 'bottom'
        },
        // TITHES AND OFFERINGS View Details
        {
          step: 33,
            element: $('#name_contributor_view_details'),
            content: '<strong>Name of Contributor: </strong>Full Name of Contributor',
            position: 'bottom'
        },
        {
          step: 34,
            element: $('#tithes_amount_view_details'),
            content: '<strong>Tithes: </strong>Record Amount of Tithes',
            position: 'bottom'
        },
        {
          step: 35,
            element: $('#offerings_view_details'),
            content: '<strong>Offerings: </strong>Record Amount of Offerings',
            position: 'bottom'
        },
        {
          step: 36,
            element: $('#others_gift_view_details'),
            content: '<strong>Others Gift: </strong>Record Amount of Others Gift',
            position: 'bottom'
        },
        {
          step: 37,
            element: $('#requested_date_view_details'),
            content: '<strong>Request Date: </strong>Date create a Request',
            position: 'bottom'
        },
        {
          step: 38,
            element: $('#status_view_details'),
            content: '<strong>Status: </strong>Record Status of Request',
            position: 'bottom'
        },
        {
          step: 39,
            element: $('#added_by_view_details'),
            content: '<strong>Added by: </strong>Record Added by the User of Church',
            position: 'bottom'
        },
        {
          step: 40,
            element: $('#request_approved_view_details'),
            content: '<strong>Request Date: </strong>Record Date when approved request',
            position: 'bottom'
        },
        {
          step: 41,
            element: $('#description_view_details'),
            content: '<strong>Description: </strong>Record Description of tithes',
            position: 'bottom'
        },
        {
          step: 42,
            element: $('#edit_view_details'),
            content: '<strong>Edit Button: </strong>Click Button to Edit or Modify the record of tithes and offerings',
            position: 'bottom'
        },
        {
          step: 43,
            element: $('#remove_view_details'),
            content: '<strong>Remove Button: </strong>Click Remove Button to remove records of tithes and offerings',
            position: 'bottom'
        },
        {
          step: 44,
            element: $('#goback_view_details'),
            content: '<strong>Go Back: </strong>Click Go back to back to the recent page',
            position: 'bottom'
        },
        //EDIT TITHE DETAILS
        {
          step: 45,
            element: $('#contributor_name_edit_details'),
            content: '<strong>Contributor Name: </strong>name of Contributor',
            position: 'bottom'
        },
        {
          step: 46,
            element: $('#tithes_amount_edit_details'),
            content: '<strong>Tithes: </strong>Update Record of Tithes Amount',
            position: 'bottom'
        },
        {
          step: 47,
            element: $('#offerings_edit_details'),
            content: '<strong>Offerings: </strong>Update Record of Offerings Amount',
            position: 'bottom'
        },
        {
          step: 48,
            element: $('#others_gift_edit_details'),
            content: '<strong>Others Gift: </strong>Update Record of Others Gift Amount',
            position: 'bottom'
        },
        {
          step: 49,
            element: $('#description_edit_details'),
            content: '<strong>Description: </strong>Description about Tithes and Offerings',
            position: 'bottom'
        },
        {
          step: 50,
            element: $('#type_edit_details'),
            content: '<strong>type: </strong>Type of Tithes and Offerings<li>Cash, Online Payment, Check and None</li>',
            position: 'bottom'
        },
        {
          step: 50,
            element: $('#save_edit_details'),
            content: '<strong>Save Edit: </strong>Click Save Icon button to save the updated Records of Tithes and Offerings',
            position: 'bottom'
        },
        {
          step: 51,
            element: $('#go_back_edit_details'),
            content: '<strong>Go back: </strong>Click Go back to back to the recent page',
            position: 'bottom'
        },
        //Revision History
        {
          step: 52,
            element: $('#list_revision_history'),
            content: '<strong>Revision History List: </strong>List Record of Revision History of Tithes and Offerings',
            position: 'bottom'
        },
        {
          step: 53,
            element: $('#goback_revision_history'),
            content: '<strong>Go back: </strong>Click Go back to the recent page',
            position: 'bottom'
        },
        //Sabbath Offering
        {
          step: 1,
            element: $('#pending_list_sabbath_offerings_pending'),
            content: '<strong>Pending List Button: </strong>Click Pending List Button to see all the pending list of sabbath offerings',
            position: 'bottom'
        },
        {
            //description_sabbath_offerings
          step: 2,
            element: $('#specify1'),
            content: '<strong>Choose Description: </strong>Description of Sabbath Offerings to<i>None</i> and Specify Description',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#sabbath_sabbath_offerings'),
            content: '<strong>Sabbath Offering: </strong>Input Amount of Sabbath Offering',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#type1'),
            content: '<strong>Select Type: </strong>Select cash type of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#type_date_sabbath_offerings'),
            content: '<strong>Select Date: </strong>Choose Date when the Sabbath Offerings created',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#button_submit_sabbath_offerings'),
            content: '<strong>Add Button: </strong>Click Add Button if you want to add Record of Sabbath Offerings',
            position: 'bottom'
        },
        //All Records
        {
          step: 6,
            element: $('#datefrom_sabbath_offerings'),
            content: '<strong>Select Date: </strong>Select Date From this Date to view a record of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#dateto_sabbath_offerings'),
            content: '<strong>Select Date: </strong>Select Date To this Date to view a record of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#search_button_sabbath_offerings'),
            content: '<strong>Search Button: </strong> Search date to this date from this to generate report',
            position: 'bottom'
        },
        {
          step: 9,
            element: $('#generated_report_sabbath_offerings'),
            content: '<strong>Export PDF button: </strong>Click Export PDF button to generate report in the selected date',
            position: 'bottom'
        },
        {
          step: 10,
            element: $('#search_bar_sabbath_offerings'),
            content: '<strong>Search Bar: </strong>Search specific user or data in Search Bar',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#list_sabbath_offerings'),
            content: '<strong>Record of Sabbath: </strong> list of information of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#dropdown_sabbath_offerings'),
            content: '<strong>Dropdown Menu: </strong> list of dropdown menue <i>View, Edit, Move to Trash, Revision History</i>',
            position: 'bottom'
        },
        //SABBATH OFFERING INFORMATION
        {
          step: 13,
            element: $('#description_sabbath_offerings_view'),
            content: '<strong>Description: </strong>Record Description about sabbath offerings',
            position: 'bottom'
        },
        {
          step: 14,
            element: $('#offering_sabbath_offerings_view'),
            content: '<strong>Offering Amount: </strong>Record Amount of sabbath offerings',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#requestdate_sabbath_offerings_view'),
            content: '<strong>Request Date: </strong>Record requested sabbath offerings',
            position: 'bottom'
        },
        {
          step: 16,
            element: $('#status_sabbath_offerings_view'),
            content: '<strong>Status: </strong>Record Status of sabbath offerings',
            position: 'bottom'
        },
        {
          step: 17,
            element: $('#addedby_sabbath_offerings_view'),
            content: '<strong>Added by: </strong>Record Added By User',
            position: 'bottom'
        },
        {
          step: 18,
            element: $('#requestapproved_sabbath_offerings_view'),
            content: '<strong>Approved Date: </strong>Record of Approving Date of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 19,
            element: $('#edit_button_sabbath_offerings_view'),
            content: '<strong>Edit Button: </strong>Click Edit Button to update and modify the record of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 20,
            element: $('#remove_button_sabbath_offerings_view'),
            content: '<strong>Remove Button: </strong>Click Remove Button to remove a record from Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 21,
            element: $('#goback_sabbath_offerings_view'),
            content: '<strong>Go Back: </strong>Click Go back to recent page',
            position: 'bottom'
        },
        //EDIT SABBATH OFFERING DETAILS
        {
          step: 22,
            element: $('#offering_amount_sabbath_offerings_edit'),
            content: '<strong>Offering Plan Amount: </strong>Update the Offering Amount of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 23,
            element: $('#description_sabbath_offerings_edit'),
            content: '<strong>Description: </strong>Update Description about of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 24,
            element: $('#type_sabbath_offerings_edit'),
            content: '<strong>Select Type: </strong>Select Type cash of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 24,
            element: $('#save_button_sabbath_offerings_edit'),
            content: '<strong>Save Button: </strong>Click Save button to save update credentials in Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 24,
            element: $('#goback_sabbath_offerings_edit'),
            content: '<strong>Go back: </strong>Click Go back to the recent page',
            position: 'bottom'
        },
        //SABBATH REVISION HISTORY
        {
          step: 25,
            element: $('#list_sabbath_revision_history'),
            content: '<strong>Revision History List: </strong>Record List of Revision History when have changes in records on Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 26,
            element: $('#goback_sabbath_revision_history'),
            content: '<strong>Go back: </strong>Go back to the recent page',
            position: 'bottom'
        },
        //Sabbath Offerings / Pending List
        {
          step: 27,
            element: $('#list_sabbath_pending_list'),
            content: '<strong>Pending List: </strong>Record Pending List of Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 27,
            element: $('#approve_sabbath_pending_list'),
            content: '<strong>Approved Button: </strong>Click Approved Button to approved request on Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 28,
            element: $('#decline_sabbath_pending_list'),
            content: '<strong>Decline Button: </strong>Click Decline Button to decline request on Sabbath Offerings',
            position: 'bottom'
        },
        {
          step: 29,
            element: $('#goback_sabbath_pending_list'),
            content: '<strong>Go back: </strong>Go back to the recent page',
            position: 'bottom'
        },
        //Church Members List
        {
          step: 1,
            element: $('#church_member_list_add_member'),
            content: '<strong>Add Member: </strong>Click Add member button to add church member',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#church_member_datefrom'),
            content: '<strong>Select Date: </strong>Select Date From to this date to view Records of Church Member',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#church_member_dateto'),
            content: '<strong>Date To: </strong>Select Date To this date to view Records of Church Member',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#church_member_search_button'),
            content: '<strong>Search Button: </strong>Click Search Button to display on selected date Record of Church Member',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#church_member_export_pdf'),
            content: '<strong>Export PDF Button: </strong>Click Export PDF Button to generate report of Record of Church Member',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#church_member_search_bar'),
            content: '<strong>Search Bar: </strong>Search user or values in search bar on Church Member',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#church_member_list_record'),
            content: '<strong>Church Member Record: </strong>List of Record of Church Member',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#church_member_dropdown_menu'),
            content: '<strong>Dropdown Menu: </strong>Dropdown Menu list of <i>View, Edit</i>',
            position: 'bottom'
        },
        //VIEW USER PROFILE
        {
          step: 9,
            element: $('#profile_pic_church_member_view'),
            content: '<strong>User Profile Picture: </strong>Display Profile picture of User',
            position: 'bottom'
        },
        {
          step: 10,
            element: $('#profile_information_church_member_view'),
            content: '<strong>Profile Information: </strong>Display basic Information of User',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#profile_login_activity_church_member_view'),
            content: '<strong>Login Activity: </strong>You can see the login activity of User',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#profile_datefrom_church_member_view'),
            content: '<strong>Select Date: </strong>Select Date From this date to view a record of Church Member',
            position: 'bottom'
        },
        {
          step: 13,
            element: $('#profile_dateto_church_member_view'),
            content: '<strong>Date To: </strong>Select Date To this date to view a record of Church Member',
            position: 'bottom'
        },
        {
          step: 14,
            element: $('#search_btn_church_member_view'),
            content: '<strong>Search Button: </strong>Click Search button to display record by selecting date of Church Member',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#export_pdf_church_member_view'),
            content: '<strong>Export PDF Button: </strong>Click Export PDF button to generate report of record Church Member',
            position: 'bottom'
        },
        {
          step: 16,
            element: $('#record_church_member_view'),
            content: '<strong>Recorded History: </strong>Displaying Record of Tithes and Offerings of Church Member',
            position: 'top'
        },
        //EDIT MEMBER DETAILS
        {
          step: 17,
            element: $('#profile_picture_church_member_edit'),
            content: '<strong>Profile Picture of Member: </strong>Profile Picture of Church Member',
            position: 'bottom'
        },
        {
          step: 18,
            element: $('#deactive_activate_button_church_member_edit'),
            content: '<strong>Deactivate/Activate Button: </strong>Click Deactivate/Activate Button if you want to deactive or Deactivate a member',
            position: 'bottom'
        },
        {
          step: 19,
            element: $('#members_information_church_member_edit'),
            content: '<strong>Members Information: </strong>Displaying Record of Members Information to need update',
            position: 'top'
        },
        {
          step: 20,
            element: $('#save_button_church_member_edit'),
            content: '<strong>Save Button: </strong>Click Save Button if you done edit and modify to save credentials',
            position: 'bottom'
        },
        {
          step: 21,
            element: $('#goback_church_member_edit'),
            content: '<strong>Go back: </strong>Go back to the recent page',
            position: 'bottom'
        },
        //Disbursement / Pending List RECORD
        {
          step: 1,
            element: $('#list_disbursement_report_pending_list'),
            content: '<strong>Pending List: </strong>Click Pending List Button to see the pending request of Disbursement',
            position: 'bottom'
        },
        ///////////////////////////////////
        {
          step: 1,
            element: $('#list_disbursement_report_pending_list_record'),
            content: '<strong>Disbursement Pending List: </strong>Pending List of Disbursement and information of status <i>Pending, Needs Review</i>',
            position: 'top'
        },
        {
          step: 2,
            element: $('#list_disbursement_report_pending_goback'),
            content: '<strong>Go back: </strong>Go back to the recent page',
            position: 'bottom'
        },

        //DISBURSEMENT ADD NEW RECORD
        {
          step: 1,
            element: $('#type3'),
            content: '<strong>Department: </strong>Choose Department and Add for Disbursement',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#amount_disbursement_report'),
            content: '<strong>Amount of Disbursement: </strong>Add Input Amount of Disbursement',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#description_disbursement_report'),
            content: '<strong>Description of Disbursement: </strong>Add Description about Disbursement',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#Status_other'),
            content: '<strong>Status of Disbursement: </strong>Add and Select Status of Disbursement<i>Approved, Pending, Needs Review, Others</i>',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#date_disbursement_report'),
            content: '<strong>Select Date: </strong>Select Date when the disbursement record created',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#add_button_disbursement_report'),
            content: '<strong>Add Button: </strong>Click Add Button to add new record in Disbursement',
            position: 'bottom'
        },
                {
          step: 7,
            element: $('#datefrom_disbursement_report'),
            content: '<strong>Date From: </strong>Select Date From To this date in Disbursement',
            position: 'bottom'
        },
        {
          step: 8,
            element: $('#dateto_disbursement_report'),
            content: '<strong>Date To: </strong>Select Date From From this date in Disbursement',
            position: 'bottom'
        },
        {
          step: 9,
            element: $('#search_button_disbursement_report'),
            content: '<strong>Search Button: </strong>Click Search button from selected date to display record of Disbursement',
            position: 'bottom'
        },
        {
          step: 10,
            element: $('#export_pdf_disbursement_report'),
            content: '<strong>Export PDF Button: </strong>Click Export PDF button to generate report of Disbursement',
            position: 'bottom'
        },
        {
          step: 11,
            element: $('#search_bar_disbursement_report'),
            content: '<strong>Search Bar: </strong>Search specific user or data in search bar of Disbursement',
            position: 'bottom'
        },
        {
          step: 12,
            element: $('#list_record_disbursement_report'),
            content: '<strong>List of Disbursement: </strong>List of Record and Information of Disbursement',
            position: 'bottom'
        },
        {
          step: 13,
            element: $('#dropdown_menu_disbursement_report'),
            content: '<strong>Dropdown Menu: </strong>dropdown menu <i>View, Edit, Move to Trash and Revision History</i>',
            position: 'bottom'
        },
        //View Disbursement Details
        {
          step: 14,
            element: $('#department_disbursement_view'),
            content: '<strong>Disbursement Department: </strong>Record Department View of Disbursement Details',
            position: 'bottom'
        },
        {
          step: 15,
            element: $('#amount_disbursement_view'),
            content: '<strong>Disbursement Amount: </strong>Record Amount View of Disbursement Details',
            position: 'bottom'
        },
        {
          step: 16,
            element: $('#description_disbursement_view'),
            content: '<strong>Disbursement Description: </strong>Record Description about of Disbursement Details',
            position: 'bottom'
        },
        {
          step: 17,
            element: $('#requested_date_disbursement_view'),
            content: '<strong>Requested Date: </strong>Record Requested Date of Disbursement Details',
            position: 'bottom'
        },
        {
          step: 18,
            element: $('#requested_by_disbursement_view'),
            content: '<strong>Requested By: </strong>Requested Record and who is User Requested',
            position: 'bottom'
        },
        {
          step: 19,
            element: $('#approval_date_disbursement_view'),
            content: '<strong>Approval Date: </strong>Approval Date of Disbursement',
            position: 'bottom'
        },
        {
          step: 20,
            element: $('#status_disbursement_view'),
            content: '<strong>Status of Disbursement: </strong>Approved/Pending/Need Review Disbursement',
            position: 'bottom'
        },
        {
          step: 21,
            element: $('#edit_disbursement_view'),
            content: '<strong>Edit Button: </strong>Click Edit button to Edit and modify Disbursement',
            position: 'bottom'
        },
        {
          step: 22,
            element: $('#remove_disbursement_view'),
            content: '<strong>Remove Button: </strong>Click Remove button to Remove record from Disbursement',
            position: 'bottom'
        },
        {
          step: 23,
            element: $('#goback_disbursement_view'),
            content: '<strong>Go Back: </strong>Click Go Back to the recent page',
            position: 'bottom'
        },
        //Edit Disbursement Details
        {
          step: 24,
            element: $('#type4'),
            content: '<strong>Disbursement Department: </strong>Select Different Disbursement Department Record',
            position: 'bottom'
        },
        {
          step: 25,
            element: $('#others'),
            content: '<strong>Disbursement Status: </strong>Select Disbursement Status<i>Approved, Pending, Need Reviews</i>',
            position: 'bottom'
        },
        {
          step: 26,
            element: $('#amount_disbursement_edit'),
            content: '<strong>Disbursement Amount: </strong>Input Disbursement Amount',
            position: 'bottom'
        },
        {
          step: 27,
            element: $('#description_disbursement_edit'),
            content: '<strong>Disbursement Description: </strong>Input Disbursement Description',
            position: 'bottom'
        },
        {
          step: 28,
            element: $('#save_button_disbursement_edit'),
            content: '<strong>Save Button: </strong>Click Save Button to Save Disbursement Record',
            position: 'bottom'
        },
        {
          step: 29,
            element: $('#goback_disbursement_edit'),
            content: '<strong>Go Back: </strong>Go Back to the recent page',
            position: 'bottom'
        },
        //Revision Records
        {
          step: 30,
            element: $('#list_disbursement_revison_history'),
            content: '<strong>List of Revision History: </strong>Record of Revision History of Disbursement when have a changes in Record',
            position: 'top'
        },
        {
          step: 31,
            element: $('#goback_disbursement_revison_history'),
            content: '<strong>Go Back: </strong>Go Back to the recent page',
            position: 'bottom'
        },
        //TRASH RECORDS
        //TITHES AND OFFERINGS
        {
          step: 1,
            element: $('#list_trash_records_offerings'),
            content: '<strong>List: </strong>Click to Trash of <i>Tithes and Offerings</i> Records',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#list_trash_records_sabbath'),
            content: '<strong>List: </strong>Click to Trash of <i> Sabbath Offerings</i> Records',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#list_trash_records_disbursement'),
            content: '<strong>List: </strong>Click to Trash of <i>Disbursement</i> Records',
            position: 'bottom'
        },
        //
        {
          step: 4,
            element: $('#list_trash_records_request_tithes_offerings'),
            content: '<strong>Declined Request: </strong>View Trash of Declined Request of Tithes and Offerings Records',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#trash_records_declined_request_tithes_offerings'),
            content: '<strong>Declined Request: </strong>View Trash of Declined Request in Sabbath Offerings Records',
            position: 'bottom'
        },
        {
          step: 6,
            element: $('#trash_records_list_of_records'),
            content: '<strong>List of Records: </strong>List of Trash of Records<i>Tithes and Offerings, Sabbath Offerings, Disbursement, Declined Sabbath and Tithes and Offerings</i> Instruction, Click Restore Button to restore you deleted record',
            position: 'top'
        },
        //My Profile
        {
          step: 1,
            element: $('#profile_picture_my_profile'),
            content: '<strong>Profile Picture: </strong>Display Profle Picture of User',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#upload_button_my_profile'),
            content: '<strong>Upload Button: </strong>Click Upload Photo Button to update the profile picture',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#information_my_profile'),
            content: '<strong>Basic Information: </strong>Dispaly of Basic Information of User',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#edit_button_my_profile'),
            content: '<strong>Edit Button: </strong>Click Edit Personal Details Button to edit your information',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#goback_button_my_profile'),
            content: '<strong>Go Back: </strong>Go Back to the recent page',
            position: 'bottom'
        },
        //SETTNGS
        {
          step: 1,
            element: $('#profile_picture_settings'),
            content: '<strong>Profile Picture: </strong>Display Profle Picture of User',
            position: 'bottom'
        },
        {
          step: 2,
            element: $('#upload_button_settings'),
            content: '<strong>Change Profile Picture Button: </strong>Click Change Profile Picture Button to update your profile picture',
            position: 'bottom'
        },
        {
          step: 3,
            element: $('#change_password_settings'),
            content: '<strong>Change Password: </strong>Click Change Password to update and modify your password',
            position: 'bottom'
        },
        {
          step: 4,
            element: $('#retrieve_email_settings'),
            content: '<strong>Enabled/Disabled Email: </strong>Set to on/off Email notification to received a notification thru gmail account',
            position: 'bottom'
        },
        {
          step: 5,
            element: $('#personal_information_settings'),
            content: '<strong>Personal Information: </strong>Display Basic Information of User',
            position: 'top'
        },
        {
          step: 6,
            element: $('#save_button_settings'),
            content: '<strong>Save Button: </strong>Click Save Button if you want to save the modify records of User',
            position: 'bottom'
        },
        {
          step: 7,
            element: $('#goback_settings'),
            content: '<strong>Go Back: </strong>Go Back to the recent page',
            position: 'bottom'
        },
      ]);
    });
  });