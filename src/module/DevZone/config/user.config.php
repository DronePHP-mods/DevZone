<?php

return [
	'project' => [
		'name' => 'DevZone',
		'description' => 'This is a simple release information about project!',
		'build' => date('Y-m-d'),
		'changelog' => [
			"Several bugs has beem fixed!",
			"Support to DronePHP v1.3.0 has been garanted!"
		]
	],
	'routing' => [
		# set this parameter to true if rewrite module is enabled
		'friendly' => true
	]
];