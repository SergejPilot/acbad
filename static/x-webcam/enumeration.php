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
function GetLastModSubDir($DirectoryIn, $DirOnly)
{
	$iterator = new DirectoryIterator($DirectoryIn);
    $filenames = array();
	foreach ($iterator as $fileinfo) 
    {
	    //echo $fileinfo->getPathname() . "<br>\n";
		//echo $fileinfo->getFilename() . "<br>\n";
	    if ( $DirOnly === true && $fileinfo->isDir() && is_numeric($fileinfo->getFilename()) )
		{			
				$filenames[$fileinfo->getMTime()] = $fileinfo->getFilename();
		}	
		else 
			$filenames[$fileinfo->getMTime()] = $fileinfo->getFilename();
    }	
	
    ksort($filenames);        
	$i=0;
	$iCount =  sizeof($filenames); 
	if( $iCount > 1)
	{
    	foreach ($filenames as $file)
		{
            if($i>0)
			{
				if ( $i < ( $iCount - 60 ) )
					echo $file."\n";
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
echo 'Heute ist '. $act_date_time.", \n"; 
echo 'aktuelle Zeit '. $act_time.", Ansicht der Webkamera vor der Halle, Richtung Nord-Ost <br>\n"; 

$appendix_snapshot = "/img/webcam/share/4L0AAA9PAG0A879/Snapshot/";
		   
$rootdir = "/var/www/vhosts/aeroclub.webhosting.hostingparadise.de/www.aero-club.eu/public";
$snapshotdir = $rootdir; 
$snapshotdir .= $appendix_snapshot;
$act_date = date('Y-m-d'); 

$lastFile = GetLastModSubDir($snapshotdir, false);

?>

</body>
</html>