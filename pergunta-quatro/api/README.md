#### Instalação - Pergunta Quarto
``` bash
# Ir para pastas da aplicação
cd ./pergunta-quatro/api

# Instalar dependências
composer install

# Configurar banco de dados no arquivo .env seguindo o .env.example
# ./pergunta-quatro/api/.env

# Popular banco de dados
php dbseed.php

# Serv inicia em 127.0.0.1:8000
php -S 127.0.0.1:8000 -t public
```