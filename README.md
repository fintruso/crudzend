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
docker-compose build
docker-compose up
```

### Uso
Após a configuração, o aplicativo estará disponível em http://localhost:8080. Você pode acessar a aplicação a partir do seu navegador web.

Dockerfile
O Dockerfile usado para criar o contêiner Docker contém as seguintes etapas:

- Usa uma imagem base do PHP 7.4 com o Apache.
- Atualiza e instala as dependências do PostgreSQL.
- Copia os arquivos do Zend Framework 2 para o contêiner.
- Instala as extensões do PHP.
- Ativa o módulo rewrite do Apache.
- Instala o Composer 1.
- Expõe a porta 80.
- Inicia o Apache.

### O Projeto de teste

- após iniciar o docker estara disponivel em http://localhost:8080/trafegus/public/
```
