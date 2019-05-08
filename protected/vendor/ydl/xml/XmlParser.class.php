<?php
//========================================================================================================================
//--Class : Generic Xml Parser. 
//--Notes : Before You Parse The Xml. Please Ensure That:-
//          For Parsing The - Xml Data Successfully, The Generated Xml Need To Following Certain Standards, For Eg:-
//          1) If There Are Any Data Within The Xml Tags Contains The Special Character 
//             Like &, <, And Etc. You Should Use CDATA. For Eg. <xmltag><![CDATA[data1&data2<data3]]></xmltag>.
//--Description:-
//--        1) It is a SAX parser for Xml.
//--        1) It will parse the xml by generating an array as output. The structure of the output array will follow
//--           the structure of xml. All you need to do is just calling the method getXmlInArray().
//--           This method will return the xml data in an array structure. This method will return null on failure.
//--	    2) If you intended to parse the xml by writing your own parser instead of this generic parser.
//--           Then the specific written parser should extends this generic parser.
//--           e.g. ChildXmlParser extends XmlParser
//--           And hence you can use the method getXmlData() in this generic class to fetch the xml data in stream.
//--		
//--Date  : 02-Oct-2005, 22-Mar-2006, 11-Aug-2006.
//--Author: Yinkc
//=======================================================================================================================

class XmlParser {

	//===================================================================================================================
	//--Class Attributes.
	//===================================================================================================================    
	var $rscParser;
	var $bolSave            = false;
	var $bolBrowserShowMode = false;
	var $bolExistCdata      = false;
	var $intCurrentLevel    = 0;
	var $arrKeyTags         = array();
	var $arrXmlToArray      = array();
	var $arrStdSpecial      = array('&');
	var $arrSgOsSpecial     = array('MySgOsAmp;');
	var	$strNetworkProtocol = 'tcp://';
	var	$intPortNo          = 80;
	var $strPreviousElement;
	var $intLatestTagClosedLevel;
	
	//===================================================================================================================
	//--Function(Constructor): XmlParser.
	//===================================================================================================================
    function XmlParser($strEncoding = 'ISO-8859-1') 
    {
        $this->rscParser = xml_parser_create($strEncoding);
		
        xml_set_object($this->rscParser, $this);
		xml_parser_set_option($this->rscParser, XML_OPTION_CASE_FOLDING, false);
        xml_set_element_handler($this->rscParser, "handleOpeningElement", "handleClosingElement");
        xml_set_character_data_handler($this->rscParser, "handleCharacterData");
    } //- end function: XmlParser

	//===================================================================================================================
	//--Function: getXmlInArray.
	//--To Read The Xml Data Into Array Structure.
	//===================================================================================================================
	function getXmlInArray($strPath)
	{		
		$strXmlData = $this->getXmlData($strPath);
		
		if ('' != $strXmlData) {			
			$strXmlData = str_replace($this->arrStdSpecial, $this->arrSgOsSpecial, $strXmlData);	
			
			if ($this->Parse($strXmlData) !== false) {
				return $this->arrXmlToArray;
			}
			else {
				echo '<div>Notice: Failed in parsing the Xml File.</div>';
				return null;
			}
		}
		else {
			echo '<div>Notice: Failed in fetching the Xml File#2.</div>';
			return null;
		} //- end: if else
	} //- end function: getXmlInArray

	//===================================================================================================================
	//--Function: parse.
	//--To Create A Xml Parser For Parsing The Receiving Xml Data.
	//===================================================================================================================
    function parse($strXmlData)
    {
       return xml_parse($this->rscParser, $strXmlData);
    } //- end function: parse

