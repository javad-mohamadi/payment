=============================== Payment Service ===============================

    php version 8.2, mysql version 8.0.32, composer version 2.4

- run this project with docker
    - clone project from git
    - run "make app_build"

    - Login api:
      /api/v1/login
    - request:
      {
      "mobile":"09359341940",
      "password":"1368",
      "grant_type":"password"
      }

    - payment transfer api
    - /api/v1/payments/transfer
    - request:
      {
      "source_card_number": "6063731133424250",
      "dest_card_number": "5022291085189544",
      "amount": "۱۰۰۰۰۰",
      "cvv2":"8994",
      "password": "123456"
      }
  
    - get transaction api
    - /api/v1/backoffice/transactions
