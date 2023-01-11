<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;


class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();

        //<editor-fold desc="Create Permission">

        /** AccessBackend*/
        $canAccessBackOffice = $authManager->createPermission('canAccessBackOffice');
        $canAccessBackOffice->description = 'Have permission to access BackOffice';
        $authManager->add($canAccessBackOffice);

        /** Create User_All*/
        $canCreateAllUsers = $authManager->createPermission('canCreateAllUsers');
        $canCreateAllUsers->description = 'Have permission to create all users types';
        $authManager->add($canCreateAllUsers);

        /** Create User_Customer*/
        $canCreateCustomer = $authManager->createPermission('canCreateCustomer');
        $canCreateCustomer->description = 'Have permission to create user with customer permissions';
        $authManager->add($canCreateCustomer);

        /** Create User_Employee */
        $canCreateEmployee = $authManager->createPermission('canCreateEmployee');
        $canCreateEmployee->description = 'Have permission to create user with employee permissions';
        $authManager->add($canCreateEmployee);

        //</editor-fold>

        //<editor-fold desc="Create Roles">

        /** Create Customer */
        $customer = $authManager->createRole('customer');
        $customer->description = 'Role';
        $authManager->add($customer);

        /** Create Employee */
        $employee = $authManager->createRole('employee');
        $employee->description = 'Role';
        $authManager->add($employee);
        $authManager->addChild($employee, $customer);
        $authManager->addChild($employee, $canAccessBackOffice);
        $authManager->addChild($employee, $canCreateCustomer);

        /** Create Manager */
        $manager = $authManager->createRole('manager');
        $manager->description = 'Role';
        $authManager->add($manager);
        $authManager->addChild($manager, $employee);
        $authManager->addChild($manager, $canCreateEmployee);

        /** Create Admin */
        $admin = $authManager->createRole('admin');
        $admin->description = 'Role';
        $authManager->add($admin);
        $authManager->addChild($admin, $manager);
        $authManager->addChild($admin, $canCreateAllUsers);
        //</editor-fold>

        //<editor-fold desc="Assign permission">
        $authManager->assign($admin, 1);
        $authManager->assign($manager, 2);
        $authManager->assign($customer, 6);
        $authManager->assign($employee, 4);
        //</editor-fold>
    }
}