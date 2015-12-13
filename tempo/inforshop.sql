CREATE DATABASE inforshop;

CREATE TABLE admin(
	id INT(4) PRIMARY KEY AUTO_INCREMENT,
	user VARCHAR(10),
	pass VARCHAR(10)
);

INSERT INTO admin 
VALUES ('1', 'admin', 'admin');

CREATE TABLE clientes(
	id_Cliente 		INT(4) PRIMARY KEY AUTO_INCREMENT,
	nomeCliente 	VARCHAR(50),
	moradaCliente 	VARCHAR(100),
	telefoneCliente INT(9),
	emailCliente 	VARCHAR(100),
	nifCliente 		VARCHAR(9)
);

CREATE TABLE func(
	id_Func 		INT(4) PRIMARY KEY AUTO_INCREMENT,
	nomeFunc 		VARCHAR(50),
	moradaFunc 		VARCHAR(100),
	telefoneFunc 	INT(9),
	emailFunc 		VARCHAR(50),
	nifFunc 		VARCHAR(9),
	dataNascFunc 	VARCHAR(10),
	dataEntradaServico 	VARCHAR(10)
);

CREATE TABLE marcas(
	id_Marca 	INT(4) PRIMARY KEY AUTO_INCREMENT,
	marca 		VARCHAR(50)
);

CREATE TABLE categorias(
	id_Categoria 	INT(4) PRIMARY KEY AUTO_INCREMENT,
	categoria 		VARCHAR(20)
);

CREATE TABLE subcategorias(
	id_Subcategoria INT(4) PRIMARY KEY AUTO_INCREMENT,
	subcategoria 	VARCHAR(20),
	id_Categoria 	INT(4),

	FOREIGN KEY (id_Categoria) REFERENCES categorias (id_Categoria)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE produtos(
	id_Produto 	INT(4) PRIMARY KEY AUTO_INCREMENT,
	nomeProduto VARCHAR(50),
	num_Serie 	VARCHAR(10),
	stock 		INT(4),
	precoProduto FLOAT(6),
	id_Subcategoria INT(4),
	id_Marca 	INT(4),

	FOREIGN KEY (id_Subcategoria) REFERENCES subcategorias (id_Subcategoria)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Marca) REFERENCES marcas (id_Marca)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE comprar(
	id_Compra INT(4) PRIMARY KEY AUTO_INCREMENT,
	id_Produto INT(4),
	id_Cliente INT(4),
	dataCompra VARCHAR(10),
	quantidade INT(5),
	precoTotal FLOAT(5),

	/*PRIMARY KEY (id_Produto, id_Cliente),*/
	FOREIGN KEY (id_Produto) REFERENCES produtos (id_Produto)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Cliente) REFERENCES clientes (id_Cliente)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE servicos(
	id_Servico 		INT(4) PRIMARY KEY AUTO_INCREMENT,
	tipoServico 	VARCHAR(50),
	precoServico 	FLOAT(5),
	tempoEstimadoServico VARCHAR(5)
);

CREATE TABLE assistencias(
	id_Assistencia 			INT(4) PRIMARY KEY AUTO_INCREMENT,
	descricaoAssistencia 	VARCHAR(200),
	descricaoEquipamento 	VARCHAR(200),
	dataEntrada 	VARCHAR(10),
	quantidade 		INT(10),
	valorTotal 		FLOAT(6),
	id_Cliente 		INT(4),
	id_Func 		INT(4),

	FOREIGN KEY (id_Cliente) REFERENCES clientes (id_Cliente)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Func) REFERENCES func (id_Func)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE efetuarServico(
	id_EfetuaServico INT(4) PRIMARY KEY AUTO_INCREMENT,
	id_Assistencia 	INT(4),
	id_Servico 		INT(4),
	id_Func 		INT(4),
	estado 			VARCHAR(5),

	FOREIGN KEY (id_Assistencia) REFERENCES assistencias (id_Assistencia)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Servico) REFERENCES servicos (id_Servico)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Func) REFERENCES func (id_Func)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);

