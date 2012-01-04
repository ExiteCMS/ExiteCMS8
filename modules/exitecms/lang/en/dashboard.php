<?php
/**
 * Language file for the module controller exitecms\dashboard
 */

return array(
	'title' => array(
		'index' => 'Dashboard'
	),
	'headers' => array(
		'news' => 'News',
		'users' => 'User information',
		'exitecms' => 'ExiteCMS',
		'platform' => 'Platform information',
	),
	'info' => array(
		'users' => array(
			'Number of user accounts:',
			'Active accounts:',
			'Deactivated accounts:',
			'Awaiting activation:',
			'Deleted accounts:',
			'System accounts:',
			'External accounts:',
		),
		'exitecms' => 'You are using ExiteCMS version <span class="highlight">:version</span>, revision <span class="highlight">:revision</span>.
			<br />:update<br /><br />
			The content tree of this installation contains <span class="highlight">:websites</span> defined website(s),
			and <span class="highlight">:pages</span> pages.',
		'status_ok' => 'Your ExiteCMS installation is up to date.',
		'status_nok' => '<span class="highlight">Your ExiteCMS installation is not up to date. Click <a href="#">here</a> to update</span>.',
		'platform' => array(
			'Web server identification:',
			'Database driver:',
			'PHP version:',
			'Database engine:',
			'Fuel framework:',
		),
	),
);

/* End of file dashboard.php */
