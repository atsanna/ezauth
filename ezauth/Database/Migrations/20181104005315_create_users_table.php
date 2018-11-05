<?php namespace EZAuth\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_create_users_table extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'            => ['type' => 'integer', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'first_name'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'last_name'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'email'         => ['type' => 'varchar', 'constraint' => 255],
			'password_hash' => ['type' => 'varchar', 'constraint' => 255],
			'created_at'    => ['type' => 'datetime'],
			'updated_at'    => ['type' => 'datetime'],
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('email');
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
