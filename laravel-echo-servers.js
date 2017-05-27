var echo = require('laravel-echo-server/dist');

echo.run({
	"appKey": "p9toimn5fkqgc21qt0tcjqsgp25qh9o3peg9ai2gkrs55q8m218r98phlhiq",
    "authEndpoint": "/broadcasting/auth",
    "authHost": "http://localhost:8000",
    "database": "redis",
    "databaseConfig": {
        "redis": {"host": "localhost"},
        "sqlite": {
            "databasePath": "/database/laravel-echo-server.sqlite"
        }
    },
    "devMode": false,
    "host": "localhost",
    "port": "6001",
    "protocol": "http",
    "referrers": [],
    "sslCertPath": "",
    "sslKeyPath": "",
    "verifyAuthPath": true,
    "verifyAuthServer": false
});