# Respuestas (punto 2):

1. Para manejar un inventario, lo primero que se tiene que hacer es tener un campo que permita saber cuantos productos hay de cada tipo, es decir
que la tabla de productos deberia tener un campo de cantidad. También en cada venta se deberían ir restando. Por último en la tabla de ventar se podría tener un campo de estado, por si el producto fue devuelto, esos no contarian como productos que salieron sino que aún permanecen.

2. El reporte de ventas se puede hacer por medio de una consulta a la tabla de ventas, allí se encontraria el valor a detalle de cada producto que se vendío (gracias a la relaciín con la tabla de productos), su iva, la cantidad, etc. También se podría agregar un campo de estado para saber si algo fue devuelto y que ya no sería parte de dicho reporte.

3. Crearía un comando y lo programaria en CRON para que se ejecute una vez al día. El comando haría una petición con el archivo al webservice.


# Instrucciones (punto 1)


**Base de datos (en raiz de proyecto):**

1. prueba_eficacia.sql
2. cambiar variable de entorno **DATABASE_URL** en archivo **.env** según corresponda a credenciales de MYSQL.

**Instalación de dependencias (se recomienda versión 1.10.19 de Composer):**
```
Composer install
```


**Correr app (es necesario tener instalado symfony):**

``` sudo symfony server:start ```

**Usar API:**

Descargar insomnia (es probable que también se pueda importar en Postman) e importar las peticiones del archivo **Insomnia_2021-02-01** que se encuentra en la raiz.


**Consideraciones:**

1. Es recomendable la versión 7.4.13 de PHP
2. Otros comandos que podrían llegar a ser de ayuda:

```
sudo apt-get -y update && apt-get -y upgrade
sudo apt install php7.4-cli
sudo add-apt-repository -y ppa:ondrej/php && sudo apt-get -y install php-pear php7.4-curl php7.4-dev php7.4-gd php7.4-mbstring php7.4-zip php7.4-mysql php7.4-xml
sudo apt-get install php-pgsql
sudo apt autoremove
```
