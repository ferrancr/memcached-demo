# memcached-demo

## Como compartir sesiones con Memcached en multiples servidores linux (Ubuntu)

Es una demo basada en los pasos descritos en el post de  Jesin A @jesinwp  [How To Share PHP Sessions on Multiple Memcached Servers on Ubuntu 14.04 ](https://www.digitalocean.com/community/tutorials/how-to-share-php-sessions-on-multiple-memcached-servers-on-ubuntu-14-04)
pero en vez de utilizar los servidores de DigitalOcean he creado los scripts necesarios para que sea una instalación, configuración automática en local utilizando Vagrant y Virtualbox.

Se necesita tener previamente instalado Vagrant y Virtualbox

1)  Crear el entorno de 3 servidores 

  vagrant up

Con ello tendremos 3 servidores disponibles (ubuntu/trusty32) y con todo el software necesario instalado.

* srv01 ip: 10.1.1.101
* srv02 ip: 10.2.2.102
* srv03 ip: 10.3.3.103


2) Lanzar el script que realiza la demostración de compartir sesiones

  sh scripts/run_demo.sh
