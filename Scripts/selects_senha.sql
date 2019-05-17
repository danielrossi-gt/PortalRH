SELECT FUNCIONARIOS_web.*, utl_raw.cast_to_varchar2(utl_encode.base64_decode(utl_raw.cast_to_raw(SENHA))) FROM FUNCIONARIOS_web WHERE SENHA IS NOT NULL ORDER BY chave

UPDATE FUNCIONARIOS SET SENHA_PORTAL_RH = utl_raw.cast_to_varchar2(utl_encode.base64_encode(utl_raw.cast_to_raw('123456'))) where chave = 203319



select * from folha_web


select * from avaliacoes_web


update avaliacoes_web set resposta = NULL