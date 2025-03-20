# Aplicação Web Integrada a Banco de Dados MySQL

Este repositório contém uma aplicação web simples que se integra a um banco de dados. A aplicação permite a criação e listagem de registros em duas tabelas: `EMPLOYEES` (funcionários) e `PROJECTS` (projetos).

## Funcionalidades

1. **Criação de Tabelas**:
   - A aplicação verifica se as tabelas `EMPLOYEES` e `PROJECTS` existem no banco de dados. Caso não existam, elas são criadas automaticamente.
   - A tabela `EMPLOYEES` contém campos para `ID`, `NAME` e `ADDRESS`.
   - A tabela `PROJECTS` contém campos para `ID`, `PROJECT_NAME`, `PROJECT_DESCRIPTION`, `PROJECT_START_DATE`, `PROJECT_END_DATE` e `PROJECT_STATUS`.

2. **Adição de Registros**:
   - A aplicação possui formulários para adicionar novos registros às tabelas `EMPLOYEES` e `PROJECTS`.
   - Os dados inseridos são validados e armazenados no banco de dados.

3. **Listagem de Registros**:
   - Após a inserção, os registros são exibidos em tabelas HTML na página principal.

4. **Integração com Banco de Dados**:
   - A aplicação utiliza PHP para se conectar ao banco de dados MySQL e executar operações de CRUD (Create, Read, Update, Delete).

## Estrutura do Projeto

- **`project.php`**: Arquivo principal que contém o código PHP e HTML para a aplicação web.
- **`dbinfo.inc`**: Arquivo de configuração que contém as credenciais de acesso ao banco de dados (servidor, usuário, senha e nome do banco de dados).
- **`README.md`**: Este arquivo, que descreve o conteúdo e funcionalidades do repositório.

## Como Executar o Projeto

1. **Pré-requisitos**:
   - Servidor web (Apache, Nginx, etc.) com suporte a PHP.
   - Banco de dados MySQL.
   - PHP instalado e configurado.

2. **Configuração**:
   - Crie um banco de dados MySQL e atualize as credenciais no arquivo `inc/dbinfo.inc`.
   - Coloque os arquivos do projeto na pasta raiz do servidor web.

3. **Execução**:
   - Acesse a aplicação através do navegador (ex: `http://localhost/index.php`).
   - Use os formulários para adicionar e listar registros.

## Exemplo de Uso

### Adicionar um Funcionário
1. Preencha o formulário de `EMPLOYEES` com o nome e endereço do funcionário.
2. Clique em "Add Employee" para salvar o registro.

### Adicionar um Projeto
1. Preencha o formulário de `PROJECTS` com o nome, descrição, datas de início e término, e status do projeto.
2. Clique em "Add Project" para salvar o registro.

### <a href="https://youtu.be/C3ynktTsmbk">Link da demonstração da aplicação</a>


