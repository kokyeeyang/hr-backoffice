<?php
/***
	Note: This is just a sample console for illustration purpose only. Please change accordingly.
*/
class GameVoidCommand extends AppConsoleCommand
{
	
	public function actionDoVoid($pass_key, $lang, $game_id, $admin_id, $ip, $log_id, $mode=null) {
		//================================================================================================
		// To validate the console requests
		//================================================================================================ 	
		self::validateAccess($pass_key);
		self::setLanguage($lang);

		$game_id 	= (int)$game_id;
		$admin_id 	= (int)$admin_id;
		
		echo('[Start] [Void Game] ['.$this -> strCurrentDatetime.'] [lang: '.LANG.'] [game_id: '.$game_id.'] [admin_id: '.$admin_id.'] [ip: '.$ip.'] '."\r\n\r\n");
		echo('[Running] [Void Game] This is a simple sample. No action to be taken.'."\r\n\r\n");
		exit('[End] [Void Game] ['.$this -> strCurrentDatetime.'] [lang: '.LANG.'] [game_id: '.$game_id.'] [admin_id: '.$admin_id.'] [ip: '.$ip.'] '."\r\n\r\n");
	}
}
?>