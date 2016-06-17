FROM bdata/base
MAINTAINER bdata.it <contato@bdata.it>

RUN DEBIAN_FRONTEND=noninteractive apt-get -y install mysql-server-5.5

VOLUME ['/var/lib/mysql/', '/var/log/', '/var/run/mysqld/' ]

EXPOSE 3306

ADD my.cnf /etc/mysql/my.cnf
ADD start.sh /start.sh

CMD /start.sh