CREATE TABLE instalarProduto(
	id_instalarProduto INT(4) PRIMARY KEY AUTO_INCREMENT,
	id_Produto INT(4),
	id_Assistencia INT(4),
	id_Servico INT(4),
	quantidadeProdutos INT(5),

	FOREIGN KEY (id_Produto) REFERENCES produtos (id_Produto)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Assistencia) REFERENCES assistencias (id_Assistencia)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	FOREIGN KEY (id_Servico) REFERENCES servicos (id_Servico)
	ON UPDATE CASCADE
	ON DELETE CASCADE
);


##################################################################

INSERT INTO clientes 
VALUES ("1", "Pedro Ribeiro", "Rua do Girassol", "912144525", "pedroRibeiro@gmail.com", "165445212");

INSERT INTO clientes 
VALUES ("2", "Vanda Miranda", "Rua das Garças", "965548485", "vmiranda@gmail.com", "175423522");

INSERT INTO clientes 
VALUES ("3", "Vasco Palmeirim", "Avenida de Ceuta", "911452368", "palmeirim2011@hotmail.com", "133547212");

INSERT INTO clientes 
VALUES ("4", "Nuno Markl", "Avenida 25 Abril", "935442145", "marklnuno@gmail.com", "122110123");

INSERT INTO clientes 
VALUES ("5", "Pedro Miranda", "Rua Pernas Longas", "912525445", "pedroMiranda@gmail.com", "123456789");

INSERT INTO clientes 
VALUES ("6", "Rita Ratatui", "Rua dos Poetas", "914152525", "rita_ratatui@outlook.com", "198765432");

INSERT INTO clientes 
VALUES ("7", "Diogo Martins", "Rua das Gaivotas", "912345678", "dmartins@gmail.com", "19874324");

INSERT INTO clientes 
VALUES ("8", "Patricia Bentes", "Avenida Lisboa", "919030971", "patriciabentes@hotmail.com", "144752532");

INSERT INTO clientes 
VALUES ("9", "Mariana Martins", "Avenida Lisboa", "911954433", "mmartins@gmail.com", "144752465");

INSERT INTO clientes 
VALUES ("10", "Filipe Pinto", "Rua dos Poetas", "964454544", "filipePinto@gmail.com", "121441236");

INSERT INTO clientes 
VALUES ("11", "Hugo Santos", "Rua Luis Camões", "913508356", "hsantos@gmail.com", "145544658");

#################################################################

INSERT INTO func
VALUES ("1", "Susana Estevão", "Rua das Gaivotas", "916929105", "a48584@ualg.pt", "144445444", "22/09/1994", "20/09/2014");

INSERT INTO func
VALUES ("2", "Valter António", "Rua de Faro", "969191933", "a50473@ualg.pt", "123545457", "", "20/09/2014");

INSERT INTO func
VALUES ("3", "Manuel Seromenho", "Rua de Quarteira", "960197420", "a21210@ualg.pt", "143231122", "", "20/09/2010");

#################################################################

INSERT INTO marcas
VALUES ("1", "HP");

INSERT INTO marcas
VALUES ("2", "ASUS");

INSERT INTO marcas
VALUES ("3", "ACER");

INSERT INTO marcas
VALUES ("4", "SAMSUNG");

INSERT INTO marcas
VALUES ("5", "EPSON");

INSERT INTO marcas
VALUES ("6", "SONY");

INSERT INTO marcas
VALUES ("7", "AMD");

INSERT INTO marcas
VALUES ("8", "LG");

INSERT INTO marcas
VALUES ("9", "INTEL");

INSERT INTO marcas
VALUES ("10", "MICROSOFT");

#################################################################

INSERT INTO categorias
VALUES ("1", "Acessórios");

