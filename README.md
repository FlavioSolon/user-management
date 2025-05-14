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
- `models/`: Modelos do banco de dados.
- `controllers/`: Lógica de negócio.
- `views/`: Interfaces de usuário.
- `config/`: Configurações do sistema.

## Autor
[Flávio Sólon]
