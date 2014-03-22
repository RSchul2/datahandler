<?php
function createFilename($targetURL) {
   $string = str_replace(' ', '-', $targetURL);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

// function to get data
function get_data($cacheFile,$targetURL)
{
$cacheTime=1000;
if (is_cached($cacheFile) &&(time() - $cacheTime < filemtime($cacheFile))) 
	{
	$data=new SimpleXMLElement(read_cache($cacheFile));	
	} 
else 
	{
	$data= simplexml_load_file($targetURL);
    write_cache($cacheFile,$data->asXML());
	}
return $data->asXML();
} 


// check if file exists
function is_cached($cacheFile) 
	{
 	$cacheFile_created = (file_exists($cacheFile)) ;
 	return $cacheFile_created;
}
 

// write cache file if not existend
function write_cache($cacheFile,$cacheData)
	{
	print "caching file";
	$fp = fopen($cacheFile, 'w');
	fwrite($fp, $cacheData);
	fclose($fp);
	}

// read from cache
function read_cache($cacheFile) {
return file_get_contents($cacheFile);
}
?>

