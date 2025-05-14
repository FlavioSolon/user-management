<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m250514_122653_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'registration_number' => $this->string(20)->notNull(),
            'password' => $this->string()->notNull(),
            'role' => $this->string()->notNull()->defaultValue('user'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);


        $this->createIndex('idx_users_email', 'users', 'email', true);
        $this->createIndex('idx_users_registration_number', 'users', 'registration_number', true);


        $this->insert('users', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'registration_number' => '1001',
            'password' => \Yii::$app->security->generatePasswordHash('123456'),
            'role' => 'admin',
        ]);

        $this->insert('users', [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'registration_number' => '1002',
            'password' => \Yii::$app->security->generatePasswordHash('123456'),
            'role' => 'user',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
