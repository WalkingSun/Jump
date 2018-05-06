#!/bin/bash
source /etc/profile

if [ ! $1 ];then
    echo "Usage: $0 enviroment"
    exit 1
fi

PROJECT_NAME="InnPSupply_Mobile"

function check() {
  if [ $1 != 0 ];then
    echo "exec fail"
    exit 1
  fi
}

mkdir $PROJECT_NAME
mv * $PROJECT_NAME
chmod 777 -R  $PROJECT_NAME
tar -czvf  "$PROJECT_NAME".tar.gz  $PROJECT_NAME/ 
check $?
echo "MW_SUCCESS"
