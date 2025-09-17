## Pré-requisitos

Antes de rodar o projeto, instale em sua máquina:

- [PHP 8.2+](https://www.php.net/downloads.php)  
- [Composer](https://getcomposer.org/download/)  
- [Node.js (LTS)](https://nodejs.org/en/)  
- [Git](https://git-scm.com/)  

---

## Instalação

1. Clonar o repositório  
   ```bash
   git clone https://github.com/xdanielcvmr/xbox-mini-hub.git
   cd xbox-mini-hub
   ```

2. Instalar dependências PHP  
   ```bash
   composer install
   ```

3. Instalar dependências front-end  
   ```bash
   npm install
   ```

4. Criar o arquivo de configuração  
   ```bash
   cp .env.example .env
   ```

5. Ajustar o .env para SQLite  
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

6. Criar o banco de dados  
   ```bash
   touch database/database.sqlite
   ```

7. Gerar a chave da aplicação  
   ```bash
   php artisan key:generate
   ```

8. Rodar as migrations + seeders  
   ```bash
   php artisan migrate --seed
   ```

9. Criar link simbólico para uploads (capas dos jogos)  
   ```bash
   php artisan storage:link
   ```

10. Subir o servidor Laravel  
    ```bash
    php artisan serve
    ```

11. Compilar os arquivos CSS e JS  
    ```bash
    npm run dev
    ```

---

## Usuários criados pelo seeder

- **Admin**  
  - Email: `admin@example.com`  
  - Senha: `admin123`  

- **Usuário comum**  
  - Email: `user@example.com`  
  - Senha: `senha123`