	//===================================================================================================================
	//--Function: handleOpeningElement.
	//--Will Be Executed When Reaching The Xml Open Elements.
	//===================================================================================================================
    function handleOpeningElement($rscParser, $strElement, $arrAttributes) 
    {
		$this->intCurrentLevel++;
		$intCurrentLevel = $this->intCurrentLevel;
		$this->bolSave   = true;
		
		if (isset($arrAttributes['id'])) {
			$this->arrKeyTags[$intCurrentLevel] = $strElement . ':' . $arrAttributes['id'];
		}
		else {	
		
			//============================================================================================================	
			//--Preventive Codes For The Xml Elements(Tags) Within The Same Level And With Same Name.
			//--Eg:-                                          Output:-
			//      <level1>                                  	Array( [level1] => 
			//      	<level2>Data</level2>                      	Array( [level2]   => Array( [@cdata] => Data ),
			//          <level2>Data</level2>     						   [level2:2] => Array( [@cdata] => Data )
			//		</level1>										      )
			//                                                  )
			//============================================================================================================
			if ($this->strPreviousElement == $strElement && $this->intLatestTagClosedLevel == $intCurrentLevel) {
				$arrSplitedKeyTag = explode(':', $this->arrKeyTags[$intCurrentLevel]);
				
				$intUBound = sizeof($arrSplitedKeyTag) - 1;
				
				if (is_numeric($arrSplitedKeyTag[$intUBound])) {
					$this->arrKeyTags[$intCurrentLevel] = $strElement .':'. ($arrSplitedKeyTag[$intUBound] + 1);
				}
				else {
					$this->arrKeyTags[$intCurrentLevel] = $strElement .':2'; 
				} //- end: if else
			}
			else {
				$this->arrKeyTags[$intCurrentLevel] = $strElement;
			}  //- end: if else
		}  //- end: if else
		
		//===============================================================================================================
		//--To Read The Attributes Data Within The Opening Xml Element Into The Output Array: arrXmlToArray
		//===============================================================================================================
		foreach ($arrAttributes as $strKey => $strValue) {
			$strValue = str_replace($this->arrSgOsSpecial, $this->arrStdSpecial, $strValue);
			
			if ('id' != $strKey) {
			
				$strEvalCodes = '$this->arrXmlToArray';
				
				for ($intLevel = 1; $intLevel <= $intCurrentLevel; $intLevel++) {
					$strEvalCodes = $strEvalCodes . '[\'' . $this->arrKeyTags[$intLevel] . '\']';
				} //- end: for
				
				$strEvalCodes = $strEvalCodes . '[\'' . $strKey . '\'] = $strValue;';
				
				eval($strEvalCodes);
				unset($strEvalCodes);
			} //- end: if			
		} //- end: foreach 				
    } //- end function: handleOpeningElement

	//===================================================================================================================
	//--Function: handleCharacterData.
	//--Will Be Executed When Reaching The Xml Data (Within The Xml Tags). Eg. <tag>Data</tag> 
	//--Unless The Data Is Empty eg: <tag></tag>. Notes: <tag></tag> Is Not Equavalent To <tag> </tag>
	//===================================================================================================================
    function handleCharacterData($rscParser, $strCdata) 
    {   		
		$intCurrentLevel = $this->intCurrentLevel;
		
		//==============================================================================================================
		//--Replace 'MySgOsAmp;' by '&'.
		//==============================================================================================================
		$strCdata = str_replace($this->arrSgOsSpecial, $this->arrStdSpecial, $strCdata);
		
		if ($this->bolBrowserShowMode) {
			
			$strCdata = str_replace('<', '&lt;', $strCdata);
		}//end: if
		
		if ($this->bolSave == true) {
			$strEvalCodes = '$this->arrXmlToArray';
			
			for ($intLevel = 1; $intLevel <= $intCurrentLevel; $intLevel++) {
				$strEvalCodes = $strEvalCodes . '[\''. $this->arrKeyTags[$intLevel] . '\']';
			} //- end: for
			
			$strEvalCodes = $strEvalCodes . '[\'@cdata\'] = isset(' . $strEvalCodes . '[\'@cdata\']) ? ' . 
							$strEvalCodes . '[\'@cdata\']' . ' . \' \' . $strCdata : $strCdata;';
	
			//echo '<div><pre>'.$strEvalCodes . '</pre></div>';		
			
			eval($strEvalCodes);
			unset($strEvalCodes);
							
			$this->bolExistCdata = true;
		} //- end: if	
    } //- end function: handleCharacterData

