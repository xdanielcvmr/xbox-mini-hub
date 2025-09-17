Pré-requisitos

Antes de rodar o projeto, instale em sua máquina:

- PHP 8.2+: (https://www.php.net/downloads.php)  
- Composer: (https://getcomposer.org/download/)  
- Node.js (LTS): (https://nodejs.org/en/)
- Git: (https://git-scm.com/)  


Instalação


- 1. Clonar o repositório
git clone https://github.com/xdanielcvmr/xbox-mini-hub.git
cd xbox-mini-hub

- 2. Instalar dependências PHP
composer install

- 3. Instalar dependências front-end
npm install

- 4. Criar o arquivo de configuração
cp .env.example .env

- 5. Ajustar o .env para SQLite
- Edite as linhas:
- DB_CONNECTION=sqlite
- DB_DATABASE=database/database.sqlite

- 6. Criar o banco de dados
touch database/database.sqlite

- 7. Gerar a chave da aplicação
php artisan key:generate

- 8. Rodar as migrations + seeders
php artisan migrate --seed

- 9. Criar link simbólico para uploads (capas dos jogos)
php artisan storage:link

- 10. Subir o servidor Laravel
php artisan serve

- 11. Execute para compilar os arquivos CSS e JS
npm run dev

Usuários criados pelo seeder

- Admin
  - Email: admin@example.com
  - Senha: admin123

- Usuário comum
  - Email: user@example.com
  - Senha: senha123