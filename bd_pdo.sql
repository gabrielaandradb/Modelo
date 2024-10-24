drop database auraPrateada;
CREATE SCHEMA IF NOT EXISTS auraPrateada DEFAULT CHARACTER SET utf8;
USE auraPrateada;

CREATE TABLE IF NOT EXISTS cadastro (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(10)NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE
) ENGINE = InnoDB;

INSERT INTO cadastro VALUES 
(null, 'Ana Clara Silva', 'anasilv@email.com', '12345', '61 99876-5665', '12345678901'),
(null, 'João Pedro Souza', 'joaosouza@email.com', '78545', '61 99876-1234', '98765432109');
SELECT*FROM cadastro;

CREATE TABLE IF NOT EXISTS login (
    email VARCHAR(255) NOT NULL PRIMARY KEY,
    senha VARCHAR(10) NOT NULL,
    id_usuario INT AUTO_INCREMENT,
    FOREIGN KEY (id_usuario) references cadastro(id_usuario)
) ENGINE = InnoDB;

INSERT INTO login VALUES 
('anasilv@email.com', '12345', 1),
('joaosouza@email.com', '78545', 2);
SELECT*FROM login;

CREATE TABLE IF NOT EXISTS endereco (
	id_endereco	INT PRIMARY KEY,	
	id_usuario	INT,	
	cep	VARCHAR(10),
	rua	VARCHAR(255),	
	numero VARCHAR(10),	
	complemento	VARCHAR(50),	
	bairro VARCHAR(100),	
	cidade VARCHAR(100),	
	estado VARCHAR(50),	
	FOREIGN KEY (id_usuario)references cadastro(id_usuario)
) ENGINE = InnoDB;

INSERT INTO endereco VALUES 
(1, 1, '12345-678', 'Rua A', '100', 'Casa 101', 'Bairro A', 'Ceilandia', 'DF'),
(2, 2, '98765-432', 'Rua B', '200', 'Casa 201', 'Bairro B', 'Taguatinga', 'DF');
SELECT*FROM endereco;

CREATE TABLE IF NOT EXISTS categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

INSERT INTO categoria VALUES 
(null, 'Anéis'),
(null, 'Pulseiras'),
(null, 'Colares'),
(null, 'Correntes'),
(null, 'Brincos'),
(null, 'Tornozeleiras'),
(null, 'Braceletes');
SELECT*FROM categoria;

CREATE TABLE IF NOT EXISTS produto (
    id_produto INT NOT NULL PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT,
    preco DECIMAL(10,2),
    quantidade INT NOT NULL,
    imagem_url VARCHAR(255),
    categoria VARCHAR(50)
) ENGINE = InnoDB;

INSERT INTO produto VALUES
(001, 'Anel com Pedra Verde', 'Anel com pedra Verde central.', 90.50, 20, null, 'Anéis'),
(002, 'Pulseira com Pingentes', 'Pulseira com pequenos pingentes de coração.', 75.00, 10, null, 'Pulseiras'),
(003, 'Colar com Pingente de Lua', 'Colar com pingente de lua crescente.', 100.75, 15, null, 'Colares'),
(004, 'Corrente Prata', 'Corrente prata 925 masculina', 99.99, 30, null, 'Corrente'),
(005, 'Brinco com Pérola', 'Brinco com pérola natural.', 55.00, 15, null, 'Brincos'),
(006, 'Tornozeleira com Estrela', 'Tornozeleira com detalhe de estrela.', 40.00, 12, null, 'Tornozeleiras'),
(007, 'Bracelete de prata 925', 'Bracelete com desing moderno', 30.50, 15, null, 'Braceletes');
SELECT*FROM produto;


CREATE TABLE IF NOT EXISTS carrinho (
    id_carrinho INT NOT NULL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT, 
    FOREIGN KEY (id_usuario) references cadastro(id_usuario),
    FOREIGN KEY (id_produto) references produto(id_produto)
) ENGINE = InnoDB;

INSERT INTO carrinho VALUES 
(1, 1, 1, 2),
(2, 2, 2, 1);
SELECT*FROM carrinho;

CREATE TABLE IF NOT EXISTS pedido (
    id_pedido INT NOT NULL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_produto INT NOT NULL,
    quatidade INT NOT NULL,
    preco_unitario DECIMAL(10,2),
	estatus VARCHAR(50),
    total DECIMAL(10,2),
    FOREIGN KEY (id_usuario) references cadastro(id_usuario),
    FOREIGN KEY (id_produto) references produto(id_produto)
) ENGINE = InnoDB;

INSERT INTO pedido VALUES 
(1, 1, 1, 2, 90.50, 'Processando', 90.50), 
(2, 2, 2, 1, 75.00, 'Concluído', 75.00);   
SELECT*FROM pedido;


CREATE TABLE IF NOT EXISTS pagamento (
	id_pagamento INT NOT NULL PRIMARY KEY,
	id_pedido INT NOT NULL,
    metodo_pagamento VARCHAR(50),
    estatus VARCHAR(50),
    data_pagamento DATETIME,
    valor_pago DECIMAL(10,2),
    FOREIGN KEY (id_pedido) references pedido(id_pedido)
) ENGINE = InnoDB;

INSERT INTO pagamento VALUES 
(1, 1, 'Cartão de Crédito', 'Aprovado', '2024-10-09 14:30:00', 90.50), 
(2, 2, 'Boleto', 'Aprovado', '2024-10-08 10:15:00', 75.00);             
SELECT*FROM pagamento;

-- ADICIONAR NOVOS ITENS 
DELIMITER $$
CREATE TRIGGER Atualizacao_de_estoque 
AFTER INSERT ON pedido
FOR EACH ROW
BEGIN
    -- Atualiza o estoque do produto após adicionar um novo item.
    UPDATE produto
    SET estoque = estoque - NEW.id_produto
    WHERE id_produto = NEW.id_produto;
END$$
DELIMITER ;

-- ATUALIZAR ESTOQUE APÓS FINALIZAÇÃO DE UMA COMPRA
DELIMITER $$
CREATE PROCEDURE AtualizaQuantidadeProduto(
    IN p_id_produto INT, 
    IN p_quantidade_comprada INT
)
BEGIN
    -- Verifica se há estoque suficiente
    DECLARE quantidade_atual INT;
    
    -- Obtém a quantidade atual do produto
    SELECT quantidade INTO quantidade_atual
    FROM produto
    WHERE id_produto = p_id_produto;
    
    -- Verifica se a quantidade atual é suficiente
    IF quantidade_atual >= p_quantidade_comprada THEN
	-- Atualiza a quantidade do produto no estoque
        UPDATE produto
        SET quantidade = quantidade - p_quantidade_comprada
        WHERE id_produto = p_id_produto;
    ELSE
	-- Lança um erro se não houver estoque suficiente
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Estoque insuficiente.';
    END IF;
END$$
DELIMITER ;
CALL AtualizaQuantidadeProduto(2, 5);

SELECT*FROM produto;

DELIMITER $$
CREATE PROCEDURE RetornaNomeProduto(
    IN p_id_carrinho INT
)
BEGIN
    -- Seleciona o nome do produto com base no id_carrinho fornecido
    SELECT carrinho.id_carrinho, produto.nome
    FROM carrinho
    JOIN produto ON carrinho.id_produto = produto.id_produto
    WHERE carrinho.id_carrinho = p_id_carrinho;
END$$
DELIMITER ;
CALL RetornaNomeProduto(''); 


