# ZPT Commerce API

Este projeto é parte do conjunto de projetos ZPT Commerce que engloba outros 2 projetos: [ZPT Commerce Admin](https://github.com/rafaelfgomes/zptcommerce-admin) e [ZPT Commerce Site](https://github.com/rafaelfgomes/zptcommerce-site)

## 💻 Pré-requisitos

Antes de começar, é necessário ter os seguintes pré-requisitos instalados no seu computador:

* Docker ([Tutorial de instalação](https://www.docker.com/get-started))

* Postman (Para testes dos endpoints da api) --&gt; [Download](https://www.postman.com/downloads/)

## 🚀 Instalando o projeto

Para instalar e rodar o projeto na sua máquina local, basta executar os seguintes passos:

----------

* ### Modo automatizado (Linux e MacOS)

  * Há um script bash na raiz do projeto chamado 'init.sh', nele é possível setar as credenciais de banco de dados que deseja nas variáveis 'mysqlRootPassword', 'mysqlDatabase', 'mysqlUser', 'mysqlUserPassword'.
  * Após isso, basta executar com o comando: `./init.sh` na raiz do projeto
  
  > OBS: Este é um passo obrigatório, pois se as variáveis não estiverem definidas, o container não é instalado e executado.
  > Esse script se encarregará de criar uma rede para todos os containers e criar e setar as variáveis no arquivo .env

----------

* ### Modo manual (Todas as plataformas)

  * Execute o comando: `docker network create --driver=bridge --subnet=172.25.0.0/16 --gateway=172.25.0.1 zpt-network`

  * Faça uma cópia do arquivo 'env.sample' e renomeie para '.env'

  * Insira as credenciais do banco de dados

----------

Após a execução do modo (manual ou automático), execute o seguinte comando:

```bash
docker-compose up -d
```

Se tudo ocorrer bem, seu peojeto já estará rodando e para acessá-lo basta colocar o ip do container (172.25.0.3) ou a url (0.0.0.0:8085) no seu navegador.

## Banco de dados

O banco de dados da aplicação pode ser acessado através de qualquer programa gerenciador de SGBD (MySQL Workbench, DBeaver) pelo endereço '172.25.0.10:3306' ou '0.0.0.0:33060'

* ### Criando o banco de dados da aplicação

    Para criar o banco inicial da aplicação, execute o seguintes comandos:

    ```bash
    docker exec -it zpt-php sh -c "php artisan migrate"
    ```

    ```bash
    docker exec -it zpt-php sh -c "php artisan db:seed"
    ```
  
    Após a execução do comando as tabelas e alguns dados já estão salvos no banco.

## Postman collection

Na raiz deste projeto há um arquivo json de [Coleção do Postman](ZPT_Digital_Postman_Endpoints.json) onde estão todos os endpoints. Para importar o arquivo no Postman, basta ir em "File > Import" e buscar o arquivo na pasta.

## 📝 Licença

Esse projeto está sob licença MIT. Veja o arquivo [LICENÇA](LICENSE.md) para mais detalhes.

[⬆ Voltar ao topo](#zpt-commerce-api)<br>