	//===================================================================================================================
	//--Function: handleClosingElement.
	//--Will Be Executed When Reaching The Xml Close Elements.
	//===================================================================================================================
    function handleClosingElement($rscParser, $strElement)
    {			
		$intCurrentLevel = $this->intCurrentLevel;
		
		if ($this->bolSave == true) {
			//===========================================================================================================
			//--Preventive Code: To Ensure When There Is No Data Within The Xml Elements Like <tag></tag>,
			//                   The Structure Of The Output Array - arrXmlToArray Will Still Remain The Same.
			//===========================================================================================================			
			if ($this->bolExistCdata == false) {
				
				//--Note: When $intLevel = 1, then mean the root level.
				$strEvalCodes = '$this->arrXmlToArray';
				
				for ($intLevel = 1; $intLevel <= $intCurrentLevel; $intLevel++) {
					$strEvalCodes = $strEvalCodes . '[\''. $this->arrKeyTags[$intLevel] . '\']';
				} //- end: for
				
				$strEvalCodes = $strEvalCodes . '[\'@cdata\'] = \' \';';
				
				eval($strEvalCodes);
				unset($strEvalCodes);
			}
			
		} //- end: if
		
		$this->strPreviousElement      = $strElement;
		$this->intLatestTagClosedLevel = $intCurrentLevel;
		$this->bolSave                 = false;
		$this->bolExistCdata           = false;
		$this->intCurrentLevel--;	
    }//- end function: handleClosingElement

	//===================================================================================================================
	//--Function: free.
	//--To Free Out The Parser's Resources.
	//===================================================================================================================
	function free() 
	{
		xml_parser_free($this->rscParser);
	} //- end function: free

	//===================================================================================================================
	//--End: Parsing Xml Data Into An Array.
	//===================================================================================================================
	
	//===================================================================================================================
	//--Start: Determine The Xml Fetching Method And Fetching The Xml Data.
	//===================================================================================================================

	//===================================================================================================================
	//--Function: getXmlData.
	//--Return xml data using the possible ways (file / socket / Curl).
	//--If fopen disabled, use fsocket instead. If fsocket still failed then try for using Curl.
	//--Will return '' if it fails.
	//===================================================================================================================
	function getXmlData($strUrl) 
	{
		//if (($strXmlData = $this->getXmlDataByFile($strUrl)) == false) {
		
			if (($strXmlData = $this->getXmlDataBySocket($strUrl)) == false) {

				if (($strXmlData = $this->getXmlDataByCurl($strUrl)) == false) {
					// - Trigger Error.
					return '';
				} //- end: if
			} //- end: if
		//} //- end: if
		
		return $strXmlData;
	} //- end function: getXmlData

	//===================================================================================================================
	//--Function: getXmlDataByFile.
	//--Return data as string by fopen.
	//--Will return FALSE if it fails OR php:ini(allow_url_fopen) is disabled.
	//===================================================================================================================
	function getXmlDataByFile($strUrl) 
	{
		if (ini_get('allow_url_fopen') && $strFileContent = @file_get_contents($strUrl)) {
			return $strFileContent;
		}
		else {
			return false;
		} //- end: if else
	} //- end function: getXmlDataByFile

