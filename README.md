# COMANDOS SYMFONY

symfony new --webapp nombre_proyecto

php bin/console doctrine:database:create

php bin/console make:migration
symfony console make:migration
php bin/console doctrine:migrations:migrate
symfony console doctrine:migrations:migrate

php bin/console make:user
php bin/console make:auth
php bin/console make:registration-form

php bin/console make:entity
php bin/console make:crud
php bin/console make:controller

symfony server:start -> inicia symfony


php bin/console doctrine:schema:update --force

Cambiar LoginAuthenticator comentar linea 53 y descomentar linea 54 y reemplazar 'some_route' por 'app_main' o donde queramos redireccionar al hacer login 

#[IsGranted("ROLE_ADMIN")]

Mostrar la primera foto de un comentario de un hilo o una por defecto templates/forum/show.html.twig

a la opcion se le dice que no
composer require symfony/maker-bundle --dev
composer require security
composer require orm
composer require twig
composer require form validator
composer require symfony/mime
composer require --dev symfony/profiler-pack