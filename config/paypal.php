<?php 
return [ 
    'client_id' => 'ATrZ6oVBURQPhmLdqP_5kFJDESOJVCmG4jeMoWE_-ucZ2p3FiLuRLr2Dv7vZUgr4IP0VLnNlK3y2TdKF',
	'secret' => 'EDRP-MIXw-Pjri6VPXsMPFnkimT7NQUxt9S1JnxMhNh3BFmsuMcOsqFO52H6oqWXZIKGrpfTTCkzyhIh',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];