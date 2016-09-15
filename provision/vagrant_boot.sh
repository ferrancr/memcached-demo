echo "Update the repository and install Apache."
apt-get update >/dev/null
apt-get install apache2 -y >/dev/null
echo "Install PHP and Apache\'s mod_php extension."
apt-get install php5 libapache2-mod-php5 php5-mcrypt -y >/dev/null
echo "Install the Memcached daemon and PHP\'s Memcache module."
apt-get install php5-memcache memcached -y >/dev/null
