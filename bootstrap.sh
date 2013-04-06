#!/bin/sh

apt-get update
apt-get install -y apache2
apt-get install -y php5
apt-get install -y libapache2-mod-php5
apt-get install -y php-pear
export DEBIAN_FRONTEND=noninteractive
echo 'mysql-server-5.1 mysql-server/root_password password rockalist5576' | sudo debconf-set-selections
echo 'mysql-server-5.1 mysql-server/root_password_again password rockalist5576' | sudo debconf-set-selections
apt-get install -y mysql-server
apt-get install -y php5-mysql
sudo /etc/init.d/mysql restart
pear channel-update pear.php.net
pear upgrade pear
pear install Mail
pear install Net_Smtp
apt-get install -y git-core
cd /vagrant/rockalist/vendor
git clone https://github.com/propelorm/Propel.git propel
echo "export PATH=$PATH:/vagrant/rockalist/vendor/propel/generator/bin" >> ~/.bashrc
source ~/.bashrc
pear channel-discover pear.phing.info
pear install phing/phing
pear install Log
sudo /etc/init.d/apache2 restart
rm -rf /var/www
ln -fs /vagrant /var/www
cd /vagrant/rockalist/rockalist_db
propel-gen om
propel-gen sql
echo "CREATE DATABASE rockalist" | mysql -u root --password=rockalist5576
propel-gen insert-sql
propel-gen convert-conf