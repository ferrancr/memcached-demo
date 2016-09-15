# from https://www.digitalocean.com/community/tutorials/how-to-share-php-sessions-on-multiple-memcached-servers-on-ubuntu-14-04
echo "Configure memcache: Change it to listen on this server's private IP address
    -l $1
"
cp /etc/memcached.conf /etc/memcached.conf.original
sed -e "s/127\.0\.0\.1/$1/" /etc/memcached.conf.original > /etc/memcached.conf
service memcached restart
echo "Set Memcache as PHP's Session Handler
    session.save_handler = memcache
    session.save_path = 'tcp://10.1.1.101:11211,tcp://10.2.2.102:11211,tcp://10.3.3.103:11211'
"
cp /etc/php5/apache2/php.ini /etc/php5/apache2/php.ini.original
sed -e '/^;session.save_path = .*5./ a\\nsession.save_path = "tcp://10.1.1.101:11211,tcp://10.2.2.102:11211,tcp://10.3.3.103:11211"' \
   -e '/^session.save_handler/ s/files/memcache/' \
   /etc/php5/apache2/php.ini.original > /etc/php5/apache2/php.ini
echo "Configure Memcache for Session Redundancy
    memcache.allow_failover=1
    memcache.session_redundancy=4
"
cp /etc/php5/mods-available/memcache.ini /etc/php5/mods-available/memcache.ini.original
echo "emcache.allow_failover=1
memcache.session_redundancy=4 " >>/etc/php5/mods-available/memcache.ini

service apache2 reload
