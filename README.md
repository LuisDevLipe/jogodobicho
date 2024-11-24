# Projeto segundo semestre ( backend  <?PHP)
![Apache](https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white)
![mysql](https://img.shields.io/badge/mysql-4479a1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![apache](https://img.shields.io/badge/mariadb-003545.svg?style=for-the-badge&logo=mariadb&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)

# Como executar localmente
Para executar localmente serão necessários alguns itens como pré-requisitos.

- apache2
- php8
- mysql server

*Nota:* Se você já tiver o [xampp](https://www.apachefriends.org/pt_br/index.html) instalado terá tudo nas mãos.

# Preparando o ambiente.
A aplicação utiliza hosts virtuais do apache. Você precisará configurá-las para isso.


## Windows
1. vá na pasta de instalação do xampp, normalmente fica em `c:/xampp/apache/conf/extra/`.
Abra o arquivo `httpd-vhosts.conf` com privilégios de administrador em um editor de texto.

Digite o seguinte código.
```
<VirtualHost *:80>
    DocumentRoot "c:/xampp/htdocs/jogodobicho/"
    ServerName jogodobicho.local
<Directory "c:/xampp/htdocs/jogodobicho">  # *Nota* esse caminho varia de acordo com o local do xampp.
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
</VirtualHost>
```

2. Vá na pasta `c:/Windows/System32/drivers/etc/` e abra o arquivo `hosts.txt` com privilégios de administrador.
Esse arquivo é responsável por fazer o reconhecimento do DNS local do computador.
Nesse arquivo escreva o seguinte código.

```
127.0.0.1   jogodobicho.local
```
3. Vá até a pasta htdocs do xampp e cole ou clone este repositório na raiz, depois de colar o caminho da raiz do repositório deverá ficar parecido como no exemplo. *ex:* `c:/xampp/htdocs/jogodobicho/`
4. Reinicie o servidor apache.
5. Acesse pelo navegador o endereço `jogodobicho.local/`

# Preparando o banco de dados

1. No diretório `connection/` utilize o arquivo `script_schema.sql` para criar e carregar o banco de dados, você pode fazer isso usando o seu sgbd. O banco de dados utilizado foi o mysql-server com o driver mariadb.

2. No arquivo `connection/config.php`, substitua o nome do usuario e senha usado na conexao para o do seu banco de dados.

# Quais requisitos foram cumpridos no projeto?

1. Telas do sistema 
![](https://img.shields.io/badge/completo-green?logo=cachet&logoColor=black)
    - Tela principal com descrição de algum produto. 
    - Tela para cadastro de usuario.
    - Tela de login.
    - Tela de mensagens derro (404, 500)
    - Tela com A2F.
    - Tela de Consulta de usuários.
    - Tela de alteração de senha.
    - Tela de LOG.
    - Tela com modelo DER utilizado no DB.

2. Lista de funcionalidades 
![](https://img.shields.io/badge/completo-green?logo=cachet&logoColor=black)
    - Menu com informações na tela principal.
    - Somente o usuário comum pode se cadastrar pelo sistema.
    - O usuário master é criado dentro do próprio banco de dados. Via SQL.
    - Tela de login com campos de login e senha.
    - Tela de login com link de cadastro de usuários.
    - O sistema deve verificar o nível do usuários (normal ou admin).
    - Após autenticado o login deve ser inforamdo no canto superior direito em todas as telas.
    - Tela de erro.
    - Segundo fator de autenticação.
    - Tela de consulta de usuários com filtro de busca por nome, somente o admin tem acesso.
    - Botão de exclusão na tela de consulta de usuário.
    - Somente o usuário comum poderá alterar sua senha.
    - Tela com DER.
    - Tela de logs de entrada de usuário com filto por cpf, nome e todos. Contendo as informações de nome, entrada, e qual fator de autenticação usado.
    - Toasts de comunicação de eventos com o usuário.


3. Desafio Extra
![](https://img.shields.io/badge/completo-green?logo=cachet&logoColor=black)
    - Botão para baixar a lista de usuários em formato de pdf.
    - Mecanismo de acessibilidade: troca de contraste, tema escuro e tema contraste.
    - Mecanismo de acessibilidade: Aumento e diminuição das fontes.

4. Demais requisistos
![](https://img.shields.io/badge/completo-green?logo=cachet&logoColor=black)

    - Responsividade
    - BD Mysql
    - Backend em PHP
    - Identidade visual clara


# Evidências.