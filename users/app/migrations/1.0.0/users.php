<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;
use Phalcon\Security;

/**
 * Class UsersMigration_100
 */
class UsersMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 20,
                            'primary' => true,
                            'autoIncrement' => true,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'login',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 100,
                            'after' => 'id'
                        ]
                    ),
                    new Column(
                        'password',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 100,
                            'after' => 'login'
                        ]
                    )
                ],
                'indexes' => [
                    new Index('sqlite_autoindex_users_1', ['id'], 'PRIMARY')
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $security = new Security();
        self::$connection->insert('users', [
            'admin', $security->hash('admin')
        ], [
            'login', 'password'
        ]);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
