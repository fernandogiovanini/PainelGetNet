Painel para consulta a GetNet
=============================

Faz o download dos extratos da GetNet e permitem a consulta por data, exibindo as informações em um dashboard separando os pagamentos por bandeira e tipo de transação
(crédito ou débito).

##Instalação
``` shellscript
git clone git@github.com:fernandogiovanini/painelgetnet.git
cd PainelGetNet
docker-compose build
docker-compose up -d
docker-compose run php-no-xdebug composer install
docker-compose run php-no-xdebug app/console assetic:dump
docker-compose run php-no-xdebug app/console doctrine:schema:create
```
##Configurações
Na instalação do sistema serão solicitados os parâmetros de configuração, entre eles o Merchand ID (**getnet.merchand_id**) e a identificação do arquivo (**getnet.merchand_file_identificaction**).

O **Merchand** ID deverá ser fornecido pela GetNet e tem o formato *123456_seuestabelecimento*. Para a identificação do arquivo (**getnet.merchand_file_identificaction**) informe o mesmo valor do Merchand ID.

No arquivo config.yml informar o usuário do SFTP da GetNet nos campos
**oneup_flysystem.adapters.sftp_getnet.sftp.username** e **oneup_flysystem.adapters.sftp_getnet.sftp.password**.

Se o Symfony tentar escrever o cache ou log e não conseguir, alterar o
proprietário do diretório correspondente.

##Configurar ambiente de desenvolvimento
O .htaccess foi configurado para usar o bootstrap de desenvolvimento (app_dev.php) quando acessado pelo endereço http://painelgetnet.dev. Para isso, adicione a seguinte linha ao arquivo /etc/hosts:
```shellscript
127.0.0.1       painelgetnet.dev
```
Acessar http://painelgetnet.dev

##Criar um usuário
Para acessar o painel, execute o comando a seguir e acesse com o usuário admin senha admin:
``` shellscript
docker-compose run php-no-xdebug app/console fos:user:create admin admin@admin.com admin
```

##Extração de dados da GetNet
Para fazer o download o arquivo do extrato GetNet do dia atual executar o comando
``` shellscript
docker-compose run php-no-xdebug app/console getnet:statement:download
```

Caso queira faze ro download do arquivo de outro dia
``` shellscript
docker-compose run php-no-xdebug app/console getnet:statement:download ddmmyyyy
```
