<?php

namespace Tests;

use FirstAide\MysqlDatabase;
use FirstAide\MysqlResult;

trait MysqlWrapperMockTrait
{
    private function getMysqlWrapperMock(array $mockData): MysqlDatabase
    {
        $this->mysqli = $this->getMockBuilder(MysqlDatabase::class)
            ->setMethods(
                array(
                    'prepare',
                    'bind_param',
                    'execute',
                    'get_result',
                    'close'
                )
            )
            ->disableOriginalConstructor()
            ->getMock();

        $this->mysqli->expects($this->any())
            ->method('prepare')
            ->will($this->returnCallback(function($query) {
                $this->tmp_query = $query;
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('execute')
            ->will($this->returnCallback(function() {
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('bind_param')
            ->will($this->returnCallback(function() use ($mockData) {
                $func_args = func_get_args();
                $types = str_split(array_shift($func_args));
                foreach($func_args as $v) {
                    $type = array_shift($types);
                    $string_to_replace = '?';
                    $replace_with = $type == 's' ? ("'".$v."'") : $v;

                    $string_to_replace = '/'.preg_quote($string_to_replace, '/').'/';
                    $this->tmp_query = preg_replace(
                        $string_to_replace,
                        $replace_with,
                        $this->tmp_query,
                        1
                    );
                }

                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('close')
            ->will($this->returnCallback(function() {
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('get_result')
            ->will($this->returnCallback(function() use ($mockData) {

                $results = array($mockData[$this->tmp_query]);

                $mysqliResult = $this->getMockBuilder(MysqlResult::class)
                    ->setMethods(array('fetch_assoc', 'fetchArray', 'getNumRows'))
                    ->disableOriginalConstructor()
                    ->getMock();

                $mysqliResult
                    ->expects($this->any())
                    ->method('fetch_assoc')
                    ->will($this->returnCallback(function () use ($results) {
                        static $i = 0;
                        return isset($results[$i]) ? $results[$i++] : false;
                    }));

                $mysqliResult
                    ->expects($this->any())
                    ->method('fetchArray')
                    ->will($this->returnCallback(function () use ($results) {
                        static $i = 0;
                        return isset($results[$i]) ? $results[$i++] : false;
                    }));

                $mysqliResult
                    ->expects($this->any())
                    ->method('getNumRows')
                    ->will($this->returnCallback(function () use ($results) {
                        return count($results);
                    }));

                return $mysqliResult;
            })
        );

        return $this->mysqli;
    }
}
