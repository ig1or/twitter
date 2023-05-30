-- Exemplo tabela UM pra MUITOS

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

-- Exemplo tabela Associativa

CREATE TABLE IF NOT EXISTS `contato_hobbie`(
	`idContato` INT NOT NULL,
    `idHobbie` INT NOT NULL,
    PRIMARY KEY(`idContato`,`idHobbie`),
    constraint Contato_codigo_fk foreing key(idContato) REFERENCES contatos(id),
    constraint Hobbies_codigo_fk foreing key(idHobbie) REFERENCES hobbies(id)

);
