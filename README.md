
# Adoorei teste backend 
### Passo a passo
Clone Repositório
```sh
git clone https://github.com/tsrocha/adoorei-teste-backend.git app-laravel
```
```sh
cd adoorei-teste-backend
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Adoorei Backend"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=adoorei
DB_USERNAME=adoorei
DB_PASSWORD=adoorei

```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acesse o container app
```sh
docker-compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```
Acesse API:
http://localhost:8989/api/{endpoint}

Acesso via postman:
https://www.postman.com/orange-moon-518919/workspace/adoorei-teste-backend/collection/3749222-8b929ea5-ee4b-48dc-9bb5-ef924517e612
