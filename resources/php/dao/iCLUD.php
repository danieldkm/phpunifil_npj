<?php

interface iCLUD {
    function inserir ($objeto);
    function atualizar($objeto);
    function deletar($objeto);
    function findAll();
    function findById($id);
}