INSERT INTO categorias
VALUES ("2", "Componentes");

INSERT INTO categorias
VALUES ("3", "Discos Rigidos");

INSERT INTO categorias
VALUES ("4", "Portáteis");

INSERT INTO categorias
VALUES ("5", "Impressora");

INSERT INTO categorias
VALUES ("6", "Periféricos");

INSERT INTO categorias
VALUES ("7", "Armazenamento");

INSERT INTO categorias
VALUES ("8", "Processadores");

INSERT INTO categorias
VALUES ("9", "Software");

INSERT INTO categorias
VALUES ("10", "Tablets");

#################################################################

INSERT INTO subcategorias
VALUES ("1", "Limpeza", "1");

INSERT INTO subcategorias
VALUES ("2", "Cabos", "1");

INSERT INTO subcategorias
VALUES ("3", "Tapetes Rato", "1");

INSERT INTO subcategorias
VALUES ("4", "Coolers", "1");

INSERT INTO subcategorias
VALUES ("5", "Caixas", "2");

INSERT INTO subcategorias
VALUES ("6", "Fonte Alimentação", "2");

INSERT INTO subcategorias
VALUES ("7", "Memorias RAM", "2");

INSERT INTO subcategorias
VALUES ("8", "Placa Gráfica", "2");

INSERT INTO subcategorias
VALUES ("9", "Placa Rede", "2");

INSERT INTO subcategorias
VALUES ("10", "Menos 80 GB", "3");

INSERT INTO subcategorias
VALUES ("11", "80GB - 500 GB", "3");

INSERT INTO subcategorias
VALUES ("12", "500 GB - 1 TB", "3");

INSERT INTO subcategorias
VALUES ("13", "Mais 1 TB", "3");

INSERT INTO subcategorias
VALUES ("14", "Cartões Memória", "7");

INSERT INTO subcategorias
VALUES ("15", "CD / DVD", "7");

INSERT INTO subcategorias
VALUES ("16", "Pen Drives", "7");

INSERT INTO subcategorias
VALUES ("17", "AMD Phenom", "8");

INSERT INTO subcategorias
VALUES ("18", "Intel Celeron", "8");

INSERT INTO subcategorias
VALUES ("19", "Intel Core", "8");

INSERT INTO subcategorias
VALUES ("20", "Intel Pentium", "8");

INSERT INTO subcategorias
VALUES ("21", "Intel Quad Core", "8");

INSERT INTO subcategorias
VALUES ("22", "Sistemas Operativos", "9");

INSERT INTO subcategorias
VALUES ("23", "Anti Virus", "9");

INSERT INTO subcategorias
VALUES ("24", "Adobe", "9");

INSERT INTO subcategorias
VALUES ("25", "Redes", "9");

INSERT INTO subcategorias
VALUES ("26", "Aprendizagem", "9");

INSERT INTO subcategorias
VALUES ("27", "Microsoft", "9");

#################################################################

INSERT INTO servicos
VALUES ("1", "Servidores", "50.99", "160");

INSERT INTO servicos
VALUES ("2", "Software Aplicacional", "59.99", "20");

INSERT INTO servicos
VALUES ("3", "Migração Dados", "20.59", "30");

INSERT INTO servicos
VALUES ("4", "Reconfiguração Equipamentos", "", "");

INSERT INTO servicos
VALUES ("5", "Manutenção e Reparação equipamentos", "", "");

INSERT INTO servicos
VALUES ("6", "Identificação e Resolução Problemas", "", "");

INSERT INTO servicos
VALUES ("7", "Recuperação de Dados", "", "");

#################################################################

INSERT INTO produtos
VALUES ("1", "Pen Sony 16 GB", "12154521", "3", "16.99", "16", "6");

################################################################

INSERT INTO assistencias
VALUES ("1", "Limpeza de Disco", "PC HP", "3/12/2015", "4", "25.99", "4","1");