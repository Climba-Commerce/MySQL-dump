<?php

namespace MySQLDump\Mask;

interface ICryptoProvider
{
    /**
     * Criptografa dados usando o contexto fornecido
     * 
     * @param string $data Dados a serem criptografados
     * @param array $context Contexto com informações necessárias para criptografia
     * @return string Dados criptografados
     * @throws \Exception Em caso de erro na criptografia
     */
    public function encrypt(string $data): string;

    /**
     * Descriptografa dados usando o contexto fornecido
     * 
     * @param string $data Dados a serem descriptografados
     * @param array $context Contexto com informações necessárias para descriptografia
     * @return string Dados descriptografados
     * @throws \Exception Em caso de erro na descriptografia
     */
    public function decrypt(string $data): string;
} 