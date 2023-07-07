FROM neurony/php-qa:8.1

RUN apt-get update

RUN apt-get install -y --no-install-recommends\
    vim

RUN echo 'alias c="clear"' >> ~/.bashrc \
    && echo 'alias art="php artisan"' >> ~/.bashrc \
    && echo 'alias migrate="php artisan migrate"' >> ~/.bashrc \
    && echo 'alias rollback="php artisan migrate:rollback"' >> ~/.bashrc \
    && echo 'alias seed="php artisan db:seed"' >> ~/.bashrc \
    && echo 'alias fresh="php artisan migrate:fresh"' >> ~/.bashrc \
    && echo 'alias cin="composer install"' >> ~/.bashrc \
    && echo 'alias cup="composer update"' >> ~/.bashrc \
    && echo 'alias cda="composer dump-autoload"' >> ~/.bashrc \
    && echo 'alias nrp="npm run production"' >> ~/.bashrc \
    && echo 'alias nrd="npm run development"' >> ~/.bashrc \
    && echo 'alias nrw="npm run watch-poll"' >> ~/.bashrc \
    && echo 'alias nah="git reset --hard && git clean -df"' >> ~/.bashrc \
    && echo 'alias phpunit="./vendor/bin/phpunit"' >> ~/.bashrc

CMD ["/usr/sbin/php-fpm8.1", "-O" ]
