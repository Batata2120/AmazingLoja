create database amazing;
use amazing;

create table usuario(
    id int auto_increment,
    nome varchar(120) not null,
    nome_usuario varchar(20) not null,
    
    estado char(2) not null,
    cidade varchar(20) not null,
    bairro varchar(20) not null,
    rua varchar(20) not null,
    
    nro_cartao int not null,
    nro_seguranca int not null,
    nome_cartao int not null,
    data_validade_cartao date not null,
    
    primary key(id)
);

create table compra(
    id int auto_increment,
    idUsuario int,
    dataCompra datetime not null,
    foreign key(idUsuario) references usuario(id),
    primary key(id)
);

create table produto(
    id int auto_increment,
    nome varchar(20) not null,
    qtdEstoque int not null,
    preco double not null,
    descricao text,
    primary key(id)
);

create table produtos_compra(
    id int auto_increment,
    idCompra int,
    idProduto int,
    qtdProduto int not null,
    foreign key(idCompra) references compra(id),
    foreign key(idProduto) references produto(id),
    primary key(id)
);