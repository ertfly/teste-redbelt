# Periodo de desenvolvimento
- Início: 25/04/2022
- Fim: 28/04/2022

# Requisitos
- Docker
- Docker Compose (aceite version '2')

# Instruções de instalação #
- Acesse a pasta onde irá clonar o projeto

- Faça o pull da imagem **ertfly/php7.4.9-apache-buster**
```
$ docker pull ertfly/php7.4.9-apache-buster
```
> **_NOTA:_**  A imagem foi criado por mim e pode validar o Dockerfile no link https://github.com/ertfly/dockerfile-php7.4.9-apache-buster

- Faça o pull da imagem **mariadb** (Imagem oficial)
```
$ docker pull mariadb
```

- Escolha uma pasta de preferência e clone o projeto
```
$ git clone https://github.com/ertfly/teste-redbelt.git
```

- Acesse a pasta do projeto
```
$ cd teste-redbelt
```

- Copie o arquivo **docker-compose.sample.yml** renomeando para **docker-compose.yml**
```
$ cp docker-compose.sample.yml docker-compose.yml
```
> **_NOTA:_**  Os arquivos copiados estão aplicados no .gitignore, e não causará efeitos de modificação


- Criei o network dos containers
```
$ docker network create teste-dev
```
> **_NOTA:_**  Se a rede teste-dev já existir ignore.

- Altere o arquivo **docker-compose.yml** substitua na parte **8016** pela porta web disponível na sua máquina
```
    ...
    ports:
      - '8016:80'
    ...
``` 

- Altere o arquivo **docker-compose.yml** substitua na parte **3307** pela porta web disponível na sua máquina
```
    ...
    ports:
      - '3307:3306'
    ...
``` 

- Uma vez alterado o arquivo **docker-compose.yml** vamos utilizar o docker-compose para criar os containers
```
$ docker-compose up -d
```
> **_NOTA:_**  O comando reflete a versão do docker que não tem o docker-compose imbutido.

- Ao finalizar vamos instalar os pacotes das dependências
```
$ docker exec -it teste.api composer install
```
> **_NOTA:_**  O nome **teste.api** é o nome dado no container via atributo **container_name**, caso o atributo não é aceite só renomear o container utilizando o comando `docker rename {id_do_container} teste.api`, o id do container pode ser consultado utilizando o comando `docker ps` procure o id na coluna **CONTAINER ID**.

- Por fim vamos rodar o migrate da aplicação, por padrão já é criado automáticamente um usuário para acessar o sistema.
```
$ docker exec -it teste.api php artisan migrate
```