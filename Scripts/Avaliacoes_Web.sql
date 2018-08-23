DROP TABLE AVALIACOES_WEB;

CREATE TABLE AVALIACOES_WEB
(
  CODIGO_BASE		      NUMBER		NOT NULL,
  CHAVE_AVALIACAO_FUNC_ITEM   NUMBER            NOT NULL,
  CHAVE_MOVTO_AVALIACAO       NUMBER            NOT NULL,
  FUNCIONARIO                 NUMBER            NOT NULL,
  DESCRICAO                   VARCHAR2(30),
  PERIODO_INICIAL             DATE              NOT NULL,
  PERIODO_FINAL               DATE              NOT NULL,
  CODIGO_TITULO_AVALIACAO     VARCHAR2(5)  NOT NULL,
  DESCRICAO_TITULO_AVALIACAO  VARCHAR2(50),
  DESCRICAO_PERGUNTA          VARCHAR2(200),
  DESCRICAO_HABILIDADE        VARCHAR2(1000),
  RESPOSTA1                   VARCHAR2(300),
  RESPOSTA2                   VARCHAR2(300),
  RESPOSTA3                   VARCHAR2(300),
  RESPOSTA4                   VARCHAR2(300),
  RESPOSTA5                   VARCHAR2(300),
  RESPOSTA6                   VARCHAR2(300),
  RESPOSTA7                   VARCHAR2(300),
  RESPOSTA8                   VARCHAR2(300),
  RESPOSTA9                   VARCHAR2(300),
  RESPOSTA10                  VARCHAR2(300),
  RESPOSTA                    NUMBER
);

CREATE INDEX AW_CODIGO_BASE_I ON AVALIACOES_WEB (CODIGO_BASE);

CREATE UNIQUE INDEX AVALIACOES_WEB_UK ON AVALIACOES_WEB (CODIGO_BASE, CHAVE_AVALIACAO_FUNC_ITEM);

CREATE INDEX AW_CODIGO_TITULO_AVALIACAO_I ON AVALIACOES_WEB (CODIGO_TITULO_AVALIACAO);

CREATE INDEX AW_FUNCIONARIO_UK ON AVALIACOES_WEB (FUNCIONARIO);

ALTER TABLE AVALIACOES_WEB ADD (CONSTRAINT AVALIACOES_WEB_PK PRIMARY KEY (CHAVE_AVALIACAO_FUNC_ITEM));
