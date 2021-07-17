#!/bin/bash
clear

networkName=zpt-network

#Variables to change
mysqlRootPassword=rootpass
mysqlDatabase=zpt-database
mysqlUser=dbuser
mysqlUserPassword=userpass

if [ ! -f .env ]; then

  cp env.sample .env

else

  echo '.env file exists'
  exit 1

fi

net=$(docker network ls | grep "$networkName")

if [ -z "$net" ]; then

  docker network create --driver=bridge --subnet=172.25.0.0/16 --gateway=172.25.0.1 "$networkName"

fi

sed -i "s+MYSQL_ROOT_PASSWORD=+MYSQL_ROOT_PASSWORD=$mysqlRootPassword+g" .env
sed -i "s+MYSQL_DATABASE=+MYSQL_DATABASE=$mysqlDatabase+g" .env
sed -i "s+MYSQL_USER=+MYSQL_USER=$mysqlUser+g" .env
sed -i "s+MYSQL_USERPASS=+MYSQL_USERPASS=$mysqlUserPassword+g" .env
