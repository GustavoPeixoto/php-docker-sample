@echo off
setlocal EnableDelayedExpansion

@REM possible batch file name
set file=batch\%1.cmd

IF exist %file% (
    echo -- ".\!file!"
    call %file%
) ELSE (
    set service=php
    set command=%*

    FOR /F "delims=" %%i IN ('docker-compose config --services') DO IF %%i == %1 (
        @REM docker service
        set service=%%i

        @REM all arguments except first argument
        for /f "tokens=1,* delims= " %%a in ("%*") do set command=%%b
    )

    echo runing "!command!" inside "!service!" service 
    docker-compose run --rm --remove-orphans !service! !command!
)