<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
include_once '../aliyun-php-sdk-core/Config.php';
use Cs\Request\V20151215 as Cs;

$iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "ACSbW2iBbyX0Pk9N", "TLSwMm5LQU");
$client = new DefaultAcsClient($iClientProfile);

//createCluster($client);
//scaleCluster($client,"c00a43b26e71a4c05ac0b592b7bb32830");
//deleteCluster($client,"cacdffd35104b46c79280d86bc4e3a745");
//describeApiVersion($client);
//describeClusters($client);
//describeClusterInfo($client,"c550e0c06c16042c39c9335c60563fcd5");
//describeClusterCerts($client,"c550e0c06c16042c39c9335c60563fcd5");

function createCluster($client){
    $params = array(
        //"region_id"=>"cn-hangzhou",
        "password"=>"Just12345",
        "instance_type"=>"ecs.t1.small",
        "name"=>"my-php-cluster-".time(),
        "size"=>1,
        "network_mode"=>"classic",
        "data_disk_category"=>"cloud",
        "data_disk_size"=>40,
        "ecs_image_id"=>"m-23lgldfxg",
    );

    $request = new Cs\CreateClusterRequest();
    $request->setMethod("POST");
    $request->setContent(json_encode($params));
    $response = $client->doAction($request);
    print_r($response);
}

function scaleCluster($client,$clusterId){
    $params = array(
        //"region_id"=>"cn-hangzhou",
        "password"=>"Just12345",
        "instance_type"=>"ecs.t1.small",
        "size"=>2,
        "data_disk_category"=>"cloud",
        "data_disk_size"=>40,
        "ecs_image_id"=>"m-23lgldfxg",
    );

    var_dump(json_encode($params));

    $request = new Cs\ScaleClusterRequest();
    $request->setMethod("PUT");
    //$request->setClusterId("c781dc2f76bc0441a8d3c741cec070534");
    $request->putPathParameter("ClusterId",$clusterId);
    $request->setContent(json_encode($params));
    $response = $client->doAction($request);
    print_r($response);
}

function deleteCluster($client,$clusterId){
    $request = new Cs\DeleteClusterRequest();
    $request->setMethod("DELETE");
    $request->putPathParameter("ClusterId",$clusterId);
    $response = $client->doAction($request);
    print_r($response);
}

function describeClusterInfo($client,$clusterId){
    $request = new Cs\DescribeClusterDetailRequest();
    $request->setMethod("GET");
    $request->putPathParameter("ClusterId",$clusterId);
    $response = $client->doAction($request);
    print_r($response);
}

function describeClusterCerts($client,$clusterId){
    $request = new Cs\DescribeClusterCertsRequest();
    $request->setMethod("GET");
    $request->putPathParameter("ClusterId",$clusterId);
    $response = $client->doAction($request);
    print_r($response);
}

function describeApiVersion($client)
{
    $request = new Cs\DescribeApiVersionRequest();
    $request->setMethod("GET");
    $response = $client->doAction($request);
    print_r($response);
}


function describeClusters($client)
{
    $request = new Cs\DescribeClustersRequest();
    $request->setMethod("GET");
    $reponse = $client->doAction($request);
    print_r($reponse);
}