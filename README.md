# JWT PHP

JWT signing and verification using PHP and Docker

Start compose:

    docker-compose up -d

## Signing

    curl -s -X POST -d '{"username":"matheus","password":123}' localhost:8080/sign.php | jq

Output:

    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1hdGhldXMiLCJwYXNzd29yZCI6MTIzLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODY1MDgzfQ.xhchYxQ08vPwD59EsKq20-J15XfTCU5aHRJfq_2dZiQ",
        "expires": 1574865083
    }


## Verifying

    curl -s localhost:8080/verify.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1hdGhldXMiLCJwYXNzd29yZCI6MTIzLCJpc3MiOiJqd3QucGhwIiwiZXhwIjoxNTc0ODY1MDgzfQ.xhchYxQ08vPwD59EsKq20-J15XfTCU5aHRJfq_2dZiQ | jq

Output:

    {
        "username": "matheus",
        "password": 123,
        "iss": "jwt.php",
        "exp": 1574865083
    }
