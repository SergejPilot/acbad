<html>
<header>
<title>Unsere Webkamera</title>
</header>

<link href='http://fonts.googleapis.com/css?family=Roboto|Roboto+Slab' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<style>
  
  header {
    background-image: url("/img/webcam/cam-1-hangar-nord.jpg");
  }
  
</style>
<body>
<p>Hier können Sie das aktuelle Wetter und Aktivitäten rund um den Hangar und Flugplatz beobachten.</p>  

<p></p>
<?php
// directory name should be ended with / !!!
function GetLastModSubDir($DirectoryIn)
{
	$iterator = new DirectoryIterator($DirectoryIn);
    $filenames = array();
	foreach ($iterator as $fileinfo) 
    {
	    //echo $fileinfo->getPathname() . "<br>\n";
		//echo $fileinfo->getFilename() . "<br>\n";
	    if ($fileinfo->isDir())
		{
			if ( is_numeric($fileinfo->getFilename()) )
				$filenames[$fileinfo->getMTime()] = $fileinfo->getFilename();
		}	
    }	
	
    ksort($filenames);        
	$i=0;
	if(sizeof($filenames)>1)
	{
    	foreach ($filenames as $file)
		{
            if($i>0)
			{
				//echo $file."\n";
				$last_dir = 	$file; 	
	        }
        $i++;
		}
	}

	$DirectoryIn .=$last_dir;	
    return $DirectoryIn;
}
// info user 
$act_date_time  = date('d-m-Y'); 
$act_time  = date('H:i:s'); 
echo 'Heute ist '. $act_date_time."<br>\n"; 
echo 'Aktuelle Zeit: '. $act_time."<br>\n"; 

$appendix_snapshot = "/img/webcam/share/4L0AAA9PAG0A879/Snapshot/";
		   
$rootdir = "/var/www/vhosts/aeroclub.webhosting.hostingparadise.de/www.aero-club.eu/public";
$snapshotdir = $rootdir; 
$snapshotdir .= $appendix_snapshot;
$act_date = date('Y-m-d'); 
//$act_date = "2019-05-22";  // TODO eliminate

$snapshotdir .=$act_date;

$snapshotdir .="/001/jpg/";

$snapshotdir = GetLastModSubDir($snapshotdir);

$snapshotdir .="/"; 		
$snapshotdir = GetLastModSubDir($snapshotdir);

$dirIterMinute = new DirectoryIterator($snapshotdir); 	
foreach ($dirIterMinute as $fileInfo)
{
	//echo $fileInfo->getFilename() . "<br>\n";	
	if ( strcmp($fileInfo->getExtension(),"jpg") == 0 )	
		$jpgfile = $fileInfo->getFilename();     
}
$snapshotdir .="/"; 		
$snapshotdir .=$jpgfile; 
$output  = str_replace($rootdir, "", $snapshotdir); 
$snapshotdir = $output; 
echo "<img src=$snapshotdir caption='Aktueller Ansicht der Webkamera vor der Halle.' alt=''/>";

?>

</body>
</html>