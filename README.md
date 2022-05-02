# Projeto WDEV

Decidi recriar o [projeto WDEV](https://www.youtube.com/watch?v=TmeyoTNu748&list=PL_zkXQGHYosGQwNkMMdhRZgm4GjspTnXs) no Laravel

# Instalação

### Requisitos

* Composer
* Node

Clone este repositório
```
git clone https://github.com/robott11/wdev-project.git
```

Dentro do repositório, instale as dependencias com ``composer install`` e ``npm install``

Compile os assets com ``npm run dev``

Então copie o arquivo ***.env.example*** e o renomeie para ***.env*** e configure o seu banco de dados nele
```
cp .env.example .env
```

Gere a chave do Laravel e rode as migrations
```
php artisan key:generate

php artisan migrate
```

Por fim, abra o server e popule o banco com dados
```
php artisan db:seed

php artisan serve
```

O login de admin é gerado aleatóriamente e pode ser encontrado no shell interativo do Laravel ``php artisan tinker``
e executando o método ``Admin::all()``

A senha sempre será ``password``
