# JWT PHP

JWT signing and verification using PHP and Docker

Start compose:

    docker-compose up -d

## Sign

    curl -s -X POST -d '{"username":"matheus","password":123}' localhost:8080/sign.php | jq

Output:

    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI2NmNhYWRmOTg5MTBhMDRlZDc5NGMwN2Q4MzY0MTIwOCIsImF1ZCI6IjE3Mi4yMC4wLjEiLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODY2OTczfQ.lcdGtBXI4UDiQ7tHJ9XlYLdUxr7zQrPi7Rxo1kD8Xos",
        "expires": 1574866973
    }

## Verify

    curl -s localhost:8080/verify.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI2NmNhYWRmOTg5MTBhMDRlZDc5NGMwN2Q4MzY0MTIwOCIsImF1ZCI6IjE3Mi4yMC4wLjEiLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODY2OTczfQ.lcdGtBXI4UDiQ7tHJ9XlYLdUxr7zQrPi7Rxo1kD8Xos | jq

Output:

    {
        "sub": "66caadf98910a04ed794c07d83641208",
        "aud": "172.20.0.1",
        "iss": "jwt.php",
        "exp": 1574866973
    }
