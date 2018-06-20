#!/usr/bin/env bash
declare -a vars=(
"FOO"
"BAR"
)
for i in "${vars[@]}"
do
	echo "fastcgi_param $i \"${!i}\";" >> /etc/nginx/fastcgi_params_app
done
chown -R www-data:www-data /app/storage
supervisord -n
