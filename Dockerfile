# Use a imagem oficial do PHP como a imagem base
FROM php:7.4-apache

# Instale as dependências do PHP necessárias para a sua aplicação
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie os arquivos da sua aplicação para o diretório /var/www/html do contêiner
COPY . /var/www/html/

# Defina as variáveis de ambiente para a conexão com o banco de dados
ENV DB_HOST 127.0.0.1
ENV DB_USER user
ENV DB_PASS password
ENV DB_NAME Forum

# Defina a variável de ambiente USER_IMG_PATH
ENV USER_IMG_PATH /var/www/html/uploads/

# Atualize as configurações do Apache para habilitar o módulo de reescrita e configurar o diretório raiz
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Reinicie o Apache para que as mudanças tenham efeito
RUN service apache2 restart

# Exponha a porta 80 para que possa ser acessada de fora do contêiner
EXPOSE 80