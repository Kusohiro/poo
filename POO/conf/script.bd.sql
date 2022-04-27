drop schema if exists POO;
create schema if not exists POO;
USE POO;


create table IF NOT EXISTS `POO`.`pessoa_fisica`(
	`pf_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pf_cpf` VARCHAR(45) DEFAULT NULL,
    `pf_nome` VARCHAR(250) DEFAULT NULL,
    `pf_dt_nascimento` VARCHAR(45) DEFAULT NULL,
    PRIMARY KEY (`pf_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table IF NOT EXISTS `POO`.`contatos`(
	`cont_id` INT(11) NOT NULL AUTO_INCREMENT,
    `cont_tipo` VARCHAR(45) DEFAULT NULL,
    `cont_descricao` VARCHAR(250) DEFAULT NULL,
    `cont_pf_id` INT(11) NOT NULL,
    PRIMARY KEY (`cont_id`),
    KEY `fk_pessoa_fisica_contatos_idx` (`cont_pf_id`),
	CONSTRAINT `fk_pessoa_fisica_contatos` FOREIGN KEY (`cont_pf_id`) 
	REFERENCES `pessoa_fisica` (`pf_id`) 
	ON DELETE NO ACTION 
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table IF NOT EXISTS `POO`.`conta_corrent`(
	`cc_numero` INT(11) NOT NULL AUTO_INCREMENT,
    `cc_saldo` dec(16,3) DEFAULT NULL,
    `cc_pf_id` INT(11) NOT NULL,
    `cc_dt_ultima_alteracao` DATE DEFAULT NULL,
    PRIMARY KEY (`cc_numero`),
    KEY `fk_pessoa_fisica_conta_corrent_idx` (`cc_pf_id`),
	CONSTRAINT `fk_pessoa_fisica_conta_corrent` FOREIGN KEY (`cc_pf_id`) 
	REFERENCES `pessoa_fisica` (`pf_id`) 
	ON DELETE NO ACTION 
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;