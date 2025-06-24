<?php

namespace MySQLDump\Mask;

interface IFieldConfig
{
    /**
     * Verifica se o campo é criptografável baseado na linha de dados
     * 
     * @param array $row Linha de dados da tabela
     * @return bool True se o campo é criptografável, false caso contrário
     */
    public function isEncryptableField(array $row): bool;
} 