# JWT PHP

JWT signing and verification using PHP and Docker

Start compose:

    docker-compose up -d

## Signing

    curl -X POST -d '{"username":"matheus","password":123}' localhost:8080/sign.php

Output:

    eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1hdGhldXMiLCJwYXNzd29yZCI6MTIzLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODYxNjYzfQ.keqkry0qFBagQKBtmitGseT8aNGztQELspMn_O0Cpb4

## Verifying

    curl localhost:8080/verify.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1hdGhldXMiLCJwYXNzd29yZCI6MTIzLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODYxNjYzfQ.keqkry0qFBagQKBtmitGseT8aNGztQELspMn_O0Cpb4

Output:
    
    {"username":"matheus","password":123,"iss":"jwt.php","exp":1574861663}
