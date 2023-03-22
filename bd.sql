CREATE TABLE IF NOT EXISTS `contatos`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `sobrenome` VARCHAR(45) NOT NULL,
    `email` VARCHAR(110) NOT NULL,
    `observacoes` VARCHAR(110) NOT NULL,
    `telefone` INT NOT NULL,
    `dataNascimento` DATE NOT NULL,
    `idCidade` INT NOT NULL,
    `vivo` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `cep`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(55) NOT NULL,
    `estado` VARCHAR(55) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `contato_hobbie`(
	`idContato` INT NOT NULL,
    `idHobbie` INT NOT NULL,
    PRIMARY KEY(`idContato`,`idHobbie`),
    INDEX(idContato),CONSTRAINT contatos_id_fk FOREIGN KEY (idContato) REFERENCES contatos(id),
    INDEX(idHobbie),CONSTRAINT hobbies_id_fk FOREIGN KEY (idHobbie) REFERENCES hobbies(id)
);


CREATE TABLE IF NOT EXISTS `proposta`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `email` VARCHAR(110) NOT NULL,
    `observacoes` VARCHAR(110) NOT NULL,
    `salario` INT NOT NULL,
    PRIMARY KEY(`id`)
);