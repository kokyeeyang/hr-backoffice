<?php
// To determine the environment mode
switch(ENV_MODE){
	case 'dev': // Development Mode
		define('REDIS_LOG_DB', 0);
		define('REDIS_LOG_HOST', 'xxx');
		//define('REDIS_LOG_CLUSTER_NODE', 'xxx'); // Cluster nodes enabled => REDIS_LOG_CLUSTER_NODE, REDIS_LOG_CLUSTER_NODE2, REDIS_LOG_CLUSTER_NODE3...
		define('REDIS_LOG_PORT', 6379);
		define('REDIS_LOG_PREFIX', 'HRBO-DEV-LOG:');
	break;

	case 'prod': // Production Mode
	default:
		define('REDIS_LOG_DB', 0);
		define('REDIS_LOG_HOST', 'xxx');
		//define('REDIS_LOG_CLUSTER_NODE', 'xxx'); // Cluster nodes enabled => REDIS_LOG_CLUSTER_NODE, REDIS_LOG_CLUSTER_NODE2, REDIS_LOG_CLUSTER_NODE3...
		define('REDIS_LOG_PORT', 6379);
		define('REDIS_LOG_PREFIX', 'HRBO-PROD-LOG:');
	break;
} // - end: switch

// Redis log constants
//define('REDIS_LOG_YOUR_CONSTANT_HERE, 'YourConstantHere');

define('REDIS_LOG_DEFAULT_TTL', 43200); // 12 hours