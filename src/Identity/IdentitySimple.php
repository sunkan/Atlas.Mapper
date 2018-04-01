<?php
/**
 *
 * This file is part of Atlas for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Atlas\Mapper\Identity;

use Atlas\Mapper\Exception;
use Atlas\Table\Row;
use SplObjectStorage;

class IdentitySimple extends IdentityMap
{
    public function __construct(string $primaryKey)
    {
        $this->primaryKey = $primaryKey;
        $this->rowToSerial = new SplObjectStorage();
    }

    protected function getArrayFromRow(Row $row) : array
    {
        return [$row->{$this->primaryKey}];
    }

    protected function getArray($primaryVal) : array
    {
        if (! is_scalar($primaryVal)) {
            throw Exception::invalidType('scalar', gettype($primaryVal));
        }

        return [$primaryVal];
    }
}
