<?php

use yii\db\Migration;

/**
 * Class m200729_044947_create_table_user
 */
class m200729_044947_create_table_user extends Migration
{
    public function up()
    {
        $this->batchInsert('auth_item',
            [
                'name',
                'type'
            ],
            [
                [
                    'Admin',
                    1
                ],
                [
                    'User',
                    1
                ],
                [
                    'Student',
                    1
                ],
            ]);

        $this->createTable('user', [
            'id' => $this->primaryKey() . ' NOT NULL',
            'username' => $this->string() . ' NOT NULL',
            'auth_key' => $this->string(),
            'password_hash' => $this->string() . ' NOT NULL',
            'password_reset_token' => $this->string(),
            'email' => $this->string() . ' NOT NULL',
            'status' => $this->smallInteger(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(7),
            'updated_by' => $this->integer(7),
        ]);

        $this->createIndex('username', 'user', 'username', true);
        $this->createIndex('email', 'user', 'email', true);

        $this->batchInsert('user',
            [
                'username',
                'auth_key',
                'password_hash',
                'email',
                'status',
                'created_at',
                'created_by'
            ],
            [
                [
                    'admin',
                    Yii::$app->security->generateRandomString(),
                    Yii::$app->security->generatePasswordHash('123456'),
                    'admin@admin.com',
                    1,
                    date('Y-m-d H:i:s'),
                    1,
                ],
                [
                    'user',
                    Yii::$app->security->generateRandomString(),
                    Yii::$app->security->generatePasswordHash('123456'),
                    'user@user.com',
                    1,
                    date('Y-m-d H:i:s'),
                    1,
                ],
            ]);

        $this->batchInsert('auth_assignment',
            [
                'item_name',
                'user_id',
            ],
            [
                [
                    'Admin',
                    '1',
                ],
                [
                    'User',
                    '2',
                ],
            ]);
    }
}
