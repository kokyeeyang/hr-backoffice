<?php
class RedisHelper
{
    public static $oRedisLog = null;
    public static $sDbLog = null;

	private static $PREFIX_LOG = 'LOG_';

    public static function getLogInstance($db){

        if(self::$oRedisLog == null || self::$sDbLog !== $db){

			if(defined('REDIS_LOG_CLUSTER_NODE') === true){
				$arrNodes = [REDIS_LOG_CLUSTER_NODE];
				$intCount = 2;

				while(true){

					if(defined('REDIS_LOG_CLUSTER_NODE'.$intCount) === true){
						array_push($arrNodes, defined('REDIS_LOG_CLUSTER_NODE'.$intCount));
						$intCount++;
					}
					else{
						break;
					}
				} // - end: while

				$objRedis = new \RedisCluster(NULL, $arrNodes);
				$objRedis->setOption(\Redis::OPT_PREFIX, REDIS_LOG_PREFIX);
			}
			else{
				$objRedis = new \Redis();
				$objRedis->connect(REDIS_LOG_HOST, REDIS_LOG_PORT);
				$objRedis->setOption(\Redis::OPT_PREFIX, REDIS_LOG_PREFIX);
				$objRedis->select((int)$db);
			}
            self::$sDbLog = $db;
            return (self::$oRedisLog = $objRedis);
        }
        else{
            return self::$oRedisLog;
        }
    }

    private static function getLogNamePrefix() {
        return strtoupper(self::$PREFIX_LOG);
    }

    public static function getLogsList($logName) {
        $arrReturn = [];

        try {
			$it = NULL;
			/* Don't ever return an empty array until we're done iterating */
			self::getLogInstance(REDIS_LOG_DB)->setOption(\Redis::OPT_SCAN, \Redis::SCAN_RETRY);

			while($arrRecord = self::getLogInstance(REDIS_LOG_DB)->scan($it, '*_'.$logName.'_*')) {				

				if(empty($arrRecord) === false){

					foreach($arrRecord as $iKey => $strHashKey){
						$arrHashKey = explode(':', $strHashKey);
						if(empty($arrHashKey[1]) === false && $arrHashKey[0] === REDIS_LOG_PREFIX){
							$strHashKey = explode(':', $strHashKey)[1];

							if(($arrRecord2 = self::getLogInstance(REDIS_LOG_DB)->hGetAll($strHashKey)) != false){
								$arrRecord2['key'] = $strHashKey;
								$arrRecord2['content'] = unserialize($arrRecord2['content']);
								array_push($arrReturn, (object)$arrRecord2);
							}
						}
					}
				}
			}
        }
        catch(Exception $e) {         
        }
        return $arrReturn;
    }

    public static function setLog($logName, $content, $ttl=null) {
        $isSet = false;
		
		if($logName != ''){
			$prefix = self::getLogNamePrefix();

			try {   
				$strHashKey = $prefix . $logName;

				if($ttl === null){
					$ttl = REDIS_LOG_DEFAULT_TTL;
				}

				if(self::getLogInstance(REDIS_LOG_DB)->hSet($strHashKey, 'content', serialize($content)) !== false){
					self::getLogInstance(REDIS_LOG_DB)->hSet($strHashKey, 'date_create', date('Y-m-d H:i:s'));

					if($ttl !== false){
						self::getLogInstance(REDIS_LOG_DB)->expire($strHashKey, (int)$ttl);                   
					}
				}
				$isSet = true;
			}
			catch(Exception $e) {   
			}
		}
        return $isSet;
    }

    public static function getLog($logName) {
        $content = null;

		if($logName != ''){
			$prefix = self::getLogNamePrefix();

			try {
				$strHashKey = $prefix . $logName;

				if(($content = self::getLogInstance(REDIS_LOG_DB)->hGet($strHashKey, 'content')) !== false){
					$content = unserialize($content);
				}
			}
			catch(Exception $e) {        
			}			
		}
        return $content;
    }	
}