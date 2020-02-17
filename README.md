Для запуска приложения необходимо:<br>
&bull; скачать все файлы<br>
&bull; переименовать файл .env.template в .env (команда mv .env.template .env
 на Linux)<br>
&bull; выполнить команду composer install<br>
&bull; внести доступы к БД в .env<br>
&bull; выполнить команду php bin/console doctrine:database:create<br>
&bull; выполнить команду php bin/console doctrine:migrations:migrate<br>


Версии программ окружения:<br>
&bull; OS Ubuntu 18.04<br>
&bull; Symfony 4.4<br>
&bull; PHP 7.3.14<br>
&bull; Apache 2.4.29