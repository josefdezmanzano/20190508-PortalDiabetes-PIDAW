20190508-PortalDiabetes-PIDAW


-------------------------GUIA DE INSTALACION-------------------------------


1. Descargais o clonais el repositorio en vuestro equipo.

2. Abris una consola y os moveis a la carpeta del proyecto.

3. Debereis poner composer install.
    Se os descargaran y instalaran las dependencias del proyecto.

4. Una vez terminada la carga de dependencias tendreis en esa misma carpeta un archivo .env.example
   Ese archivo es el que contiene la información de configuracion de nuestro proyecto, ahí debereis poner 
   el nombre de vuestra base de datos y usuario y contraseña como en el siguiente ejemplo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=PortalDiabetes
DB_USERNAME=admin
DB_PASSWORD=secreto

Y debereris agregar un servidor de correo si quereis probar la funcionalidad de reseteo de contraseñas mediante email.
Deberia quedar como en el siguiente ejemplo:

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=josefernandezmanzano96@gmail.com
MAIL_PASSWORD=77154199d
MAIL_ENCRYPTION=tls

 5. Una vez puestos estos datos debereis hacer una migracion de las tablas a la base da datos para eso lo que deberemos poner
    en consola es lo siguiente:
    
    php artisan migrate:fresh
    
    Si os da algun fallo utilizad 
    
    php artisan migrate:refresh
    
    Seguido de:
    
    php artisan migrate:fresh
    
    Con esto debereis de tener el portal totalmente funcional pero sin datos.
    Para usarlo de manera sencilla bastara con poner:
    
    php artisan serve
    
    y nos dara una direccion parecida a la sigueinte http://localhost:8000 
    
    y si vamos al navegador ya deberiamos de tener acceso al foro si estais desde windows(ya que la seguridad es nula).
    
    Si estais desde Linux os dira que no teneis acceso a determinados archivos, sera tan facil como ir dando permisos 775
    a tantos archivos o carpetas como nos pida Laravel.
    
    En principio estos serian los permisos a modificar para no tener problemas de permisos:
    
    sudo chgrp -R www-data storage bootstrap/cache
    
    sudo chmod -R 775 storage bootstrap/cache
    
    
