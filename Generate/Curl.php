<?php
/**
 * 557 检索表结构 ，并生成Beam和Model.
 * @author WiconWang <WiconWang@gmail.com>
 * @copyright  2019/8/14 8:26 PM
 */
include "./vendor/autoload.php";
\EasySwoole\EasySwoole\Core::getInstance()->initialize();
// 生成核心base
$init = new \AutomaticGeneration\Init();
$init->initBaseModel();
$init->initBaseController();





$DBConfig = \EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL');
$mysqlConfig = new \EasySwoole\Mysqli\Config($DBConfig);
\EasySwoole\MysqliPool\Mysql::getInstance()->register('mysql',$mysqlConfig);


go(function () {
    $db = \EasySwoole\MysqliPool\Mysql::defer('mysql');
    $result = $db->rawQuery("show tables;");
    $tableList = array_column($result,'Tables_in_easytest');
    //生成所有的bean，model

    foreach ($tableList as $tableName){
        echo PHP_EOL.PHP_EOL."======>>> 检测到表 [$tableName] <<<======".PHP_EOL;
        $mysqlTable = new \AutomaticGeneration\MysqlTable($db, \EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL.database'));
        $tableColumns = $mysqlTable->getColumnList($tableName);
        $tableComment = $mysqlTable->getComment($tableName);

        echo PHP_EOL.PHP_EOL.">> 生成 Bean".PHP_EOL;
        $path = '';
        $beanConfig = new \AutomaticGeneration\Config\BeanConfig();
        $beanConfig->setBaseNamespace("App\\Bean".$path);
        $beanConfig->setTablePre(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL.prefix'));
        $beanConfig->setTableName($tableName);
        $beanConfig->setTableComment($tableComment);
        $beanConfig->setTableColumns($tableColumns);
        $beanBuilder = new \AutomaticGeneration\BeanBuilder($beanConfig);
        $result = $beanBuilder->generateBean();
        echo "> 已处理：$result".PHP_EOL;


        echo PHP_EOL.PHP_EOL.">> 生成 Model".PHP_EOL;
        $path = '';
        $modelConfig = new \AutomaticGeneration\Config\ModelConfig();
        $modelConfig->setBaseNamespace("App\\Model".$path);
        $modelConfig->setTablePre("");
        $modelConfig->setExtendClass(\App\Model\BaseModel::class);
        $modelConfig->setTableName($tableName);
        $modelConfig->setTableComment($tableComment);
        $modelConfig->setTableColumns($tableColumns);
        $modelBuilder = new \AutomaticGeneration\ModelBuilder($modelConfig);
        $result = $modelBuilder->generateModel();
        echo "> 已处理：$result".PHP_EOL;


        echo PHP_EOL.PHP_EOL.">> 生成 Controller".PHP_EOL;
        $path='\\Admin';
        $controllerConfig = new \AutomaticGeneration\Config\ControllerConfig();
        $controllerConfig->setBaseNamespace("App\\HttpController".$path);
//        $controllerConfig->setBaseDirectory( EASYSWOOLE_ROOT . '/App/HttpController/');
        $controllerConfig->setTablePre(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL.prefix'));
        $controllerConfig->setTableName($tableName);
        $controllerConfig->setTableComment($tableComment);
        $controllerConfig->setTableColumns($tableColumns);
        $controllerConfig->setExtendClass("App\\HttpController\\Base");
        $controllerConfig->setModelClass($modelBuilder->getClassName());
        $controllerConfig->setBeanClass($beanBuilder->getClassName());
        $controllerConfig->setMysqlPoolClass(EasySwoole\MysqliPool\Mysql::class);
        $controllerConfig->setMysqlPoolName('mysql');
        $controllerBuilder = new \AutomaticGeneration\ControllerBuilder($controllerConfig);
        $result = $controllerBuilder->generateController();
        echo "> 已处理：$result".PHP_EOL;
//
//        $path='\\Index';
//        $controllerConfig = new \AutomaticGeneration\Config\ControllerConfig();
//        $controllerConfig->setBaseNamespace("App\\HttpController".$path);
//        $controllerConfig->setTablePre($DBConfig['prefix);
//        $controllerConfig->setTableName($tableName);
//        $controllerConfig->setTableComment($tableComment);
//        $controllerConfig->setTableColumns($tableColumns);
//        $controllerConfig->setExtendClass("App\\HttpController".$path."\\Base");
//        $controllerConfig->setModelClass($modelBuilder->getClassName());
//        $controllerConfig->setBeanClass($beanBuilder->getClassName());
//        $controllerConfig->setMysqlPoolClass(EasySwoole\MysqliPool\Mysql::class);
//        $controllerConfig->setMysqlPoolName('mysql');
//        $controllerBuilder = new \AutomaticGeneration\ControllerBuilder($controllerConfig);
//        $result = $controllerBuilder->generateController();
//
//        var_dump($result);
//        $path='\\User';
//        $controllerConfig = new \AutomaticGeneration\Config\ControllerConfig();
//        $controllerConfig->setBaseNamespace("App\\HttpController".$path);
//        $controllerConfig->setTablePre($DBConfig['prefix);
//        $controllerConfig->setTableName($tableName);
//        $controllerConfig->setTableComment($tableComment);
//        $controllerConfig->setTableColumns($tableColumns);
//        $controllerConfig->setExtendClass("App\\HttpController".$path."\\Base");
//        $controllerConfig->setModelClass($modelBuilder->getClassName());
//        $controllerConfig->setBeanClass($beanBuilder->getClassName());
//        $controllerConfig->setMysqlPoolClass(EasySwoole\MysqliPool\Mysql::class);
//        $controllerConfig->setMysqlPoolName('mysql');
//        $controllerBuilder = new \AutomaticGeneration\ControllerBuilder($controllerConfig);
//        $result = $controllerBuilder->generateController();
//        var_dump($result);
    }
    exit;
});