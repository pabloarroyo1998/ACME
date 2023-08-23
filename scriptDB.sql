CREATE TABLE Usuarios (
	ID INT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
	Contrasena VARCHAR(80) NOT NULL
);

INSERT INTO Usuarios VALUES(
	123456,
	'CLIENTE PRUEBA',
	'prueba123'
);



CREATE TABLE PRODUCTOS(
	Codigo_producto INT PRIMARY KEY,
    Nombre VARCHAR(80) NOT NULL,
    Detalles VARCHAR(200) NOT NULL,
    Precio INT
);

INSERT INTO PRODUCTOS
VALUES(
	1,
    'Televisor SmartTV Samsung',
    '42", 4k, 2 puertos HDMI, HDR1O',
    1200000
);

INSERT INTO PRODUCTOS
VALUES(
	2,
    'Equipo de sonido Kalley',
    '2 parlantes con RGB',
    800000
);

INSERT INTO PRODUCTOS
VALUES(
	3,
    'Tira de luces RGB',
    'Cinta adesiva que se puede pegar sobre cualquier superficie y cuenta con luces led en todos los colores',
    90000
);



CREATE TABLE facturas(
	IDFactura AUTO_INCREMENT INT PRIMARY key,
    IDCliente INT NOT NULL,
    Fecha date NOT NULL
);

CREATE TABLE productosVendidos(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	IDFactura INT NOT NULL,
    IDProducto INT NOT NULL,
    NombreProducto VARCHAR(80) NOT NULL,
    PrecioProducto INT NOT NULL,
    CantidadProducto INT NOT NULL,
    Total INT NOT NULL,
    FOREIGN KEY (IDFactura) REFERENCES facturas(IDFactura)
);