echo "primer paso: conseguir la cookie"
cookie=$(curl -v -s http://10.1.1.101/session.php 2>&1 | grep 'Set-Cookie' | sed -e 's/;.*$//' -e "s/^.*: //")
echo $cookie
echo "segungo paso: ver como se incrementa la variable guardada en sesion"
curl --cookie "${cookie}" http://10.1.1.101/session.php http://10.2.2.102/session.php http://10.3.3.103/session.php
