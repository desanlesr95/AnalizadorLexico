create database lexicos;
	use lexicos;
create table componentes(componente varchar(30) primary key,clase int,tipo text);

insert into componentes values("PROGRAMA",1,"Direccion Tabla Reservada");
insert into componentes values("VAR",1,"Direccion Tabla Reservada");
insert into componentes values("INCLUYE",1,"Direccion Tabla Reservada");
insert into componentes values("ENTERO",1,"Direccion Tabla Reservada");
insert into componentes values("REAL",1,"Direccion Tabla Reservada");
insert into componentes values("CARACTER",1,"Direccion Tabla Reservada");
insert into componentes values("SI",1,"Direccion Tabla Reservada");
insert into componentes values("ENTONCES",1,"Direccion Tabla Reservada");
insert into componentes values("SINO",1,"Direccion Tabla Reservada");
insert into componentes values("DESDE",1,"Direccion Tabla Reservada");
insert into componentes values("HASTA",1,"Direccion Tabla Reservada");
insert into componentes values("GUARDA",1,"Direccion Tabla Reservada");
insert into componentes values("LIBRERIA",1,"Direccion Tabla Reservada");
insert into componentes values("IMPRIME",1,"Direccion Tabla Reservada");
insert into componentes values("MUESTRA",1,"Direccion Tabla Reservada");
insert into componentes values("INTRODUCE",1,"Direccion Tabla Reservada");
insert into componentes values("TERMINA",1,"Direccion Tabla Reservada");
insert into componentes values("INICIA",1,"Direccion Tabla Reservada");
insert into componentes values("FUNCION",1,"Direccion Tabla Reservada");
insert into componentes values("PROCEDIMIENTO",1,"Direccion Tabla Reservada");
insert into componentes values("ARREGLO",1,"Direccion Tabla Reservada");
insert into componentes values("REGISTRO",1,"Direccion Tabla Reservada");
insert into componentes values("ENUMERADO",1,"Direccion Tabla Reservada");
insert into componentes values("CONSTANTES ENTERAS",3,"Direccion de la tabla de simbolos");
insert into componentes values("IDENTIFICADORES",2,"Direccion de la tabla de simbolos");
insert into componentes values("*",4,"1");
insert into componentes values("/",4,"2");
insert into componentes values("+",4,"3");
insert into componentes values("-",4,"4");
insert into componentes values("<",5,"1");
insert into componentes values("<=",5,"2");
insert into componentes values(">",5,"3");
insert into componentes values(">=",5,"4");
insert into componentes values("=",5,"5");
insert into componentes values("<>",5,"6");
insert into componentes values(",",6,"1");
insert into componentes values(";",6,"2");
insert into componentes values(".",6,"3");
insert into componentes values("==",6,"4");
insert into componentes values("\"",6,"5");
insert into componentes values("\'",6,"6");
insert into componentes values("^",7,"1");
insert into componentes values("->",7,"2");
insert into componentes values("{",8,"1");
insert into componentes values("}",8,"2");
insert into componentes values("[",8,"3");
insert into componentes values("]",8,"4");
insert into componentes values("(",8,"5");
insert into componentes values(")",8,"6");