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
Instalar dependências PHP

bash
Copiar código
composer install
Instalar dependências front-end

bash
Copiar código
npm install
Criar o arquivo de configuração

bash
Copiar código
cp .env.example .env
Ajustar o .env para SQLite

env
Copiar código
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
Criar o banco de dados

bash
Copiar código
touch database/database.sqlite
Gerar a chave da aplicação

bash
Copiar código
php artisan key:generate
Rodar as migrations + seeders

bash
Copiar código
php artisan migrate --seed
Criar link simbólico para uploads (capas dos jogos)

bash
Copiar código
php artisan storage:link
Subir o servidor Laravel

bash
Copiar código
php artisan serve
Compilar os arquivos CSS e JS

bash
Copiar código
npm run dev
Usuários criados pelo seeder
Admin

Email: admin@example.com

Senha: admin123

Usuário comum

Email: user@example.com

Senha: senha123