<?php namespace EZAuth\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_create_auth_tables extends Migration
{
	public function up()
	{
        /*
         * Users
         */
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

        /*
         * Auth Login Attempts
         */
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Only for successful logins
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
            'created_at'    => ['type' => 'datetime'],
            'updated_at'    => ['type' => 'datetime'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('user_id');
        // NOTE: Do NOT delete the user_id or email when the user is deleted for security audits
        $this->forge->createTable('auth_logins', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
		$this->forge->dropTable('auth_logins');
	}
}
