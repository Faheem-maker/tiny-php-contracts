<?php

namespace framework\contracts;

interface ActionInterface
{
    public function execute(array $params);
}