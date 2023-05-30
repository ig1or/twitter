CREATE TABLE atleta(
    codigo INT NOT NULL UNIQUE AUTO_INCREMENT,
    nome VARCHAR(100),
    peso DECIMAL(8,2),
    altura DECIMAL(8,2),
    PRIMARY KEY (codigo)
);

INSERT INTO atleta (nome, peso, altura) VALUES 
('José', 78.5, 1.73),
('Maria', 56.5, 1.65),
('Anita', 55.6, 1.34),
('Michael', 89.5, 1.81),
('Tereza', 67.3, 1.59),
('Jorge', 100.4, 1.95);

CREATE TABLE IF NOT EXISTS `tipoUsuario` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`)
);

INSERT INTO `tipoUsuario`
(`descricao`)
VALUES
('admin'),
('user'),
('user-especial'),
('user-consulta');


CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `user` VARCHAR(45) NULL,
  `pass` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `tipoUsuario_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_usuario_tipoUsuario_idx` (`tipoUsuario_codigo` ASC),
  CONSTRAINT `fk_usuario_tipoUsuario`
    FOREIGN KEY (`tipoUsuario_codigo`)
    REFERENCES `tipoUsuario` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO `usuario`
(`nome`,`user`,`pass`,`email`,`tipoUsuario_codigo`)
VALUES
('Administrador','admin','admin','admin@admin.com',1),
('Rodrigo Curvêllo','rodrigo','rorigo','rodrigo@curvello.com',2),
('Maria','maria','maria','maria@maria.com.br',3),
('José','jose','jose','jose@jose.com.br',4);