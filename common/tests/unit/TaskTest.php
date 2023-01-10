<?php


namespace common\tests\Unit;

use common\models\Task;
use common\tests\UnitTester;

class TaskTest extends \Codeception\Test\Unit
{
    public $idCreated_by;
    public $idAssigned_by;


    protected UnitTester $tester;


    protected function _before()
    {
        //user1
        $this->idCreated_by = $this->tester->haveRecord('common\models\User', [
            'username' => 'jose',
            'email' => 'jose@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user123451'),
            'isEmployee' => 1,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'Jose',
        ]);

        $this->idAssigned_by = $this->tester->haveRecord('common\models\User', [
            'username' => 'joao',
            'email' => 'joao@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user123452'),
            'isEmployee' => 1,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'Joao',
        ]);

    }

    // tests
    public function testAddTask()
    {
        $task = new Task();
        $task->setAttributes(array(
                'date' => '20-02-2023',
                'type' => 'TestDrive',
                'description' => 'Realizar testdrive com cliente',
                'status' => 'Por iniciar',
                'idCreated_by' => $this->idCreated_by,
                'idAssigned_to' => $this->idAssigned_by,
                'created_at' => '2023-02-18 18:00:00',
            )
        );

        $this->assertTrue($task->save());
        $this->tester->seeRecord('common\models\Task', ['id' => $task->id]);
    }

    public function testUpdateTask()
    {
        $id = $this->tester->haveRecord('common\models\Task', [
            'date' => '20-02-2023',
            'type' => 'TestDrive',
            'description' => 'Realizar testdrive com cliente',
            'status' => 'Por iniciar',
            'idCreated_by' => $this->idCreated_by,
            'idAssigned_to' => $this->idAssigned_by,
            'created_at' => '2023-02-18 18:00:00',
        ]);

        $task = Task::findOne($id);
        $task->setAttribute('status', 'Em Processo');

        $this->assertTrue($task->save());
        $this->assertEquals('Em Processo', $task->status);

        //verify
        $this->tester->seeRecord('common\models\Task', ['status' => 'Em Processo', 'id' => $id]);
        $this->tester->dontSeeRecord('common\models\Task', ['status' => 'Por iniciar', 'id' => $id]);
    }

    public function testRemoveTask()
    {
        $id = $this->tester->haveRecord('common\models\Task', [
            'date' => '20-02-2023',
            'type' => 'TestDrive',
            'description' => 'Realizar testdrive com cliente',
            'status' => 'Por iniciar',
            'idCreated_by' => $this->idCreated_by,
            'idAssigned_to' => $this->idAssigned_by,
            'created_at' => '2023-02-18 18:00:00',
        ]);

        $task = Task::findOne($id);
        $task->delete();

        $this->tester->dontSeeRecord('common\models\Task', ['id' => $id]);
    }

    public function testCanNotSaveTaskMissingType()
    {
        $task = new Task();
        $task->setAttributes(array(
                'date' => '20-02-2023',
                'type' => '',
                'description' => 'Realizar testdrive com cliente',
                'status' => 'Por iniciar',
                'idCreated_by' => $this->idCreated_by,
                'idAssigned_to' => $this->idAssigned_by,
                'created_at' => '2023-02-18 18:00:00',
            )
        );

        $this->assertFalse($task->save());
    }

    public function testCanNotSaveTaskMissingDescription()
    {
        $task = new Task();
        $task->setAttributes(array(
                'date' => '20-02-2023',
                'type' => 'Visita',
                'description' => '',
                'status' => 'Por iniciar',
                'idCreated_by' => $this->idCreated_by,
                'idAssigned_to' => $this->idAssigned_by,
                'created_at' => '2023-02-18 18:00:00',
            )
        );

        $this->assertFalse($task->save());
    }
}
