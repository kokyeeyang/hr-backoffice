<?php
	class Captcha {
		/**
		 * This is the 'captcha' action
		 */
		static public function genCaptcha()
		{
			//$strRandomStr = md5(microtime());// md5 to generate the random string
			//$strResultStr = substr($strRandomStr,5,5);//trim 5 digit

			$strResultStr = generate_random_string();

			$strNewImage = imagecreatefromjpeg(Yii::getPathOfAlias('application.vendor.ydl.captcha').'/bg.jpg');//image create by existing image and as back ground

			//$strLineColor = imagecolorallocate($strNewImage,rand(0,255),rand(0,255),rand(0,255));//line color
			$strTextColor = imagecolorallocate($strNewImage, 97, 134, 29);//text color-white

			//imageline($strNewImage,rand(1,75),rand(1,25),rand(1,75),rand(1,25),$strLineColor);//create line 1 on image
			//imageline($strNewImage,rand(1,75),rand(1,25),rand(1,75),rand(1,25),$strLineColor);//create line 2 on image
			//imageline($strNewImage,rand(1,75),rand(1,25),rand(1,75),rand(1,25),$strLineColor);//create line 3 on image
			//imageline($strNewImage,rand(1,75),rand(1,25),rand(1,75),rand(1,25),$strLineColor);//create line 4 on image

			//imagestring($strNewImage, 6, rand(0,20), rand(0,10), $strResultStr, $strTextColor);// Draw a random string horizontally
			//imagestring($strNewImage, 6, rand(0,20), rand(0,10), $strResultStr, $strTextColor);// Draw a random string horizontally

			imagettftext($strNewImage, 28, 0,  80, 25, $strTextColor, Yii::getPathOfAlias('application.vendor.ydl.captcha').'/monofont.ttf' , $strResultStr);
			//$strResultStr = 1233;
			Yii::app()->session['captcha_key'] = $strResultStr;// carry the data through session

			header("Content-type: image/jpeg");// out out the image

			imagejpeg($strNewImage);//Output image to browser
			Yii::app()->end();
		}
	}
?>