	//===================================================================================================================
	//--Function: getXmlDataBySocket.
	//--Return data as string by using socket connection.
	//--Will return FALSE if url cannot parsed properly OR if socket fails.
	//===================================================================================================================
	function getXmlDataBySocket($strUrl) 
	{
		// Need not to process anything if $xml is not even a valid url 
		// Determined by parse_url() fails when it return false
		$arrUrl = parse_url($strUrl);
		if (is_array($arrUrl)) {
			$strHost  = (isset($arrUrl['host'])) ? $arrUrl['host'] : '';
			$strPath  = (isset($arrUrl['path'])) ? $arrUrl['path'] : '';
			$strQuery = (isset($arrUrl['query'])) ? $arrUrl['query'] : '';
			$strPath  = $strPath . '?' . $strQuery;
		}
		else {
			return false;
		} //- end: if else
		
		// Need not to process unless we established socket connection
		$rscFp = @fsockopen($this->strNetworkProtocol.$strHost, $this->intPortNo, $intErrNo, $strErrStr, 30);
		
		if (! $rscFp) {
			return false;
		}
		else {
			// Send HTTP request
			$strHttpRequest  = "GET $strPath HTTP/1.0\r\n";
			$strHttpRequest .= "Host: $strHost\r\n";
			$strHttpRequest .= "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0\r\n";
			$strHttpRequest .= "Connection: close\r\n\r\n";
			fwrite($rscFp, $strHttpRequest);

			// Get HTTP response and its content
			$strHttpResponse = '';
			while (! feof($rscFp)) {
				$strHttpResponse .= fgets($rscFp, 128);
			} //- end: while
			fclose($rscFp);

			// Get only content while get rid of all HTTP responses
			$strXmlData = substr($strHttpResponse, (strpos($strHttpResponse, "\r\n\r\n") + 4), strlen($strHttpResponse));

			// Unset everything used for getting $strXmlData
			unset($strHost);
			unset($strPath);
			unset($strQuery);
			unset($strHttpRequest);
			unset($strHttpResponse);
			unset($rscFp);
			
            if ( $this->checkError404Exists($strXmlData) ) {
				return false;
			}
			else {
				return $strXmlData;
			}
		} //- end: if else
	} //- end function: getXmlDataBySocket
	
	//===================================================================================================================
	//--Function: getXmlDataByCurl.
	//--Return data as string by using CURL(i.e. Client URL Library).
	//--Will return FALSE if it fails OR When Curl have not been enabled.
	//===================================================================================================================
	function getXmlDataByCurl($strUrl) 
	{
		if (function_exists('curl_init')) {
			
			if(function_exists('curl_get')){
				$arrData = curl_get($strUrl);
				
				if($arrData['errmsg'] == ''){
					$strXmlData = $arrData['content'];
				}
				else{
					return false;
				} // - end: if else
			}
			else{
				$rscCh = curl_init();
				
				curl_setopt($rscCh, CURLOPT_URL, $strUrl);
				curl_setopt($rscCh, CURLOPT_HEADER, false);
				//- To set the option for returning the transfer as a string from curl_exec(). 
				curl_setopt($rscCh, CURLOPT_RETURNTRANSFER, true);
				
				$strXmlData = @curl_exec($rscCh); 
				curl_close($rscCh);			
			} // - end: if else
			
			if ($this->checkError404Exists($strXmlData)) {
				return false;
			}
			else {
				return $strXmlData;
			}
		}
		else {
			return false;
		}
	} //- end function: getXmlDataByCurl

	//===================================================================================================================
	//--Function: checkError404Exists.
	//--Check if there is an Error 404 - The Requested Page Not Found or not exist.
	//--Will return FALSE if there is no such error found inside the content returned, else return TRUE.
	//===================================================================================================================	
	function checkError404Exists($strXmlData) {
			
			$strDoctypeHeader    = '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML';
			$strError404NotFound = "<html><head>\n<title>404 Not Found</title>\n</head>";
			
            if ( strpos($strXmlData, $strError404NotFound) && strpos($strXmlData, $strDoctypeHeader) === 0) {
				return true;
			}
			else {
				return false;
			}
	} //- end function: checkError404Exists	
	
	//===================================================================================================================
	//--End: Determine The Xml Fetching Method And Fetching The Xml Data.
	//===================================================================================================================

} // end of class XmlParser

?>