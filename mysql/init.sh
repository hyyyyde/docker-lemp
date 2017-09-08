#!/bin/sh

set -eu

DB_EXIST=`docker exec -t local_mysql mysql -uroot -proot -e "show databases;" | grep "docker " | wc -l`
if [ ${DB_EXIST} == 0 ]; then
  docker exec -t local_mysql mysql -uroot -proot -e "CREATE DATABASE docker"
else
  echo "Already exist \"docker\" database."
fi

DB_EXIST=`docker exec -t local_mysql mysql -uroot -proot -e "show databases;" | grep "docker_test " | wc -l`
if [ ${DB_EXIST} == 0 ]; then
  docker exec -t local_mysql mysql -uroot -proot -e "CREATE DATABASE docker_test"
else
  echo "Already exist \"docker_test\" database."
fi
