<?php
/***
	Note: This is just a sample console for illustration purpose only. Please change accordingly.
*/
class WhitelistIpCommand extends AppConsoleCommand
{
	public function actionDeleteExpiredRecords($mode=null) 
	{
		$arrRecords = WhitelistedIp::model()->findAll(array('order'=>'id ASC', 'limit' => 100));
		
	}
}
?>                