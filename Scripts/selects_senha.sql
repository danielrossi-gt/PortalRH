SELECT FUNCIONARIOS.*, utl_raw.cast_to_varchar2(utl_encode.base64_decode(utl_raw.cast_to_raw(SENHA_PORTAL_RH))) FROM FUNCIONARIOS WHERE SENHA_PORTAL_RH IS NOT NULL ORDER BY NOME

UPDATE FUNCIONARIOS SET SENHA_PORTAL_RH = utl_raw.cast_to_varchar2(utl_encode.base64_encode(utl_raw.cast_to_raw('123456'))) where chave = 203319