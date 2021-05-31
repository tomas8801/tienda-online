CREATE DATABASE tienda_equilibre;
USE tienda_equilibre;

CREATE TABLE usuarios (
id      int(255) auto_increment not null,
nombre  varchar(100) not null,
apellido    varchar(255),
email   varchar(255) not null,
password    varchar(255) not null, 
rol varchar(20),
image   varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(null, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);

CREATE TABLE categorias (
id      int(255) auto_increment not null,
nombre  varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categorias VALUES(null, 'Pulsera');
INSERT INTO categorias VALUES(null, 'Collar');
INSERT INTO categorias VALUES(null, 'Bikini');
INSERT INTO categorias VALUES(null, 'Gorra');

CREATE TABLE productos (
id      int(255) auto_increment not null,
categoria_id int(255) not null,
nombre  varchar(100) not null,
descripcion text,
precio float(100, 2) not null,
stock int(255) not null,
oferta varchar(2),
fecha date not null,
image varchar(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


CREATE TABLE pedidos (
id      int(255) auto_increment not null,
usuario_id int(255) not null,
producto_id  int(255) not null,
unidades    int(255) not null,
provincia  varchar(100) not null,
localidad varchar(100) not null,
direccion varchar(255) not null,
cod_postal varchar(20) not null,
telefono varchar(30) not null,
estado varchar(20) not null,
fecha date not null,
hora time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
CONSTRAINT fk_pedido_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;


CREATE TABLE transacciones (
id int(255) auto_increment not null,
pago_id      int(255) not null,
pedido_id int(255) not null,
monto float(100, 2) not null,
tipo_pago varchar(100) not null,
estado varchar(10) not null,
fecha TIMESTAMP not null,
CONSTRAINT pk_transacciones PRIMARY KEY(id),
CONSTRAINT fk_transaccion_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id)
)ENGINE=InnoDb;
