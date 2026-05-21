-- 1 e 2. Criar e selecionar o banco de dados
CREATE DATABASE IF NOT EXISTS agenda
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE agenda;

-- 3. Criar a tabela 'contatos'
CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(14),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Criar a tabela 'clientes' (com CPF único)
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(14),
    endereco VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Criar a tabela 'produtos'
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL, 
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    imagem VARCHAR(255),        -- Obrigatório para o produtos-cadastrar.php e produtos.php
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Bom para controle interno
);


-- --------------------------------------------------------
-- 6. Inserir registros de exemplo (Dados de Teste)

-- Inserts em contatos
INSERT INTO contatos (nome, email, telefone) VALUES 
('Ana Silva', 'ana.silva@email.com', '(11) 99999-1111'),
('Bruno Costa', 'bruno.costa@email.com', '(21) 98888-2222'),
('Carlos Souza', 'carlos.souza@email.com', '(31) 97777-3333');

-- Inserts em clientes
INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES 
('Mariana Oliveira', '123.456.789-00', 'mariana@email.com', '(11) 96666-4444', 'Rua das Flores, 123'),
('Rodrigo Santos', '987.654.321-11', 'rodrigo@email.com', '(21) 95555-5555', 'Av. Central, 456'),
('Juliana Lima', '456.789.123-22', 'juliana@email.com', '(31) 94444-6666', 'Alameda dos Anjos, 789');

-- Inserts em produtos
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES 
('Notebook Pro', 'Notebook de alta performance com 16GB RAM', 4500.00, 10),
('Mouse Sem Fio', 'Mouse ergonômico bluetooth', 120.50, 50),
('Teclado Mecânico', 'Teclado RGB com switches blue', 350.00, 25);

-- --------------------------------------------------------
-- 7. Executar SELECT para confirmar os dados

SELECT * FROM contatos;
SELECT * FROM clientes;
SELECT * FROM produtos;