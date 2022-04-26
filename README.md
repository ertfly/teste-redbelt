# Requisitos #
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

- Clone o projeto
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
```