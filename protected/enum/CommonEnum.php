<?php

class CommonEnum {
	
    const DOCUMENT_FILE_EXTENSIONS = array("pdf", "docx", "doc", "tiff");
    const PLAIN_FILE_EXTENSIONS = array("txt");
    const IMAGE_FILE_EXTENSIONS = array("jpg", "jpeg", "png", "gif");
    const VIDEO_FILE_EXTENSIONS = array("mp4", "mpeg", "mov");
    const AUDIO_FILE_EXTENSIONS = array("mp3", "flac");

    const ERROR_TYPE_MESSAGE = 'message';
    const ERROR_TYPE_HEADER = 'header';

    const FILE_SYSTEM = 'file system';
    const S3 = 'S3';

    const RETURN_PAGINATION = 'returnPagination';
    const RETURN_CRITERIA = 'returnCriteria';
    const RETURN_TABLE_ARRAY = 'returnTableArr';
    const RETURN_TABLE_ARRAY_BY_SQL = 'returnTableArrBySql';
    const STRING_DATA = 'String Data';
    const INTEGER_DATA = 'Integer Data';
    const SAVE_BUTTON = 'Save';
}