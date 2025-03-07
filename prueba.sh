#!/bin/sh

if [ "$1" = "up" ]
then

    docker compose up --wait
    echo "Esperando un poco a que arranque la base de datos..."
    sleep 6

elif [ "$1" = "down" ]
then

    docker compose down

elif [ "$1" = "migrate" ]
then

    docker exec prueba-tecnica-backend scripts/migrate.sh

elif [ "$1" = "run" ]
then

    docker exec prueba-tecnica-backend scripts/test.sh

else

    echo "Opcion no valida"

fi
