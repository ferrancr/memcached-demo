<?php
$my_server = $_SERVER['SERVER_ADDR'];

$memcache_obj = new Memcache;

// Multiples servidores comparten claves
foreach(array('10.1.1.101','10.2.2.102','10.3.3.103') as $server ) {
        $memcache_obj->addServer($server, 11211);
}
// Solo inicializa si no está asignado. En ese caso devuelve true
// $status = $status = $memcache_obj->add('counter',0); // Comentado por que cada 6 peticiones hay que ponerlo a 0;


$counter = $memcache_obj->increment('counter', 2); // Ojo si es la primera vez increment no inicializa a 0.

 if ($counter > 6 || $counter == false ) {
    echo "$my_server: limpieza por contador\n";
    // $memcache_obj->flush(); // radical limpieza y con multiples servidores da problemas con el add...No recomendable.
   
    // Ojo con los problemas "race condicion" ya que puede existir que dos peticiones simultaneas cumplan la condicion $counter > 6, 
    // Garantizamos que el ultimo guarda el valor. 
    $counter = 2;
    $memcache_obj->set('counter',$counter); 
    $memcache_obj->set('origen', $my_server.'='.date("Y-m-d H:i:s"));

 }
echo "$my_server: contador = $counter\n";
echo "$my_server: Origen: ".$memcache_obj->get('origen')."\n";
