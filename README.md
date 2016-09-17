# memcached-demo

## Como compartir sesiones con Memcached en multiples servidores linux (Ubuntu)

El post de  Jesin A @jesinwp  [How To Share PHP Sessions on Multiple Memcached Servers on Ubuntu 14.04 ](https://www.digitalocean.com/community/tutorials/how-to-share-php-sessions-on-multiple-memcached-servers-on-ubuntu-14-04) me motivó para hacer una serie de demostraciones del uso del memcached en PHP. 

Por mi parte he automatizado todo el proceso de creación y configuración de los servidores utilizando Vagrant / Virutalbox y añadido un par de demostraciones mas.


Así que en resumen tenemos:
* Instalación y configuración con Vagrant.
* Compartir sesiones PHP sobre multiples servidores con Memcached
* Validar configuraciones utilizando tcp/sockets
* Operaciones disponibles en php-memcached

### Instalación y configuración

Se necesita tener previamente instalado Vagrant,  Virtualbox.

Crear el entorno de 3 servidores 

  vagrant up

Con ello tendremos 3 servidores disponibles (ubuntu/trusty32) y con todo el software necesario instalado.

* srv01 ip: 10.1.1.101
* srv02 ip: 10.2.2.102
* srv03 ip: 10.3.3.103

Para entender como se hace, mirar los ficheros de configuración Vagrantfile, provision/vagrant_boot.sh y provision/vagrant_config.sh


### Demostración de compartir sesiones PHP sobre múltiples servidores con Memcached

Lanzar el script (linux shell) que realiza la demostración de compartir sesiones entre múltiples servidores.

  sh scripts/run_demo.sh

run_demo realiza llamadas a las web utilizando curl, así que lo deberás de tener instalado o utilizar la solución para entornos Windows

En Windows si se quiere lanzar la shell se puede hacer desde uno de los servidores:

Nos conectamos al primer servidor
  vagrant ssh srv01  
  
Lanzamos la shell
  sh /vagrant/scripts/run_demo.sh
  
Para una explicación en detalle ver el script/run_demo.sh y html/session.php y la web  [How To Share PHP Sessions on Multiple Memcached Servers on Ubuntu 14.04 ](https://www.digitalocean.com/community/tutorials/how-to-share-php-sessions-on-multiple-memcached-servers-on-ubuntu-14-04)
  
### Validar configuraciones utilizando el tcp/sockets. 

Para saber si el memcached está activo y su configuración es correcta en los 3 servidores, vamos a  verificar las respuestas a las llamadas GET y SET contra al puerto 11211 de cada uno de los servidores.

   php scripts/memcached_tcp.php
   
Otra opción es probarlo desde uno de los servidores
   
   vagrant ssh srv01
   php /vagrant/scripts/memcached_tcp.php
   
   Mas información sobre el protocolo de memcached: http://blog.elijaa.org/2010/05/21/memcached-telnet-command-summary/
   
### Operaciones disponibles en php-memcached

próximamente
