[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GoogleSafeBrowsingAPI/functions?utm_source=RapidAPIGitHub_GoogleSafeBrowseFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# GoogleSafeBrowsingAPI Package
Identify unsafe websites and notifies users.
* Domain: google.com
* Credentials: apiKey

## How to get credentials: 
0. Go to [Google Developers Console](https://console.developers.google.com/?authuser=1);
1. Select a project, or create a new one.
2. Press **Continue** to activate API key.
3. In the sidebar on the left, select **Credentials**.
4. If your project has no API key for the server, create it now - **Add credentials > API key > Server key**;

 
## GoogleSafeBrowsingAPI.checkSingleUrlSafety
This endpoint allows to check if URL are included on any of the Safe Browsing lists. If a URL is found on one or more lists, the matching information is returned.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Required: API key obtained from Google.
| clientId        | String     | Required: A client ID that (hopefully) uniquely identifies the client implementation of the Safe Browsing API.
| clientVersion   | String     | Required: The version of the client implementation.
| threatTypes     | JSON       | Required: Json array of the threats.
| platformTypes   | JSON       | Required: Json array of the platforms types.
| threatEntry     | String     | Required: The URL to be checked.
### threatTypes format 
```json
["MALWARE", "SOCIAL_ENGINEERING"]
```
### platformTypes format 
```json
["WINDOWS"]
```

## GoogleSafeBrowsingAPI.checkUrlsSafety
This endpoint allows to check if URLs are included on any of the Safe Browsing lists. If a URL is found on one or more lists, the matching information is returned.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Required: API key obtained from Google.
| clientId        | String     | Required: A client ID that (hopefully) uniquely identifies the client implementation of the Safe Browsing API.
| clientVersion   | String     | Required: The version of the client implementation.
| threatTypes     | JSON       | Required: Json array of the threats.
| platformTypes   | JSON       | Required: Json array of the platforms types.
| threatEntryTypes| JSON       | Required: Json array of the threat entries types.
| threatEntries   | JSON       | Required: Json array of objects. The threats entries.
### threatTypes format 
```json
["MALWARE", "SOCIAL_ENGINEERING"]
```
### platformTypes format 
```json
["WINDOWS"]
```
### threatEntryTypes format 
```json
["URL"]
```
### threatEntries format 
```json
[
    {"url": "http://www.urltocheck1.org/"},
    {"url": "http://www.urltocheck2.org/"},
    {"url": "http://www.urltocheck3.com/"}
]
```

## GoogleSafeBrowsingAPI.getThreatLists
This endpoint allows to retrieve the names of the Safe Browsing lists

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Required: API key obtained from Google.

## GoogleSafeBrowsingAPI.getThreatListUpdates
This endpoint allows to update the Safe Browsing lists in the local database

| Field                | Type       | Description
|----------------------|------------|----------
| apiKey               | credentials| Required: API key obtained from Google.
| clientId             | String     | Required: A client ID that (hopefully) uniquely identifies the client implementation of the Safe Browsing API.
| clientVersion        | String     | Required: The version of the client implementation.
| threatType           | String     | Required: The type of the threat.
| platformType         | String     | Required: The type of the platform.
| threatEntryType      | String     | Required: The type of the threat entry.
| state                | String     | Required: The current state of the client for the requested list (the encrypted client state that was received from the last successful list update).
| maxUpdateEntries     | String     | Required: The maximum size in number of entries. The update will not contain more entries than this value. This should be a power of 2 between 2**10 and 2**20. If zero, no update size limit is set.
| maxDatabaseEntries   | String     | Required: Sets the maximum number of entries that the client is willing to have in the local database. This should be a power of 2 between 2**10 and 2**20. If zero, no database size limit is set.
| region               | String     | Required: Requests the list for a specific geographic location. If not set the server may pick that value based on the user's IP address. Expects ISO 3166-1 alpha-2 format.
| supportedCompressions| JSON       | Required: Json array. The compression types supported by the client.
### supportedCompressions format 
```json
["RAW"]
```

## GoogleSafeBrowsingAPI.checkSafetyByHashs
This endpoint allows to check if a URL is on a Safe Browsing list, the client must first compute the hash and hash prefix of the URL

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Required: API key obtained from Google.
| clientId        | String     | Required: A client ID that (hopefully) uniquely identifies the client implementation of the Safe Browsing API.
| clientVersion   | String     | Required: The version of the client implementation.
| clientStates    | JSON       | Required: Json array. The current client states for each of the client's local threat lists.
| threatTypes     | JSON       | Required: Json array. The threat types to be checked.
| platformTypes   | JSON       | Required: Json array. The platform types to be checked.
| threatEntryTypes| JSON       | Required: Json array. The entry types to be checked.
| threatEntries   | JSON       | Required: Json array of objects. The threat entries to be checked.
### clientStates format 
```json
[
    "ChAIARABGAEiAzAwMSiAEDABEAE=",
    "ChAIAhABGAEiAzAwMSiAEDABEOgH"
]
```
### threatTypes format 
```json
["MALWARE", "SOCIAL_ENGINEERING"]
```
### platformTypes format 
```json
["WINDOWS"]
```
### threatEntryTypes format 
```json
["URL"]
```
### threatEntries format 
```json
[
    {"hash": "WwuJdQ=="},
    {"hash": "771MOg=="},
    {"hash": "5eOrwQ=="}
]
```
