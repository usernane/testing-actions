<?php
use PHPUnit\Framework\TestCase;
use webfiori\database\ConnectionInfo;
use webfiori\framework\DB;
use webfiori\framework\WebFioriApp;
use webfiori\database\mysql\MySQLTable;
/**
 * Description of ConnectionTest
 *
 * @author Ibrahim
 */
class ConnectionTest extends TestCase{
    /**
     * @test
     */
    public function test00() {
        $connection = new ConnectionInfo('mysql', 'root', 123456, 'testing_db', 'localhost', 3306, [
            'connection-name' => 'test-connection'
        ]);
        WebFioriApp::getAppConfig()->addDbConnection($connection);
        $db = new DB('test-connection');
        $tempTable = new MySQLTable();
        $tempTable->addColumns([
            'id' => [
                'is-primary' => true,
                'type' => 'int',
                'size' => 3,
                'auto-inc' => true,
            ]
        ]);
        $db->addTable($tempTable);
        $db->table('new_table')->createTable()->execute();
        $this->assertTrue(true);
    }
}
