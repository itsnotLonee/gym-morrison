# GYM-MORRISON
## Despliegue en local
A continuación se enumeran los pasos necesarios para el despliegue en local de la aplicación.
### Requerimientos
Se requiere tener instalado el siguiente software externo para el correcto funcionamiento de la aplicación, se expondrán los comandos utilizados en entorno Unix (Linux / macOS).
 - Instalaremos XAMPP para nuestra plataforma lo que nos instalará automáticamente PHP lo cual necesitaremos a lo largo del proyecto. Podemos descargar XAMPP <a href="https://www.apachefriends.org/es/index.html" target="_blank">aquí</a>.
 - Git, necesitaremos tener instalado en binario de Git para poder descargar el proyecto. Podremos descargarlo <a href="https://git-scm.com/downloads" target="_blank">aquí</a>, o si tenemos el gestor de paquetes brew, con el siguiente comando:
```
$ brew install git
```
 - NPM, podremos descargarlo <a href="https://nodejs.org/en/" target="_blank">aquí</a>.
 - Composer, para la instalación de composer podremos hacerlo desde su web, aquí. O mediante línea de comandos:
```
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
$ php composer-setup.php --install-dir=bin
```
### Descarga y Ejecución
A continuación, los siguientes pasos a seguir deben hacerse en terminal.
  - Nos posicionamos en la carpeta dentro de XAMPP llamada ‘htdocs’.
```
$ php -r "unlink('composer-setup.php');"
```
  - Descargamos el proyecto desde el repositorio oficial.
```
$ git clone https://github.com/itsnotLonee/gym-morrison.git
```
  - Nos situamos en la carpeta del proyecto.
```
$ cd gym-morrison
```
  - Instalamos todas las dependencias de NPM.
```
$ npm install
```
  - Instalamos todas las dependencias de Composer
```
$ composer install
```
  - Creamos la Base de datos mediante Symfony.
```
$ php bin/console doctrine:database:create
```
  - Seguidamente enviamos las queries de creación de las tablas relacionadas.
```
$ php bin/console doctrine:schema:update --force
```
  - Una vez tengamos esto instalado necesitaremos el binario de symfony.
```
$ curl -sS https://get.symfony.com/cli/installer | bash
```
<br>
Una vez tengamos todo listo para funcionar, nos faltará solo ejecutarlo en local. Con el bundle que se nos instala automáticamente con las dependencias de Composer, tenemos symfony-webserver, el cual nos permite crear un servidor de desarrollo en local para nuestro proyecto
<br> <br>
Deberemos iniciar la BBDD y Apache desde la aplicación de XAMPP antes de esto.
<br> <br>
Una vez tengamos iniciados MySQL y Apache, podremos ejecutar el servidor de desarrollo de Symfony.
<br>

```
$ symfony server:start
```

De esta manera ya tendríamos nuestro servidor funcionando en la ruta:
<a href="https://localhost:8000/">https://localhost:8000/</a>
<br> <br>
Necesitaremos insertar los siguientes datos en BBDD para el correcto funcionamiento de la plataforma. Lo podremos hacer de la manera que más nos convenga, lo que nosotros recomendamos es: 
<br> <br>
 - Dirigirnos a http://localhost/phpmyadmin.
<br> <br>
 - Cliquear sobre la BBDD gym-morrison.
<br> <br>
 - Dirigirnos al submenú llamado ‘SQL’.
 <br> <br>
 Una vez aquí insertamos los siguientes comandos:
 
 ```
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Monthly Subscription', '20€', '30');
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Two months Subscription', '35€', '60');
INSERT INTO `payment` (`id`, `description`, `price`, `days`) VALUES (NULL, 'Three months Subscription', '50€', '90');
```
#### El primer usuario creado en BBDD será el administrador
