FOR /F "delims=" %%i IN ('docker-compose config --services') DO (
    @REM docker service
    set service=%%i

    IF exist docker\!service!\.example.env (
        IF not exist docker\!service!\.env (
            copy docker\!service!\.example.env docker\!service!\.env >NUL
        )
    )
)

call run stop

docker-compose build --no-cache

docker-compose run php composer install
