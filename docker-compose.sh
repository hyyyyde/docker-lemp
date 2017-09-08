#!/bin/sh

set -eu


# bashでalias機能をONにする
# 理由はMacのsedでファイル上書きする場合、ファイル拡張子指定を"なし"にしないと、
# 勝手にバックアップファイルが作成されてしまうため
# @see http://qiita.com/narumi_888/items/e425f29b84da6b72ad62
shopt -s expand_aliases
if sed --version 2>/dev/null | grep -q GNU; then
  alias sedi='sed -i '
else
  alias sedi='sed -i "" '
fi


COMMAND_SUB=${1:-up}
MEMORY_LIMIT=${2:-2048}

# MacのIPアドレスを取得する
REMOTE_HOST=`netstat -rn -f inet | awk '/^default/{print $6}' | xargs ipconfig getifaddr`
# docker-compose.ymlで使用するためexportしておく
export REMOTE_HOST=${REMOTE_HOST}


#
# sleep...
#
function wait_process() {
  #statements
  local SLEEP_COUNT=1
  local SLEEP_MAX_COUNT=$1
  while [ ${SLEEP_COUNT} -ne ${SLEEP_MAX_COUNT} ]
  do
    /bin/echo -n "."
    sleep 1
    SLEEP_COUNT=`expr ${SLEEP_COUNT} + 1`
  done
}


#
# initialize database
#
function init_dababase() {

  echo ""
  echo "Waiting database service..."

  # dockerizeによるポート監視
  docker run --rm \
          --link local_mysql:mysql \
          --link local_postgresql:postgresql \
          --network=dockerlemp_default \
          --entrypoint="" \
          hyyyyde/dockerize:1.0.0 \
          dockerize -wait tcp://mysql:3306 -wait tcp://postgresql:5432 -timeout 30s

  # ポート監視終わっても直後にはpostgresqlなどはアクセスできないので少し待つ
  wait_process 5

  echo "Connected!"
  echo ""

  echo ""
  echo "Initializing PostgreSQL..."
  sh ./postgresql/init.sh

  echo ""
  echo "Initializing MySQL..."
  sh ./mysql/init.sh
}

#
# docker-compose up
#
function docker_compose_up() {
  # xdebug設定ファイルをコピー
  cp ./php-fpm/docker-php-ext-xdebug.ini.dist ./php-fpm/docker-php-ext-xdebug.ini
  # xdebug.remote_hostを置換
  sedi -e "s/REMOTE_HOST/${REMOTE_HOST}/" ./php-fpm/docker-php-ext-xdebug.ini

  # php.iniをコピー
  cp ./php-fpm/php.ini.dist ./php-fpm/php.ini
  # memory_limitを置換
  sedi -e "s/__MEMORY_LIMIT__/${MEMORY_LIMIT}/" ./php-fpm/php.ini

  docker-compose up -d

  init_dababase
}


#
# docker-compose down
#
function docker_compose_down {
  docker-compose down
}


echo ""
case "$COMMAND_SUB" in
  up )
  docker_compose_up
  ;;

  down )
  docker_compose_down
  ;;

  * )
  ;;
esac

echo ""
docker-compose ps

echo ""
echo "Finished!!"
echo ""

exit 0
