<?php

return [
	'project' => [
		'name' => 'DevZone',
		'description' => 'This is a simple release information about project!',
		'build' => date('Y-m-d'),
		'changelog' => [
			"Several bugs has been fixed!",
			"Support to DronePHP v1.9.*"
		]
	],
	'routing' => [
		# set this parameter to true if rewrite module is enabled
		'friendly' => true
	]
];