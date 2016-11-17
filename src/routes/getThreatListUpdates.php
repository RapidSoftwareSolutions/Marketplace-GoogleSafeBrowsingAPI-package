<?php

$app->post('/api/GoogleSafeBrowsingAPI/getThreatListUpdates', function ($request, $response, $args) {
    $settings =  $this->settings;
    
    $data = $request->getBody();

    if($data=='') {
        $post_data = $request->getParsedBody();
    } else {
        $toJson = $this->toJson;
        $data = $toJson->normalizeJson($data); 
        $data = str_replace('\"', '"', $data);
        $post_data = json_decode($data, true);
    }
    
    if(json_last_error() != 0) {
        $error[] = json_last_error_msg() . '. Incorrect input JSON. Please, check fields with JSON input.';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
        $result['contextWrites']['to']['status_msg'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $error = [];
    if(empty($post_data['args']['apiKey'])) {
        $error[] = 'apiKey';
    }
    if(empty($post_data['args']['clientId'])) {
        $error[] = 'clientId';
    }
    if(empty($post_data['args']['clientVersion'])) {
        $error[] = 'clientVersion';
    }
    if(empty($post_data['args']['threatType'])) {
        $error[] = 'threatType';
    }
    if(empty($post_data['args']['platformType'])) {
        $error[] = 'platformType';
    }
    if(empty($post_data['args']['threatEntryType'])) {
        $error[] = 'threatEntryType';
    }
    if(empty($post_data['args']['state'])) {
        $error[] = 'state';
    }
    if(empty($post_data['args']['maxUpdateEntries'])) {
        $error[] = 'maxUpdateEntries';
    }
    if(empty($post_data['args']['maxDatabaseEntries'])) {
        $error[] = 'maxDatabaseEntries';
    }
    if(empty($post_data['args']['region'])) {
        $error[] = 'region';
    }
    if(empty($post_data['args']['supportedCompressions'])) {
        $error[] = 'supportedCompressions';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $query_str = 'https://safebrowsing.googleapis.com/v4/threatListUpdates:fetch?key='.$post_data['args']['apiKey'];
    
    $client = $this->httpClient;
    
    $headers['Content-Type'] = 'application/json';
    
    $body['client']['clientId'] = $post_data['args']['clientId'];
    $body['client']['clientVersion'] = $post_data['args']['clientVersion'];
    $body['listUpdateRequests']['threatType'] = $post_data['args']['threatType'];
    $body['listUpdateRequests']['platformType'] = $post_data['args']['platformType'];
    $body['listUpdateRequests']['threatEntryType'] = $post_data['args']['threatEntryType'];
    $body['listUpdateRequests']['state'] = $post_data['args']['state'];
    $body['listUpdateRequests']['constraints']['maxUpdateEntries'] = $post_data['args']['maxUpdateEntries'];
    $body['listUpdateRequests']['constraints']['maxDatabaseEntries'] = $post_data['args']['maxDatabaseEntries'];
    $body['listUpdateRequests']['constraints']['region'] = $post_data['args']['region'];
    $body['listUpdateRequests']['constraints']['supportedCompressions'] = $post_data['args']['supportedCompressions'];
    
    try {

         $resp = $client->post( $query_str, 
            [
                'headers' => $headers,
                'json' => $body
            ]);
        $responseBody = $resp->getBody()->getContents();
  
        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to'] = "empty list";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }
    
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
