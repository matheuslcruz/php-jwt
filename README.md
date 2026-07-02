# JWT PHP

JWT signing and verification using PHP and Docker

Start compose:

```shell
docker-compose up -d
```

## Sign

```shell
token=$(curl -s -X POST -d @data.json localhost:8080/sign.php | jq -r .token)
```

## Verify

```shell
curl -s localhost:8080/verify.php?token=$token | jq
```

Output:

```json
{
  "data": {
    "username": "foo",
    "password": "bar"
  },
  "sub": "430e69a4f920a916a634b3d67c563c80",
  "aud": "172.20.0.1",
  "iss": "jwt.php",
  "exp": 1783015651
}
```
