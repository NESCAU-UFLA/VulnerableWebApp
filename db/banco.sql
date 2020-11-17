CREATE SCHEMA IF NOT EXISTS Forum CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS Forum.Usuario(
	IdUsuario INT NOT NULL AUTO_INCREMENT,
    Login VARCHAR(15) NOT NULL,
    Nome VARCHAR(40) NOT NULL,
    Senha VARCHAR(40) NOT NULL,
    Foto VARCHAR(20) NOT NULL,
    PRIMARY KEY(IdUsuario),
    INDEX(Login)
);

CREATE TABLE IF NOT EXISTS Forum.Postagem(
	IdPostagem INT NOT NULL AUTO_INCREMENT,
    IdUsuario INT NOT NULL,
    Mensagem VARCHAR(300) NOT NULL,
    DataPostagem CHAR(16),
    UltimaEdicao VARCHAR(16),
    PRIMARY KEY(IdPostagem, IdUsuario),
    CONSTRAINT fk_id_usuario
		FOREIGN KEY(IdUsuario)
        REFERENCES Forum.Usuario(IdUsuario)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);