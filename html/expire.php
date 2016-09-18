<?php
$my_server = $_SERVER['SERVER_ADDR'];
echo "Server IP: ".$my_server . "\n";
// lanzar un wzoiew.php?save=1, antes de realizar la demo de api_memcache.
// todos los 3 servidores comparten el data.txt
if ($_GET['save']) { 
    $fp = fopen('data.txt', 'w');
    fwrite($fp, $my_server);
    fclose($fp);
    exit();
}


 //Nos conectamos al memcached local del servidor
( $memcache_obj = memcache_connect($my_server, 11211) ) || die("No se pudo conectar al memcache local");

$version = $memcache_obj->getVersion();
echo "Versión del servidor: ".$version."\n";

$str_new = "Cache";
if ( ! $value = $memcache_obj->get('data') ) {
   $str_new = "Nuevo";
   $value = chop(file_get_contents('data.txt'));
   // Add para evitar los problemas de "race condicion", ya que puede existir que dos peticiones simultanemas tegan value a null 
   // entonces solo se incorpora si no esta definido. 
   // El valor lo mantenemos por 10 segundos.
   $memcache_obj->add('data',$value,0,10);
}
echo "$str_new value=$value\n";
