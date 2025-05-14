# Sistema de Gerenciamento de Usuários

## Descrição
Sistema CRUD para gerenciamento de usuários, desenvolvido com Yii2 e PostgreSsql, conforme especificações fornecidas.

## Requisitos
- PHP 7.4+
- MariaDB
- Composer
- Yii2

## Instalação
1. Clone o repositório: `git clone <url>`
2. Instale dependências: `composer install`
3. Configure o banco de dados em `config/db.php`.
4. Execute as migrations: `php yii migrate`
5. Acesse a aplicação em `http://localhost/user-management/web`.

Admin: admin@example.com
Senha: 123456

## Funcionalidades
- **Login**: Autenticação com email e senha.
- **Home**: Tela de apresentação.
- **Lista de Usuários**: Pesquisa por nome e paginação.
- **Cadastro/Edição**: Validações de nome, email, matrícula e senha.
- **Permissões**: Admin pode criar/edit   atualizar e excluir; usuário apenas visualiza.

## Estrutura do Projeto
user-management/
├── assets/                     # Arquivos estáticos (CSS, JS, imagens)
│   ├── css/
│   │   ├── sidebar.css        # Estilos personalizados da barra lateral
│   ├── js/
│   │   ├── sidebar.js         # Scripts para toggle da barra
│   ├── images/
│   │   ├── logo.png           # Logo da aplicação
├── config/                     # Configurações
│   ├── web.php                # Configuração da aplicação web
│   ├── db.php                 # Configuração do banco PostgreSQL
│   ├── params.php             # Parâmetros globais
├── controllers/                # Controladores
│   ├── AuthController.php     # Gerencia login/logout
│   ├── SiteController.php     # Páginas estáticas (home, erro)
│   ├── UserController.php     # CRUD de usuários
├── models/                     # Modelos
│   ├── LoginForm.php          # Formulário de login
│   ├── User.php               # Modelo ActiveRecord para usuários
│   ├── UserSearch.php         # Modelo de busca para GridView
├── services/                   # Lógica de negócios
│   ├── LoggingUserServiceDecorator.php # Adiciona logs
│   ├── UserService.php        # Operações de usuários
├── repositories/               # Acesso a dados
│   ├── DbUserRepository.php   # Implementação do repositório
│   ├── UserRepositoryInterface.php # Interface do repositório
├── validators/                 # Validações
│   ├── EmailValidator.php     # Valida emails
│   ├── FieldValidatorInterface.php # Interface de validadores
│   ├── NameValidator.php      # Valida nomes
│   ├── RegistrationNumberValidator.php # Valida matrículas
├── factories/                  # Fábricas
│   ├── ValidatorFactory.php   # Cria validadores
├── strategies/                 # Permissões
│   ├── AdminPermissionStrategy.php # Permissões de admin
│   ├── PermissionStrategyInterface.php # Interface de permissões
│   ├── UserPermissionStrategy.php # Permissões de usuário
├── migrations/                 # Migrações do banco
│   ├── m250514_122653_create_users_table.php # Cria tabela users
├── views/                      # Interfaces
│   ├── auth/
│   │   ├── login.php          # Formulário de login
│   ├── layouts/
│   │   ├── main.php           # Layout com barra lateral
│   ├── site/
│   │   ├── error.php          # Página de erro
│   │   ├── index.php          # Página inicial
│   ├── user/
│   │   ├── _form.php          # Formulário reutilizável
│   │   ├── create.php         # Cria usuário
│   │   ├── index.php          # Lista usuários
├   │   ├── update.php         # Edita usuário
│   │   ├── view.php           # Detalhes do usuário
├── web/                        # Ponto de entrada
│   ├── index.php              # Arquivo principal
├── composer.json               # Dependências
├── README.md                   # Documentação

## Autor
[Flávio Sólon]
