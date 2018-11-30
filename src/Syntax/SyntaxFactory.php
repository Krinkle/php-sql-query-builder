<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 6/3/14
 * Time: 12:07 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Krinkle\Sql\QueryBuilder\Syntax;

/**
 * Class SyntaxFactory.
 */
final class SyntaxFactory
{
    /**
     * Creates a collection of Column objects.
     *
     * @param array      $arguments
     * @param Table|null $table
     *
     * @return array
     */
    public static function createColumns(array &$arguments, $table = null)
    {
        $createdColumns = [];

        foreach ($arguments as $index => $column) {
            if (!is_object($column)) {
                $newColumn = array($column);
                $column = self::createColumn($newColumn, $table);
                if (!is_numeric($index)) {
                    $column->setAlias($index);
                }

                $createdColumns[] = $column;
            } else if ($column instanceof Column) {
                $createdColumns[] = $column;
            }
        }

        return \array_filter($createdColumns);
    }

    /**
     * Creates a Column object.
     *
     * @param array      $argument
     * @param Table|null $table
     *
     * @return Column
     */
    public static function createColumn(array &$argument, $table = null)
    {
        $columnName = \array_values($argument);
        $columnName = $columnName[0];

        $columnAlias = \array_keys($argument);
        $columnAlias = $columnAlias[0];

        if (\is_numeric($columnAlias) || \strpos($columnName, '*') !== false) {
            $columnAlias = null;
        }

        return new Column($columnName, $table, $columnAlias);
    }

    /**
     * Creates a Table object.
     *
     * @param string|string[]|Table $table
     *
     * @return Table
     */
    public static function createTable($table)
    {
        if ($table instanceof Table) {
            $newTable = clone $table;
        } else {
            if (\is_array($table)) {
                $tableName = \current($table);
                $tableAlias = \key($table);
            } else {
                $tableName = $table;
                $tableAlias = null;
            }

            $newTable = new Table($tableName);

            if ($tableAlias !== null && !\is_numeric($tableAlias)) {
                $newTable->setAlias($tableAlias);
            }
        }

        return $newTable;
    }
}
