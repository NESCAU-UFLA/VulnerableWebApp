# VulnerableWebApp
Este projeto tem por objetivo o desenvolvimento de uma aplicação web intencionalmente vulnerável.

## Sumário
* <a href="#aviso-legal">Aviso Legal</a>;
* <a href="#primeiros-passos">Primeiros passos</a>
  * <a href="#pré-requisitos">Pré-requisitos</a>;
  * <a href="#arquivos-configurações-e-permissões">Arquivos, configurações e permissões</a>;
* <a href="#sobre-a-aplicação">Sobre a Aplicação</a>
  * <a href="#vulnerabilidades-e-não-conformidades-intencionalmente-colocadas">Vulnerabilidades e não conformidades intencionalmente colocadas</a>;
* <a href="#tecnologias-utilizadas">Tecnologias Utilizadas</a>;
* <a href="#regras-de-diretórios">Regras de Diretórios</a>;
* <a href="#diretórios">Diretórios</a>;
* <a href="#autores">Autores</a>.

## Aviso Legal
As vulnerabilidades e não conformidades aqui presentes foram propositalmente colocadas para fins educacionais apenas. Em hipótese alguma incentivamos o uso de tais más práticas.

## Primeiros passos
Antes de por a mão na massa, devemos ficar atentos a algumas questões para que a aplicação funcione corretamente. Serão descritos a seguir os **pré-requisitos** para a base do seu funcionamento e, não menos importante, também algumas instruções sobre **arquivos e configurações**.

### Pré-requisitos
* Certifique-se de ter ambos servidores Apache e MySQL instalados e configurados. Confira <a href="#tecnologias-utilizadas">Tecnologias Utilizadas</a> para mais detalhes.
* Instale a extensão MySQLi para o PHP;

### Arquivos, configurações e permissões
* O *sql script* para instanciar o *schema* da aplicação no banco de dados pode ser encontrado no diretório `db` com o nome `banco.sql`.
* O arquivo de configuração para a conexão com o banco pode ser encontrado no diretório `src/persistence` com o nome `dbconfig.php`. Altere-o de modo que tenha as mesmas credenciais de acesso ao seu banco.
* Dê permissão de escrita ao diretório `src/uploads` no servidor da aplicação, para que os arquivos possam ser transferidos ao diretório durante o processo de *upload*.
* No seu arquivo de configuração `php.ini` (Acesse <a href="https://www.php.net/manual/pt_BR/function.php-ini-loaded-file.php">essa página</a> em caso de dúvida para localizá-lo) verá que a configuração `allow_url_include` está em `Off`. Altere-a para `On` de modo que possa abrir arquivos de fora do sistema. Deixe assim: `allow_url_include = On`. Tal configuração deve ser manipulada para realizar testes de *RFI*.
* No arquivo `usuario.php` dentro do diretório `src/controller` certifique-se que o atributo `USER_IMG_PATH` aponta para o diretório `src/uploads` no servidor da aplicação.

## Sobre a Aplicação
Trata-se de um fórum em que os usuários podem compartilhar mensagens entre si através de suas postagens.
* O usuário pode cadastrar, editar e excluir sua conta, além de cadastrar, editar e excluir suas próprias postagens.
* O administrador pode, além das funções já existentes de um usuário comum (com exceção de excluir sua conta), pode excluir as postagens dos demais usuários e suas contas.

**Nota**: O primeiro usuário a ser registrado no sistema será o administrador.

### Vulnerabilidades e não conformidades intencionalmente colocadas
* Falta de uma política de senhas;
* Tratamento de erro inapropriado;
* Falta de proteção a ataques de força bruta;
* Informações sensíveis são salvas "em claro" no banco de dados, ou seja, sem o uso de criptografia;
* *XSS (Cross-Site Scripting)*
  * *Reflected;*
  * *Stored;*
* *SQL Injection*
  * *In-band;*
  * *Inferential;*
* *Unrestricted File Upload;*
* *File Inclusion*
  * *LFI;*
  * *RFI;*
* *Command Execution;*
* *CSRF (Cross-Site Request Forgery).*

Lembrando que podem haver mais vulnerabilidades do que as listadas acima.

## Tecnologias Utilizadas
* HTML5 e CSS3
* JavaScript e jQuery versão 3.5.2
* PHP versão 7.2.24
* Apache versão 2.4.29
* MySQL versão 5.7.27

## Regras de Diretórios
* Diretórios de desenvolvimento devem estar no modelo MVC.
* Arquivos extras do front-end devem ficar no diretório `src/modules`.
* A documentação deve ficar no diretório `docs`.

## Diretórios
```sh
|-- db
|-- docs
|-- src
    |-- controller
    |-- model
    |-- modules
    |-- persistence
    |-- uploads
    |-- view
```

## Autores
* <b>Vitor Oriel</b> - <a target="_blank" href="https://github.com/VitorOriel">Perfil</a>
