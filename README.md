## Requisitos
- Docker

## Instruções de instalação
- Acesse a pasta onde irá clonar o projeto

- Clone o projeto
```
$ git clone https://github.com/ertfly/teste-redbelt.git
```

- Acesse a pasta do projeto
```
$ cd teste-redbelt
```

- Copie o arquivo "docker-compose.sample.yml" renomeando para "docker-compose.yml"
```
$ cp docker-compose.sample.yml docker-compose.yml
```

- Copie o arquivo "mongo-init.sample.js" renomeando para "mongo-init.js"
```
$ cp mongo-init.sample.js mongo-init.js
```

# NOTA
```
As arquivos copiados estão aplicados no .gitignore, e não causará efeitos de modificação
```

- Criei o network dos containers
```
$ docker network create teste-dev
```