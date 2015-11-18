<?php
class FileHelper
{
    /*
     * Force download
     * 17/4/2013
     * @author bb
     */
    
    public function forceDownload($src)
    {                
            if(@file_exists($src)) {
//                        $path_parts = @pathinfo($src);
                    //$mime = $this->__get_mime($path_parts['extension']);
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    //header('Content-Type: '.$mime);
//                    header('Content-Disposition: attachment; filename='.time().'_'.self::getFileName($src));
                    header('Content-Disposition: attachment; filename="'.self::getFileName($src).'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($src));
                    ob_clean();
                    flush();
                    readfile($src);
            } else {
                    header("HTTP/1.0 404 Not Found ".$src);
                    exit();
            }

    }
    
    /**
     * @param string $path = "/upload/filename.jpg";
     * @return string jpg
     * @author bb
     */
    public static function getExtensionName($path)
    {
        $filename = basename($path); 
        $arr = explode('.', $filename);
        if(count($arr) == 2)
            return $arr[1];
        return '';
    }
    
    /**
     * @param string $path = "/upload/filename.jpg";
     * @return string filename.jpg
     * @author bb
     */
    public static function getFileName($path)
    {
        $filename = basename($path); 
//        $filename = self::toValidFileName($filename);
        return $filename;
    }
    
    public static function toValidFileName($fileName)
    {
        $fileName = str_replace(' ', '_', $fileName);
        return $fileName;
    }
    
	static public function removeDirectory($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? self::removeDirectory("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	} 
}

