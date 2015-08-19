<?php
function IpReal()
{
   if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
   {
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
      $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
      reset($entries);
      while (list(, $entry) = each($entries)) 
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            $private_ip = array(
                  '/^0\./', 
                  '/^127\.0\.0\.1/', 
                  '/^192\.168\..*/', 
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                  '/^10\..*/');    
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
 
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
   }
   return $client_ip;
}
function ObtenerNavegador($user_agent) {
  $navegadores = array(
        'Opera' => 'Opera',
        'Mozilla Firefox'=> '(Firebird)|(Firefox)',
        'Galeon' => 'Galeon',
        'Mozilla'=>'Gecko',
        'MyIE'=>'MyIE',
        'Lynx' => 'Lynx',
        'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
        'Konqueror'=>'Konqueror',
        'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
        'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
        'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
        'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
  );
  foreach($navegadores as $navegador=>$pattern){
         if (eregi($pattern, $user_agent))
         return $navegador;
      }
  return 'Desconocido';
}
?>