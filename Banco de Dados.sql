
DROP database if exists AGENDA;

CREATE DATABASE if not exists AGENDA;

 USE AGENDA;
 
 CREATE TABLE IF NOT EXISTS contato (
    id_contato INT NOT NULL PRIMARY key,
    nome VARCHAR(25),
    endereco varchar(25)
);
 CREATE TABLE IF NOT EXISTS telefone(
    id_telefone INT NOT NULL PRIMARY KEY,
    id_contato INT NOT NULL,
    telefone varchar(25),
        FOREIGN KEY (id_contato)
        REFERENCES Contato(id_contato)
        ON UPDATE CASCADE ON DELETE CASCADE

);
       

       
    






