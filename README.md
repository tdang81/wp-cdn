# wpcdn.dangmedia.de
#project url
Wordpress localhost:18121
Phpmyadmin localhost:18122

#start all
docker-compose up -d

#display log
docker-compose logs -

#wordpress login
http://localhost:18121/wp-admin
User: admin
Password: test123

#stop all
docker-compose stop

#uninstall all
docker-compose down -v

#requirement
this constant must be set

DM_CDN_URL=<cdn-url>