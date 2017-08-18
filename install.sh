# install php7 and mysql
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y

# install composer, a package dependency manager
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# install node and npm for minification of css
sudo apt-get install nodejs npm

# install npm gulp cli globally for css minification
sudo npm install -g gulp-cli

# installing packages using composer
composer update

# installing packages using npm (such as gulp)
npm install

# Changing permissions of cache directory
sudo chmod -R 777 cache/

# running gulp tasks for minifying css
gulp
