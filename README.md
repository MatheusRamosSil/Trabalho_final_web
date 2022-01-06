# Adicionando configurações no projeto
> :warning: ***O projeto utiliza Docker para rodar suas aplicações, então você precisa ter o Docker intalado na sua maquina***

> :warning: ***Se você utiliza o Windows será nescessario instalar o WSL, bem como uma distribuição Linux*** 

## Passo 1:
   Primeiro clone o projeto.
   Após ter feito o clone abra o terminal do projeto ( no caso do Windows você tem que abrir o projeto no terminal do WSL), e execute o seguinte comando:
   
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
    
Esse comando é necessario para carregar todas as dependencias do projeto no conteiner

## Passo 2:
 Agora copie o conteudo do arquivo `env.example` e crie um arquivo de nome `.env` na raiz do projeto
 Na parte de conexão do banco de dados mude o `DB_HOST=127.0.0.1` para `DB_HOST=mysql_db`. Outro ponto imporatante, NÃO COLOQUE O NOME do `DB_USERNAME=root` pois dará conflito com o usuario root do MySql, mude o root para qualquer outro nome. Na parte de `DB_DATABASE` coloque o nome do banco de dados que você quer, como por exemplo `DB_DATABASE=meu_bd`.
 
 ## Passo 3:
 No terminal do projeto ( para Windows o terminal do WSL) execute:
 
    ./vendor/bin/sail down --rmi all -v
    
 Apó execute:
 
    ./vendor/bin/sail up
    
 ## Passo 4
 Agora já é possivel ter os conteiners criados e rodando em sua respectiavas portas. Porém ainda é necessario fazer o migrations.
 No terminal do projeto (WSL para Windows) , rode:
 
    ./vendor/bin/sail artisan migrate
 Caso o projeto solicite gerar um key, execute :
 
    ./vendor/bin/sail artisan key:generate

## Tudo pronto ...
⚠️ Caso tenha algum outro aplicativo ou conteiner rodando na sua maquina local, desligue, para não ocorrer conflito com as portas em seu localhost

⚠️ A senha e o usuario do PhpMyAdmin é a mesma que foi definida no arquivo `.env`

⚠️ Em caso de sugir a mensagem ` Failed to open stream: Permission denied`. Adicione o seguinte codigo na`.env`
    
    WWWGROUP=1000
    WWWUSER=1000

Agora acesse as portas dos conteiners:

    http://localhost:8081/  (Php My Admin)
    http://localhost/       (App)
    
