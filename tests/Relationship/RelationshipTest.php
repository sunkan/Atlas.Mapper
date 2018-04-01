<?php
namespace Atlas\Mapper\Relationship;

use Atlas\Mapper\Container;
use Atlas\Mapper\MapperLocator;
use Atlas\Pdo\Connection;
use Atlas\Testing\DataSource\Author\AuthorMapper;
use Atlas\Testing\DataSource\Reply\ReplyMapper;
use Atlas\Testing\DataSource\SqliteFixture;
use Atlas\Testing\DataSource\Summary\SummaryMapper;
use Atlas\Testing\DataSource\Summary\SummaryTable;
use Atlas\Testing\DataSource\Tag\TagMapper;
use Atlas\Testing\DataSource\Tagging\TaggingMapper;
use Atlas\Testing\DataSource\Thread\ThreadMapper;

abstract class RelationshipTest extends \PHPUnit\Framework\TestCase
{
    protected $mapperLocator;

    protected function setUp()
    {
        $connection = (new SqliteFixture())->exec();

        $container = new Container($connection);
        $container->setMappers([
            AuthorMapper::CLASS,
            ReplyMapper::CLASS,
            SummaryMapper::CLASS,
            TagMapper::CLASS,
            ThreadMapper::CLASS,
            TaggingMapper::CLASS,
        ]);

        $this->mapperLocator = $container->newMapperLocator();
    }

    public function testValuesDontMatch()
    {
        $fake = new \Atlas\Mapper\Fake\FakeRelationship();
        $this->assertFalse($fake->valuesMatch('1', 'a'));
    }
}
