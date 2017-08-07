<?php

namespace Tests;

use FirstAide\MysqlDatabase;
use FirstAide\MysqlResult;

trait MysqlWrapperMockTrait
{
    private function getMysqlWrapperMock(
        array $mockData,
        array $replacePatterns = array()
    ): MysqlDatabase {
        $this->mysqli = $this->getMockBuilder(MysqlDatabase::class)
            ->setMethods(
                array(
                    'prepare',
                    'bindParams',
                    'execute',
                    'getResults',
                    'getAffectedRows',
                    'close'
                )
            )
            ->disableOriginalConstructor()
            ->getMock();

        $this->mysqli->expects($this->any())
            ->method('prepare')
            ->will($this->returnCallback(function ($query) {
                $this->tmp_query = preg_replace(
                    '/[ \t]+/',
                    ' ',
                    preg_replace('/[\r\n]+/', " ", trim($query))
                );
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('bindParams')
            ->will($this->returnCallback(function () use ($mockData, $replacePatterns) {
                $func_args = func_get_args();
                $types = str_split(array_shift($func_args));
                foreach ($func_args as $v) {
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

                foreach ($replacePatterns as $p) {
                    preg_match(
                        $p['pattern'],
                        $this->tmp_query,
                        $output_array
                    );
                    if (!empty($output_array) && !empty($output_array[$p['regex_reponse_index']])) {
                        $this->tmp_query = str_replace(
                            $output_array[$p['regex_reponse_index']],
                            $p['replace_with'],
                            $this->tmp_query
                        );
                    }
                }

                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('execute')
            ->will($this->returnCallback(function () use ($mockData) {
                $this->results = isset($mockData[$this->tmp_query])
                    ? array($mockData[$this->tmp_query])
                    : array();
                $this->affected_rows = count($this->results);
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('getAffectedRows')
            ->will($this->returnCallback(function () use ($mockData) {
                return $this->affected_rows;
            }));

        $this->mysqli->expects($this->any())
            ->method('close')
            ->will($this->returnCallback(function () {
                return $this->mysqli;
            }));

        $this->mysqli->expects($this->any())
            ->method('getResults')
            ->will($this->returnCallback(function () use ($mockData) {

                $results = $this->results;

                $this->mysqliResult = $this->getMockBuilder(MysqlResult::class)
                    ->setMethods(array('fetchAssoc', 'fetchArray', 'getNumRows'))
                    ->disableOriginalConstructor()
                    ->getMock();

                $this->mysqliResult
                    ->expects($this->any())
                    ->method('fetchAssoc')
                    ->will($this->returnCallback(function () use ($results) {
                        static $fetch_assoc_count = 0;
                        return isset($results[$fetch_assoc_count]) ? $results[$fetch_assoc_count++] : false;
                    }));

                $this->mysqliResult
                    ->expects($this->any())
                    ->method('fetchArray')
                    ->will($this->returnCallback(function () use ($results) {
                        static $i = 0;
                        return isset($results[$i]) ? $results[$i++] : false;
                    }));

                $this->mysqliResult
                    ->expects($this->any())
                    ->method('getNumRows')
                    ->will($this->returnCallback(function () use ($results) {
                        return count($results);
                    }));

                return $this->mysqliResult;
            }));

        return $this->mysqli;
    }
}
