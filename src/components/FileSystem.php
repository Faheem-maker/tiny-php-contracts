<?php

namespace framework\contracts\components;

interface FileSystem
{
    public function exists(string $path): bool;

    public function move(string $source, string $destination): bool;
}