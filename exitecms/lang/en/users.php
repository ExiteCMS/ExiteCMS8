<?php
/**
 * Language file for the module controller exitecms/users
 */

return array(


	// form field labels
	'field' => array(
		'name' => 'User name',
		'fullname' => 'Full name',
		'password' => 'New password',
		'password2' => 'Repeat password',
		'email' => 'Email address',
		'location' => 'Location',
		'web' => 'Website',
		'birthdate' => 'Birthday',
		'gender' => 'Gender',
		'locale' => 'Locale',
		'timezone' => 'Timezone',
		'joined' => 'Joined',
		'country' => 'Country',
		'actions' => 'Options'
	),

	// form field help texts
	'help' => array(
		'name' => 'Choose a unique (nick)name. This is the name used to login.',
		'fullname' => 'Optionally, you can specify a full name. This is visible to other users in the accounts public profile.',
		'password' => 'Type a new password. Passwords have to be at least 6 characters long and must contain both letters and digits. Passwords are case-sensitive!',
		'password2' => 'Type the password again, to make sure you didn\'t make a mistake.',
		'email' => 'Type a valid email address. This address is used to communicate with the user, and for validation purposes (if configured).',
		'location' => 'Optionally, you can enter the users location. This is visible to other users in the accounts public profile.',
		'web' => 'Optionally, you may specify the users personal website.',
		'birthdate' => 'Optionally, you may specify the users birthday.',
		'gender' => 'Optionally, you can specify the users gender. This is visible to other users in the accounts public profile.',
		'locale' => 'Select the language the user wants this website to be displayed in.',
		'timezone' => 'Select your timezone, so we can calculate the users local time. Use the button to detect your timezone.',
		'country' => 'Select your country of residence.',
	),

	// action information
	'action' => array(
		'tree' => array(
			'title' => '',
			'form' => '',
		),
		'list' => array(
			'title' => 'User accounts',
			'form' => '',
			'info' => 'This is the ExiteCMS user management module.
						You use this module to manage our users, to create new users, or to disable, delete or block existing user accounts.
						To configure user authentication, or to define additional authentication methods, go to Setup and Configuration.',
		),
		'add' => array(
			'title' => 'User accounts',
			'form' => 'Add a user account',
			'info' => 'Use this form to add a new website to be served by this ExiteCMS installation.<br />
						Please enter the host name of the website, and the port number to which to listen too.
						You have to define this if you have two websites with the same host name, but with a different port number.',
			'success' => 'The new user account has been added.',
			'failure' => 'Error adding the new user account.',
		),
		'edit' => array(
			'title' => 'User accounts',
			'form' => 'Edit a user account',
			'info' => 'Use this form to edit the properties of a website served by this ExiteCMS installation.<br />
						You can modify the host name of the website, and the port number to which to listen too.
						You have to define this if you have two websites with the same host name, but with a different port number.',
			'success' => 'The user account has been updated.',
			'failure' => 'Error updating the user account.',
		),
		'delete' => array(
			'title' => 'User accounts',
			'form' => 'Delete a user account',
			'info' => 'You are about to delete the account of user ":name". <span class="highlight">Are you sure?</span><br /><br />
						Note that if this users owns assets on this website, it will be logically deleted, to keep those assets.
						If you delete a logically deleted user, it will be permanently removed, including all the assets belonging to this account!',
			'success' => 'The user account has been deleted.',
		),
	),

	// icon titles
	'icon' => array(
		'edit' => 'Edit the properties of this account',
		'delete' => 'Delete this account',
	),

	// buttons
	'button' => array(
		'add' => 'Add a new account',
	),

	// messages
	'message' => array(
		'deleted_noaccess' => 'You are not allowed to delete this user account.',
		'port_invalid' => 'The "Port number" must be a numeric value between 1 and 65535.',
		'invalid_hostname' => 'The hostname for this website can not be resolved on the internet.',
	),

	// validation strings
	'validation' => array(
	),

	// other texts
	'other' => array(
		'genderlist' => array(
			'M' => 'Male',
			'F' => 'Female',
			'U' => 'Undisclosed',
		),
	),
);

/* End of file users.php */
