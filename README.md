
# ![Logo](public/assets/images/logo.png)

Este é um projeto Laravel chamado **Notes**, onde os usuários podem criar, ler, atualizar e excluir notas (CRUD). O sistema utiliza o MySQL como banco de dados para armazenar as informações das notas.

## Tecnologias Utilizadas

- [Laravel](https://laravel.com/) - Framework PHP
- [MySQL](https://www.mysql.com/) - Banco de Dados Relacional

## Funcionalidades

- **Criar Notas**: Permite que o usuário crie novas notas.
- **Ler Notas**: Exibe uma lista de todas as notas e detalhes específicos de cada nota.
- **Atualizar Notas**: O usuário pode editar o conteúdo de uma nota existente.
- **Excluir Notas**: O usuário pode deletar uma nota.

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/jprogram-php-projects/notes.git
   cd notes

2. Instale as dependências do projeto:

    ```bash
    composer install

3. Configure o arquivo .env:

- Renomeie o arquivo .env.example para .env.

- Configure as informações do banco de dados MySQL:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_notes
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

4. Gere a chave da aplicação:

   ```bash
   php artisan key:generate
   ```

5. Execute as migrações do banco de dados:

   ```bash
   php artisan migrate
   ```

6. Uso:
   Para iniciar o servidor de desenvolvimento, execute:

   ```bash
   php artisan serve
   ```

   Acesse o sistema no navegador em [http://localhost:8000](http://localhost:8000).

