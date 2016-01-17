USE INFORSHOP;
DROP VIEW IF EXISTS comp_por_cli;

CREATE VIEW comp_por_cli AS
(SELECT c.data_compra, cli.nome, p.nome_produto, d.quantidade, d.desconto
FROM compra as c, detalhes_compra as d, produtos as p, clientes as cli
WHERE c.id_compra = d.id_compra
-- AND cli.id_cliente = '1'
AND c.id_cliente = cli.id_cliente
AND d.id_produto = p.id_produto);


SELECT SUM(quantidade)               
FROM comp_por_cli;  

SELECT * FROM comp_por_cli;