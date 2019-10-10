<?php
defined('AWS_VERSION') or define('AWS_VERSION', '2006-03-01');
defined('AWS_REGION') or define('AWS_REGION', 'ap-southeast-1'); // Asia Pacific (Singapore)

defined('AWS_ACCESS_KEY_ID') or define('AWS_ACCESS_KEY_ID', 'AKIAQZX6IXUT4KWMHVEG');
defined('AWS_SECRET_ACCESS_KEY') or define('AWS_SECRET_ACCESS_KEY', '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');
defined('S3_BUCKET') or define('S3_BUCKET', 'hrbo-prd');

// To determine the environment mode
switch(ENV_MODE){
	case 'dev': // Development Mode
		defined('S3_FOLDER') or define('S3_FOLDER', 'hrbo-dev');
	break;

	case 'prod': // Production Mode
	default:
		defined('S3_FOLDER') or define('S3_FOLDER', 'hrbo-prd');
	break;
} // - end: switch

defined('S3_PRODUCTION_FOLDER') or define('S3_PRODUCTION_FOLDER', S3_BUCKET.'/'.S3_FOLDER.'/production');
defined('S3_OFFER_LETTER_IMAGES_FOLDER') or define('S3_OFFER_LETTER_IMAGES_FOLDER', S3_BUCKET.'/'.S3_FOLDER.'/offer-letter-images');
defined('S3_OFFER_LETTERS_FOLDER') or define('S3_OFFER_LETTERS_FOLDER', S3_BUCKET.'/'.S3_FOLDER.'/offer-letters');
defined('S3_RESUMES_FOLDER') or define('S3_RESUMES_FOLDER', S3_BUCKET.'/'.S3_FOLDER.'/resumes');
defined('S3_COVER_LETTERS_FOLDER') or define('S3_COVER_LETTERS_FOLDER', S3_BUCKET.'/'.S3_FOLDER.'/cover-letters');