<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 0);

$config = array();

$config['authentication'] = function () {
    return true;
};
$config['licenseName'] = 'giasuthanhdanh.test';
$config['licenseKey']  = 'B6D6SWRMX12UWYS5BNNQ8MW3FCHLQ';

//$config['licenseName'] = 'giasuthanhdanh.com';
//$config['licenseKey']  = 'KYNYYRXDG4QU7HW9JEY9CAFM9B1EN';

$config['privateDir'] = array(
    'backend' => 'default',
    'tags'   => '.ckfinder/tags',
    'logs'   => '.ckfinder/logs',
    'cache'  => '.ckfinder/cache',
    'thumbs' => '.ckfinder/cache/thumbs',
);

$config['images'] = array(
    'maxWidth'  => 1600,
    'maxHeight' => 1200,
    'quality'   => 80,
    'sizes' => array(
        'small'  => array('width' => 480, 'height' => 320, 'quality' => 80),
        'medium' => array('width' => 600, 'height' => 480, 'quality' => 80),
        'large'  => array('width' => 800, 'height' => 600, 'quality' => 80)
    )
);

$config['backends'][] = array(
    'name'         => 'default',
    'adapter'      => 'local',
    'baseUrl'      => '/storage',
    //  'root'         => '', // Can be used to explicitly set the CKFinder user files directory.
    'chmodFiles'   => 0777,
    'chmodFolders' => 0755,
    'filesystemEncoding' => 'UTF-8',
);

$config['defaultResourceTypes'] = '';

$config['resourceTypes'][] = array(
    'name'              => 'Storage',
    'directory'         => '',
    'maxSize'           => 0,
    'allowedExtensions' => '7zip,gz,gzip,rar,tar,zip,gif,jpeg,jpg,png,bmp,avi,flv,mid,mov,mp3,mp4,mpc,mpeg,mpg,swf,wav,wma,wmv,mkv,csv,doc,docx,ods,odt,pdf,ppt,pptx,pxd,rtf,xls,xlsx',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);

$config['resourceTypes'][] = array(
    'name'              => 'Files',
    'directory'         => 'files',
    'maxSize'           => 0,
    'allowedExtensions' => '7zip,gz,gzip,rar,tar,zip',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);

$config['resourceTypes'][] = array(
    'name'              => 'Documents',
    'directory'         => 'documents',
    'maxSize'           => 0,
    'allowedExtensions' => 'csv,doc,docx,ods,odt,pdf,ppt,pptx,pxd,rtf,xls,xlsx',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);

$config['resourceTypes'][] = array(
    'name'              => 'Media',
    'directory'         => 'media',
    'maxSize'           => 0,
    'allowedExtensions' => 'avi,flv,mid,mov,mp3,mp4,mpc,mpeg,mpg,swf,wav,wma,wmv,mkv',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);


$config['resourceTypes'][] = array(
    'name'              => 'Images',
    'directory'         => 'anhthe',
    'maxSize'           => 0,
    'allowedExtensions' => 'gif,jpeg,jpg,png,bmp',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);

$config['resourceTypes'][] = array(
    'name'              => 'Images_2',
    'directory'         => 'anhcmnd',
    'maxSize'           => 0,
    'allowedExtensions' => 'gif,jpeg,jpg,png,bmp',
    'deniedExtensions'  => '',
    'backend'           => 'default'
);

$config['roleSessionVar'] = 'CKFinder_UserRole';

$config['accessControl'][] = array(
    'role'                => '*',
    'resourceType'        => '*',
    'folder'              => '/',

    'FOLDER_VIEW'         => true,
    'FOLDER_CREATE'       => true,
    'FOLDER_RENAME'       => true,
    'FOLDER_DELETE'       => true,

    'FILE_VIEW'           => true,
    'FILE_CREATE'         => true,
    'FILE_RENAME'         => true,
    'FILE_DELETE'         => true,

    'IMAGE_RESIZE'        => true,
    'IMAGE_RESIZE_CUSTOM' => true
);

$config['overwriteOnUpload'] = false;
$config['checkDoubleExtension'] = true;
$config['disallowUnsafeCharacters'] = false;
$config['secureImageUploads'] = true;
$config['checkSizeAfterScaling'] = true;
$config['htmlExtensions'] = array('html', 'htm', 'xml', 'js');
$config['hideFolders'] = array('.*', 'CVS', '__thumbs');
$config['hideFiles'] = array('.*');
$config['forceAscii'] = false;
$config['xSendfile'] = false;

$config['debug'] = false;

$config['pluginsDirectory'] = __DIR__ . '/plugins';
$config['plugins'] = array();

$config['cache'] = array(
    'imagePreview' => 24 * 3600,
    'thumbnails'   => 24 * 3600 * 365,
    'proxyCommand' => 0
);

$config['tempDirectory'] = sys_get_temp_dir();

$config['sessionWriteClose'] = true;

$config['csrfProtection'] = true;

$config['headers'] = array();

return $config;
