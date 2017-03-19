FORMAT: 1A

# My IO API

# Links

## Return all links created by the
authenticated user. [GET /]
Status codes:
200 - OK
204 - No Content

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 10,
                    "username": "foo"
                }
            }

## Store a newly created resource in storage. [POST /]
Status codes:
200 - OK
204 - No Content
400 - Bad Request

+ Request (application/json)
    + Body

            {
                "url": "https://www.google.com",
                "urls[]": "https://yahoo.com"
            }

+ Request (application/json)
    + Body

            {
                "url": "https://www.google.com"
            }

+ Response 201 (application/json)
    + Body

            {
                "id": 10,
                "url": "https://www.google.com",
                "hash": "8928129"
            }

+ Response 400 (application/json)
    + Body

            {
                "error": "Missing required parameters url or urls"
            }

## Return one single link [GET /]
Status codes:
200 - OK
404 - Not found

+ Parameters
    + id: (integer, required) - The id of the url to retrieve
        + Default: 1

+ Request (application/json)
    + Body

            {
                "id": "10"
            }

+ Response 201 (application/json)
    + Body

            {
                "id": 10,
                "url": "https://www.google.com",
                "hash": "8928129"
            }

+ Response 404 (application/json)
    + Body

            {
                "error": "Not found"
            }

## Remove the specified resource from storage. [DELETE /]
Status codes:
200 - OK
204 - No Content

+ Parameters
    + id: (integer, required) - The id of the url to delete
        + Default: 1

+ Response 200 (application/json)
    + Body

            {
                "message": "OK"
            }

# Statistics
Return requested Link statistics.

## Return all hits for a given link. [GET /]
Status codes:
200 - OK
204 - No Content

+ Parameters
    + id: (integer, required) - The id of the link to retrieve statistics for
        + Default: 1

+ Request (application/json)
    + Body

            {
                "id": "10"
            }

+ Response 200 (application/json)
    + Body

            {
                "hits": {
                    "id": 10,
                    "ip": "12.0.0.1",
                    "user_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
                }
            }

+ Response 204 (application/json)
    + Body

            {
                "message": "No content"
            }