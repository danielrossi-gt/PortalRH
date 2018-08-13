DROP TABLE FUNCIONARIOS_WEB;

CREATE TABLE FUNCIONARIOS_WEB
(
  CHAVE                NUMBER                   NOT NULL,
  CODIGO_BASE          NUMBER                   NOT NULL,
  CPF                  VARCHAR2(11)        NOT NULL,
  SENHA                VARCHAR2(50)        NOT NULL,
  CODIGO               VARCHAR2(6)         NOT NULL,
  NUMERO_RG            VARCHAR2(15),
  NOME                 VARCHAR2(60),
  CARTAO_CHAPEIRA      VARCHAR2(14),
  DT_ADMISSAO          DATE,
  CBO                  VARCHAR2(6),
  DT_FIM_CONTR         DATE,
  NRO_CC               VARCHAR2(15),
  VLR_SALARIO_NORMAL   NUMBER,
  HS_SEMANAL           NUMBER(6,2),
  DATA_NASCIMENTO      DATE,
  PIS                  NUMBER(11),
  NUMERO_CNH           VARCHAR2(20),
  TITULO_ELEITORAL     NUMBER(13),
  CART_RESERVISTA      NUMBER(12),
  TELEFONE             VARCHAR2(15),
  TELEFONE_CELULAR     VARCHAR2(15),
  COD_UNID_NEGOCIO     VARCHAR2(3),
  DESC_UNID_NEGOCIO    VARCHAR2(50),
  COD_UNID_FUNCIONAL   VARCHAR2(25),
  DESC_UNID_FUNCIONAL  VARCHAR2(50),
  DESC_CARGO           VARCHAR2(50),
  COD_LOTE_PONTO       VARCHAR2(15),
  DESC_LOTE_PONTO      VARCHAR2(50),
  COD_CUSTO            VARCHAR2(5),
  DESC_CUSTO           VARCHAR2(30),
  COD_BCOAGE           VARCHAR2(8)
);

CREATE INDEX FUNCWEB_NOME_I ON FUNCIONARIOS_WEB (NOME);

CREATE UNIQUE INDEX FUNCWEB_PK ON FUNCIONARIOS_WEB (CHAVE);

CREATE UNIQUE INDEX FUNCWEB_UK ON FUNCIONARIOS_WEB (CODIGO);

ALTER TABLE FUNCIONARIOS_WEB ADD (CONSTRAINT FUNCWEB_PK PRIMARY KEY (CHAVE));
