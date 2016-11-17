<?php

namespace Test\Functional;

class GoogleSafeBrowsingAPITest extends BaseTestCase {
    
    public function testCheckUrlsSafety() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AIzaSyC4ceX-7CeLUrGJHSXBqoNwFy0LW8IHaBw",
                        "clientId":"TestCompany",
                        "clientVersion":"1",
                        "threatTypes":["MALWARE", "SOCIAL_ENGINEERING"],
                        "platformTypes":["WINDOWS"],
                        "threatEntryTypes":["URL"],
                        "threatEntries":[         {"url": "http://www.urltocheck1.org/"},         {"url": "http://www.urltocheck2.org/"},         {"url": "http://www.urltocheck3.com/"}       ]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/GoogleSafeBrowsingAPI/checkUrlsSafety', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testGetThreatLists() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AIzaSyC4ceX-7CeLUrGJHSXBqoNwFy0LW8IHaBw"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/GoogleSafeBrowsingAPI/getThreatLists', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testGetThreatListUpdates() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AIzaSyC4ceX-7CeLUrGJHSXBqoNwFy0LW8IHaBw",
                        "clientId":"TestCompany",
                        "clientVersion":"1",
                        "threatType":"MALWARE",
                        "platformType":"WINDOWS",
                        "threatEntryType":"URL",
                        "state":"Gg4IBBADIgYQgBAiAQEoAQ==",
                        "maxUpdateEntries":"2048",
                        "maxDatabaseEntries":"4096",
                        "region":"US",
                        "supportedCompressions":["RAW"]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/GoogleSafeBrowsingAPI/getThreatListUpdates', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
    public function testCheckSafetyByHashs() {
        
        $var = '{  
                    "args":{  
                        "apiKey":"AIzaSyC4ceX-7CeLUrGJHSXBqoNwFy0LW8IHaBw",
                        "clientId":"TestCompany",
                        "clientVersion":"1",
                        "clientStates":[     "ChAIARABGAEiAzAwMSiAEDABEAE=",     "ChAIAhABGAEiAzAwMSiAEDABEOgH"   ],
                        "threatTypes":["MALWARE", "SOCIAL_ENGINEERING"],
                        "platformTypes":["WINDOWS"],
                        "threatEntryTypes":["URL"],
                        "threatEntries":[       {"hash": "WwuJdQ=="},       {"hash": "771MOg=="},       {"hash": "5eOrwQ=="}     ]
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/GoogleSafeBrowsingAPI/checkSafetyByHashs', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
}
