<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/16/14
 * Time: 8:50 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Krinkle\Tests\Sql\QueryBuilder\Manipulation;

use Krinkle\Sql\QueryBuilder\Manipulation\QueryFactory;
use Krinkle\Sql\QueryBuilder\Manipulation\Select;

/**
 * Class QueryFactoryTest.
 */
class QueryFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldCreateSelectObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Select';
        $this->assertInstanceOf($className, QueryFactory::createSelect());
    }

    /**
     * @test
     */
    public function itShouldCreateInsertObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Insert';
        $this->assertInstanceOf($className, QueryFactory::createInsert());
    }

    /**
     * @test
     */
    public function itShouldCreateUpdateObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Update';
        $this->assertInstanceOf($className, QueryFactory::createUpdate());
    }

    /**
     * @test
     */
    public function itShouldCreateDeleteObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Delete';
        $this->assertInstanceOf($className, QueryFactory::createDelete());
    }

    /**
     * @test
     */
    public function itShouldCreateMinusObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Minus';
        $this->assertInstanceOf($className, QueryFactory::createMinus(new Select('table1'), new Select('table2')));
    }

    /**
     * @test
     */
    public function itShouldCreateUnionObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\Union';
        $this->assertInstanceOf($className, QueryFactory::createUnion());
    }

    /**
     * @test
     */
    public function itShouldCreateUnionAllObject()
    {
        $className = '\Krinkle\Sql\QueryBuilder\Manipulation\UnionAll';
        $this->assertInstanceOf($className, QueryFactory::createUnionAll());
    }

    /**
     * @test
     */
    public function itShouldCreateWhereObject()
    {
        $mockClass = '\Krinkle\Sql\QueryBuilder\Manipulation\QueryInterface';

        $query = $this->getMockBuilder($mockClass)
            ->disableOriginalConstructor()
            ->getMock();

        $className = '\Krinkle\Sql\QueryBuilder\Syntax\Where';
        $this->assertInstanceOf($className, QueryFactory::createWhere($query));
    }
}
