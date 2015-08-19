CREATE TABLE categoria(
	id int(15) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	titulo varchar(150),
	padre int(15),
	estatus int(1)
);
ALTER TABLE categoria ADD CONSTRAINT categoria_padre FOREIGN KEY(padre) REFERENCES categoria(id);