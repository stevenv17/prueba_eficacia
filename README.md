# Instrucciones


**Base de datos (en raiz de proyecto):**

1. prueba_eficacia.sql
2. cambiar variable de entorno **DATABASE_URL** en archivo **.env** según corresponda a credenciales de MYSQL.


**Correr app (es necesario tener instalado symfony):**

``` sudo symfony server:start ```

**Usar API: **

Descargar insomnia (es probable que también se pueda importar en Postman) e importar las peticiones del archivo **Insomnia_2021-02-01** que se encuentra en la raiz.


**Consideraciones:**

1. Es recomendable la versión 7.4.13 de PHP
2. En caso de tener que instalar depenencias, se recomienda el uso de la versión 1.10.19 de Composer. Posteriormente correr : Composer install
3. Otros comandos que podrían llegar a ser de ayuda:

```
sudo apt-get -y update && apt-get -y upgrade
sudo apt install php7.4-cli
sudo add-apt-repository -y ppa:ondrej/php && sudo apt-get -y install php-pear php7.4-curl php7.4-dev php7.4-gd php7.4-mbstring php7.4-zip php7.4-mysql php7.4-xml
sudo apt-get install php-pgsql
sudo apt autoremove
```
