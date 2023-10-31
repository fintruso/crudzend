## Visão Geral

O Projeto Testeweb é um aplicativo PHP que utiliza o PostgreSQL como banco de dados e é empacotado em um contêiner Docker. Ele fornece um ambiente de desenvolvimento para web com o PHP 7.4, Apache, e PostgreSQL.

## Configuração

Para configurar e executar o projeto, siga as etapas abaixo:

### Pré-requisitos

- Docker: Certifique-se de ter o Docker instalado na sua máquina. Se você não o tiver instalado, faça o download em [https://www.docker.com/](https://www.docker.com/).

### Clone o Repositório

```bash
git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto

### Construa a Imagem Docker

```bash
docker build -t testeweb .
