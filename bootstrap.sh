
#!/usr/bin/env bash

# Use single quotes instead of double quotes to make it work with special-character passwords
PASSWORD='root'
ROOTFOLDER='/vagrant'

# update / upgrade
sudo apt-get update
sudo apt-get -y upgrade

#install cron
sudo apt install -y cron
sudo systemctl enable cron

# install apache 2.5 and php 5.5
sudo apt-get install -y apache2
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update -y
sudo apt upgrade -y
sudo apt-get -y update
sudo apt-get -y upgrade
sudo apt-get install php7.4 php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y

# install mysql and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server
sudo apt install -y mysql-client-core-5.7

# install phpmyadmin and give password(s) to installer
# for simplicity I'm using the same password for mysql and phpmyadmin
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# install phpmyadmin and give password(s) to installer
# for simplicity I'm using the same password for mysql and phpmyadmin
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASSWORD"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
    DocumentRoot "$ROOTFOLDER/public"
    <Directory "$ROOTFOLDER/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf

# enable mod_rewrite
sudo a2enmod rewrite

# restart apache
sudo service apache2 restart

# install git
sudo apt-get -y install git

# install Composer
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# install NPM and node js
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.35.2/install.sh | bash
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" # This loads nvm
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion" # This loads nvm bash_completion
nvm install 16.15.1
nvm use 16.15.1

# install libraries needed for snappy image
sudo apt install libxrender1 libssl1.0-dev -y

# apt update
sudo apt-get update
sudo apt-get -y upgrade

npm cache clean -f
npm install -g n

sudo sed -i 's,^post_max_size =.*$,post_max_size = 256M,' /etc/php/7.4/apache2/php.ini
sudo sed -i 's,^upload_max_filesize =.*$,upload_max_filesize = 256M,' /etc/php/7.4/apache2/php.ini
sudo sed -i 's,^post_max_size =.*$,post_max_size = 256M,' /etc/php/7.4/cli/php.ini
sudo sed -i 's,^upload_max_filesize =.*$,upload_max_filesize = 256M,' /etc/php/7.4/cli/php.ini
sudo service apache2 restart

echo "SET GLOBAL sql_mode='NO_ENGINE_SUBSTITUTION'" | mysql -u root --password="root"
echo "SET sql_mode='NO_ENGINE_SUBSTITUTION'" | mysql -u root --password="root"
echo "CREATE DATABASE phptest" | mysql -u root --password=$PASSWORD

echo "Finished provisions"
