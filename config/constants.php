<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Application Constants
    |--------------------------------------------------------------------------
    |
    | Constants can be used by
    | Config::get('constants.CONSTANT_NAME');
    |
    */

    'FIXED_ENCRYPT_STRING'=>'ONLINE_TEAM_JOB_BIDDING',

    // Pagination limit
    'ADMIN_PER_PAGE'			=> 20,
	'PORTFOLIO_PER_PAGE'		=> 6,
	'PROPOSAL_PER_PAGE'			=> 10,
	'JOBS_PER_PAGE'				=> 10,
    'API_PER_PAGE'				=> 10,
    'PROFILE_IMAGE_WIDTH'		=> 1200,
    'PROFILE_IMAGE_HEIGHT'		=> 800,
    'GOOGLE_MAPS_KEY'			=> env('GOOGLE_MAPS_KEY'),
    'INVOICE_PER_PAGE'			=> 10,
    'FREELANCER_PER_PAGE'		=> 5,
    'DASHBOARD_RECOMENDED_JOBS_PER_PAGE'		=> 5,
    'GM_API_KEY'				=> env('GM_API_KEY'),
    //'JOBS_TURN_AROUND_TIME_NORMAL_ID'		=> '2',
    'JOBS_TURN_AROUND_TIME_URGENT_ID'		=> '1',

    'ADMIN_ASSETS_URL'			=> env('ADMIN_ASSETS_URL'),
    'NOTIFICATION_AJAX_CALLING_INTERVAL'  => env('NOTIFICATION_AJAX_CALLING_INTERVAL'),
	
	//Table Constants
	'TBL_ADMINS'					=> 'admins',
	'TBL_BUDGETS'					=> 'budgets',
	'TBL_CITIES'					=> 'cities',
	'TBL_COUNTRIES'					=> 'countries',
	'TBL_EXPERIENCE_LEVEL'			=> 'experience_levels',
	
	//
	'TBL_FIELD_OF_WORK'				=> 'field_of_work_type',
	'TBL_FOCUS_TYPE'				=> 'focus_type',
	//
	
	'TBL_JOB_ASSESMENT'				=> 'job_assesments',
	'TBL_JOB_SKILL_MAP'				=> 'job_skill_maps',
	'TBL_CATEGORY_SUBCATEGORY'		=> 'category_subcategory',
	'TBL_LANGUAGES'					=> 'languages',
	'TBL_MIGRATIONS'				=> 'migrations',
	'TBL_JOB_TYPE'					=> 'job_type',
	'TBL_RESET_PASSWORDS'			=> 'password_resets',
	'TBL_PORTFOLIO_ACTIONS'			=> 'portfolios_like_share_preview',
	'TBL_POSTED_JOBS'				=> 'postedjobs',
	'TBL_PRODUCTS'					=> 'products',
	'TBL_PROJECT_LENGTH'			=> 'project_lengths',
	'TBL_SELLERS'					=> 'sellers',
	'TBL_SETTING'					=> 'settings',
	'TBL_SKILLS_MASTER'				=> 'skills',
	'TBL_STATES'					=> 'states',
	'TBL_TRAVEL_MASTER'				=> 'travel_master',
	'TBL_TURN_AROUND_TIMES'			=> 'turn_around_times',
	'TBL_USERS'						=> 'users',
	'TBL_USERS_DETAILS'				=> 'user_details',
	'TBL_PORTFOLIO'					=> 'user_portfolios',
	'TBL_USERS_SKILLS'				=> 'user_skill_map',
	'TBL_USER_CHATS'				=> 'user_chats',
	'TBL_PROPOSALS'					=> 'job_proposals',
	'TBL_JOB_PROPOSAL_AMOUNT'		=> 'job_proposal_amounts',
	'TBL_USER_TRANSACTIONS'			=> 'user_transactions',
	'TBL_JOB_PROVIDER_TRANSACTIONS'			=> 'jobprovider_transactions',
	'TBL_USER_JOB_TASKS'			=> 'user_job_tasks',
	'TBL_TASK_ASSIGNED_MEMBERS'		=> 'task_assigned_members',
	'TBL_TASK_ATTACHMENTS'			=> 'task_attachments',
	'TBL_INVOICE'					=> 'invoices',
	'TBL_MONTHLY_BID_DETAILS'		=> 'monthly_bid_details',
	'TBL_USERS_PROFILE_VIEWS'		=> 'users_profile_views',
	'TBL_JOB_RATINGS'				=> 'job_ratings',
	
	
	
	'TASKS' => [
        '1' => 'In Progress',
        '2' => 'Hold',
        '3' => 'Review',
        '4' => 'Completed'
    ],

    'INVOICE_STATUS' => [
        '1' => 'Paid',
        '2' => 'Unpaid',
        '3' => 'Declined'
    ],

    'WEEKDAYS' => [
        '1' => 'Sunday',
        '2' => 'Monday',
        '3' => 'Tuesday',
        '4' => 'Wednesday',
        '5' => 'Thursday',
        '6' => 'Friday',
        '7' => 'Saturday'
    ],
	
	'langs' => [
        '1' => 'Freelancers',
        '2' => 'Job Provider'
    ],

    'SEND_PROPOSAL_NOTIFICATION_MSG'		=> '{{NAME}} sent a proposal', //If any proposal received for any job
    'ACCEPT_PROPOSAL_NOTIFICATION_MSG'		=> '{{NAME}} accepted your proposal', //If any proposal is accepted
    'RELEASE_MILESTONE_NOTIFICATION_MSG'	=> '{{NAME}} funded to your wallet', //If any JobProvider release any milestone amount
    'REVIEW_NOTIFICATION_MSG_FREELANCER'	=> '{{NAME}} posted a review respect your posted job', //If any Freelancer post a review for any job, after completion the full work
    'REVIEW_NOTIFICATION_MSG_JOB_PROVIDER'	=> '{{NAME}} posted a review respect your work done', //If any JobProvider post a review for Freelancer, after completion the full work
    'GET_A_QUOTE_NOTIFICATION_MSG'			=> '{{NAME}} invited you to view a new posted job'
];
