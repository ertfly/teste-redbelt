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

- Faça o pull da imagem **mongo:4.4.6** (Imagem oficial)
```
$ docker pull mongo:4.4.6
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

- Copie o arquivo **mongo-init.sample.js** renomeando para **mongo-init.js**
```
$ cp mongo-init.sample.js mongo-init.js
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

- Caso queira acessar a base de dados você pode usar o software cliente Mongo Compass, basta alterar o arquivo **docker-compose.yml** subistitua na parte **27017** pela porta da sua máquina disponível mais o símbolo **:**, ficando da seguinte maneira **27018:27017** no caso escolhi a porta 27018
```
  ...
    ports:
      - '27017'
  ...
```