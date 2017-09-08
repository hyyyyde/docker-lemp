#!/bin/sh

set -eu

DB_EXIST=`docker exec -t local_postgresql psql -U postgres -p 5432 -c "\l" | grep "docker " | wc -l`
if [ ${DB_EXIST} == 0 ]; then
  docker exec -t local_postgresql psql -U postgres -p 5432 -c "CREATE DATABASE docker"
else
  echo "Already exist \"docker\" database."
fi

DB_EXIST=`docker exec -t local_postgresql psql -U postgres -p 5432 -c "\l" | grep "docker_test " | wc -l`
if [ ${DB_EXIST} == 0 ]; then
  docker exec -t local_postgresql psql -U postgres -p 5432 -c "CREATE DATABASE docker_test"
else
  echo "Already exist \"docker_test\" database."
fi
