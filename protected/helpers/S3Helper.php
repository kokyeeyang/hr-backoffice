<?php
require_once APP_LIB_PATH . '/aws/aws-autoloader.php';

use Aws\S3\S3Client;

class S3Helper 
{
	public static function startS3Service() {
		global $s3Client;
		try {							
			$s3Client = new S3Client(array(
			  'version' => AWS_VERSION,
			  'region'  => AWS_REGION,
			  'credentials' => array(
				'key' => AWS_ACCESS_KEY_ID,
				'secret'  => AWS_SECRET_ACCESS_KEY,
			  )
			));
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In startS3Service</h2>";
			echo $e->getMessage ();
		}
		
	}
	
	public static function listObjects($folder='') {
		global $s3Client;
		
		try 
		{
			self::startS3Service();
			$bucketItems = $s3Client->listObjectsV2([
				'Bucket' => S3_BUCKET, // REQUIRED
				'Prefix' => $folder.'/',
				'Delimiter' => '/',
			]);
			
			$result = array();
			if(count($bucketItems['Contents']) > 0)
			{
				foreach($bucketItems['Contents'] as $item)
				{					
					$file_name = str_replace($folder.'/', "", $item['Key']);
					if($file_name != '')
					{
						$result[] = self::processFileInfo($item);
					}
				}
			}
			
			return $result;
			
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In listObjects</h2>";
			echo $e->getMessage ();
		}
	
	}
	
	public static function processFileInfo($file) {
		$temp = array();
		$temp['Name'] = end(explode("/", $file['Key']));
		$temp['Key'] = $file['Key'];
		$temp['Size'] = self::formatSizeUnits($file['Size']);
		$date = new DateTime($file['LastModified']->format(\DateTime::ISO8601));
		//$date->setTimezone(new DateTimeZone('Asia/Kuala_Lumpur'));
		$temp['LastModified'] = $date->format('Y-m-d H:i:s');
		$temp['LastModified_text'] = $date->format('M d, Y g:i:s A ').TIME_ZONE;
		return $temp;
	}
	
	public static function getObject($file_name) {
		global $s3Client;
		
		try 
		{
			self::startS3Service();
			$resultItem = $s3Client->getObject([
				'Bucket' => S3_BUCKET, // REQUIRED
				'Key' => $file_name, // REQUIRED
			]);
			
			return $resultItem;
			
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In getObject</h2>";
			echo $e->getMessage ();
		}
	}
	
	public static function putObject($file_name, $source_file_path) {
		global $s3Client;
		
		try 
		{
			$contentType = 'application/octet-stream';
			$extension = strtolower(end(explode('.', $file_name)));
			if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') 
				$contentType = "image/".$extension;
			else if ($extension == 'pdf')
				$contentType = "application/pdf";
			
			self::startS3Service();
			$resultItem = $s3Client->putObject([
				'Bucket' => S3_BUCKET, // REQUIRED
				'Key' => $file_name, // REQUIRED
				'SourceFile' => $source_file_path, // REQUIRED
				'ContentType' => $contentType,
			]);
			
			return $resultItem;
			
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In putObject</h2>";
			echo $e->getMessage ();
		}
	}
	
	public static function copyObject($old_file_name, $new_file_name) {
		global $s3Client;
		
		try 
		{
			self::startS3Service();
			$resultItem = $s3Client->copyObject([
				'Bucket' => S3_BUCKET, // REQUIRED
				'CopySource' => S3_BUCKET.'/'.$old_file_name,
				'Key' => $new_file_name,
			]);
		}
		catch ( Exception $e ) 
		{
			$resultItem['ErrorMsg'] = 'Error copyObject : '.$e->getMessage ();
		}
		return $resultItem;
	}
	
	public static function deleteObject($file_name) {
		global $s3Client;
		
		try 
		{
			self::startS3Service();
			$resultItem = $s3Client->deleteObject([
				'Bucket' => S3_BUCKET,
				'Key' => $file_name,
			]);
			
			return 1;
			
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In copyObject</h2>";
			echo $e->getMessage ();
		}
	}
	
	public static function moveObject($file_name, $old_path, $new_path) {
		global $s3Client;
		
		try 
		{
			self::startS3Service();
			if(self::copyObject($old_path.'/'.$file_name, $new_path.'/'.$file_name))
			{
				self::deleteObject($old_path.'/'.$file_name);
			}
			
			return $resultItem;
			
		} 
		catch ( Exception $e ) 
		{
			echo "<h2>Exception Error In copyObject</h2>";
			echo $e->getMessage ();
		}
	}
	
	public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 1) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 1) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 1) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}
	
}