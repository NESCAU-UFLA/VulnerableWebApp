# VulnerableWebApp
Este projeto tem por objetivo o desenvolvimento de uma aplicação web intencionalmente vulnerável.

## Aviso Legal
As vulnerabilidades e não conformidades aqui presentes foram propositalmente colocadas para fins educacionais apenas. Em hipótese alguma incentivamos o uso de tais más práticas.

## Sobre a aplicação
Trata-se de um fórum em que os usuários podem compartilhar mensagens entre si através de suas postagens.
<ul>
  <li>O usuário pode cadastrar, editar e excluir sua conta, além de cadastrar, editar e excluir suas próprias postagens.</li>
  <li>O administrador pode, além das funções já existentes de um usuário comum (com exceção de excluir sua conta), pode excluir as postagens dos demais usuários e suas contas.</li>
</ul>

## Vulnerabilidades e não conformidades intencionalmente colocadas
<ul>
  <li><i>Fraca política de senhas (ou falta dela);</i></li>
  <li>Tratamento de erro inapropriado;</li>
  <li><i>Brute-force Attack;</i></li>
  <li><i>XSS (Cross-Site Scripting)</i></li>
  <ul>
    <li><i>Reflected;</i></li>
    <li><i>Stored;</i></li>
  </ul>
  <li><i>SQL Injection</i></li>
  <ul>
    <li><i>In-band;</i></li>
    <li><i>Inferential;</i></li>
  </ul>
  <li><i>Unrestricted File Upload;</i></li>
  <li><i>File Inclusion</i></li>
  <ul>
    <li><i>LFI;</i></li>
    <li><i>RFI/</i></li>
  </ul>
  <li><i>Command Execution.</i></li>
</ul>
Lembrando que podem haver mais vulnerabilidades do que as descritas acima.