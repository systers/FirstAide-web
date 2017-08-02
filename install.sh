# install php7 and mysql
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y

# install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# install node and npm
sudo apt-get install nodejs npm

# install npm gulp cli globally
npm install -g gulp-cli

# installing packages using composer
composer update

# installing packages using npm (such as gulp)
npm install

# Changing permissions of cache directory
sudo chmod -R 777 cache/

# running gulp tasks
gulp
