define({ "api": [
  {
    "description": "<p>Logout the user from current device</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/logout",
    "title": "Logout",
    "group": "Auth",
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"Logged out from the account.\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "GetApiV1Logout",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/login",
    "title": "Login",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>Unique ID of the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_type",
            "description": "<p>Type of the device <code>APPLE</code> or <code>ANDROID</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "device_push_token",
            "description": "<p>Unique push token for the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"uuid\": \"b86e43f4-8a82-4ef6-a059-0f836968e574\",\n        \"last_name\": null,\n        \"email\": \"apps+suadmin@elegantmedia.com.au\",\n        \"email_verified_at\": null,\n        \"avatar_url\": null,\n        \"timezone\": \"Australia\\/Melbourne\",\n        \"first_name\": \"Tony Stark (SUPER-ADMIN)\",\n        \"full_name\": \"Tony Stark (SUPER-ADMIN)\",\n        \"access_token\": \"16564697658JWLDvsUjp6emwofDcjOhyvYXHzer9ITWW9\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1Login"
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/password/edit",
    "title": "Update Password",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "current_password",
            "description": "<p>Current password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Password confirmation</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": \"\",\n    \"message\": \"Password successfully updated.\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1PasswordEdit",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>This endpoint registers a user.If you need to update a profile image, upload the profile image in thebackground using <code>/avatar</code> endpoint.</p>",
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/register",
    "title": "Register",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_id",
            "description": "<p>Unique ID of the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "device_type",
            "description": "<p>Type of the device <code>APPLE</code> or <code>ANDROID</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "device_push_token",
            "description": "<p>Unique push token for the device</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email address of user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password. Must be at least 8 characters.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Confirm password. Must be at least 8 characters.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"email\": \"vconroy@example.net\",\n        \"uuid\": \"abfe791b-fe2f-4d2d-b25d-819cedce41c7\",\n        \"first_name\": null,\n        \"full_name\": \"\",\n        \"access_token\": \"1656469765HWbZYFGtj3bq3omTEFEqigyASo07ywGviaT\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n\"message\": \"The email must be a valid email address.\",\n\"payload\": {\n\"errors\": {\n\"email\": [\n\"The email must be a valid email address.\"\n]\n}\n},\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1Register"
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/resend-code",
    "title": "Resend Verification Code",
    "group": "Auth",
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"A verification code has been sent to your email. Test environment code is always 0\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1ResendCode",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/verify-email/{code}",
    "title": "Email Verification",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "code",
            "description": "<p>Verification Code</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n    \"message\": \"Invalid verification code, Resend and try again\",\n    \"payload\": null,\n    \"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1VerifyEmailCode",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Use this endpoint to upload all files, including player images. You must use the <code>uuid</code> that gets returned, and use it to attach the file to other objects.</p>",
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/files",
    "title": "Upload files",
    "group": "FilesAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "file",
            "description": "<p>Image file to upload. Upload as a form field.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"key\": \"file_key_f488eb9a-6ed9-4cf3-b32b-2f9c5f91bda4\",\n        \"original_filename\": \"image.jpg\",\n        \"file_url\": \"\\/storage\\/files\\/202206\\/tcfMxPDOGjc9Mve.jpg\",\n        \"uuid\": \"ea39f5a0-0118-45f6-b0e9-cb18d876f680\",\n        \"permalink\": \"http:\\/\\/boost.test\\/files\\/ea39f5a0-0118-45f6-b0e9-cb18d876f680\\/image.jpg\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/files_a_p_i.coffee",
    "groupTitle": "FilesAPI",
    "name": "PostApiV1Files",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/password/email",
    "title": "Reset Password",
    "group": "ForgotPassword",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": \"\",\n    \"message\": \"A password reset email will be sent to you in a moment.\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n\"message\": \"Failed to send password reset email. Ensure your email is correct and try again.\",\n\"payload\": null,\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/forgot_password.coffee",
    "groupTitle": "ForgotPassword",
    "name": "PostApiV1PasswordEmail"
  },
  {
    "version": "1.0.0",
    "type": "DELETE",
    "url": "api/v1/games/{uuid}",
    "title": "Delete Game",
    "group": "GamesAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>uuid of the Game to delete</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/games_a_p_i.coffee",
    "groupTitle": "GamesAPI",
    "name": "DeleteApiV1GamesUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Get a list of games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/games",
    "title": "List Games",
    "group": "GamesAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "period",
            "description": "<p>Period can be <code>past</code>, <code>future</code>, <code>from_today</code>. The default is <code>from_today</code>.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "order",
            "description": "<p>Order can be <code>asc</code>, <code>desc</code>. The default is <code>asc</code>.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"current_page\": 1,\n        \"data\": [\n            {\n                \"id\": 9,\n                \"uuid\": \"22505ec1-c751-466b-8645-d76a0580f3c8\",\n                \"owner_id\": 1,\n                \"season_id\": 1,\n                \"team_a_id\": 2,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 8\",\n                \"played_at\": \"2022-06-29T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 2,\n                    \"uuid\": \"64be0c03-093c-4f60-9d9f-7d8e86c1671f\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team B\",\n                    \"team_number\": \"9hEtz\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 1,\n                    \"uuid\": \"378a3d3c-2823-4b14-90cd-b14f15533c22\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 4,\n                \"uuid\": \"dd777ef9-410e-4824-b4fa-5afb9569bddd\",\n                \"owner_id\": 1,\n                \"season_id\": 4,\n                \"team_a_id\": 3,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 3\",\n                \"played_at\": \"2022-06-30T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 3,\n                    \"uuid\": \"510bf243-5320-4c85-949c-3df68519f2a0\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 12,\n                    \"name\": \"Team C\",\n                    \"team_number\": \"LfLkN\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Error labore voluptate laboriosam voluptatem.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 4,\n                    \"uuid\": \"12f8a2ad-2b7b-40a4-b3f0-654847b46e70\",\n                    \"name\": \"Summer 2023\"\n                }\n            },\n            {\n                \"id\": 3,\n                \"uuid\": \"a95fc420-5e24-4084-b59b-0c541d3740b7\",\n                \"owner_id\": 1,\n                \"season_id\": 2,\n                \"team_a_id\": 1,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 2\",\n                \"played_at\": \"2022-07-04T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 1,\n                    \"uuid\": \"b24c645d-f139-4816-9564-0b7118e7bae4\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team A\",\n                    \"team_number\": \"G2H9K\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Sapiente placeat ut non tempora omnis commodi.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 2,\n                    \"uuid\": \"6257ded3-05c6-44e8-a655-09a0d76d86f2\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 1,\n                \"uuid\": \"d1c7ab80-d185-4b41-ba17-320bb4dee879\",\n                \"owner_id\": 1,\n                \"season_id\": 1,\n                \"team_a_id\": 3,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 0\",\n                \"played_at\": \"2022-07-13T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 3,\n                    \"uuid\": \"510bf243-5320-4c85-949c-3df68519f2a0\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 12,\n                    \"name\": \"Team C\",\n                    \"team_number\": \"LfLkN\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Error labore voluptate laboriosam voluptatem.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 1,\n                    \"uuid\": \"378a3d3c-2823-4b14-90cd-b14f15533c22\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 2,\n                \"uuid\": \"39396b3b-8757-43c3-a299-c686529c2d44\",\n                \"owner_id\": 1,\n                \"season_id\": 1,\n                \"team_a_id\": 1,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 1\",\n                \"played_at\": \"2022-07-26T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 1,\n                    \"uuid\": \"b24c645d-f139-4816-9564-0b7118e7bae4\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team A\",\n                    \"team_number\": \"G2H9K\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Sapiente placeat ut non tempora omnis commodi.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 1,\n                    \"uuid\": \"378a3d3c-2823-4b14-90cd-b14f15533c22\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 7,\n                \"uuid\": \"f17ffb40-5f69-43fd-9ee1-071f2a45062c\",\n                \"owner_id\": 1,\n                \"season_id\": 2,\n                \"team_a_id\": 3,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 6\",\n                \"played_at\": \"2022-08-04T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 3,\n                    \"uuid\": \"510bf243-5320-4c85-949c-3df68519f2a0\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 12,\n                    \"name\": \"Team C\",\n                    \"team_number\": \"LfLkN\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Error labore voluptate laboriosam voluptatem.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 2,\n                    \"uuid\": \"6257ded3-05c6-44e8-a655-09a0d76d86f2\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 10,\n                \"uuid\": \"0a0cb357-9aa6-49a6-86dc-00b6846dd6a6\",\n                \"owner_id\": 1,\n                \"season_id\": 2,\n                \"team_a_id\": 1,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 9\",\n                \"played_at\": \"2022-08-04T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 1,\n                    \"uuid\": \"b24c645d-f139-4816-9564-0b7118e7bae4\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team A\",\n                    \"team_number\": \"G2H9K\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Sapiente placeat ut non tempora omnis commodi.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 2,\n                    \"uuid\": \"6257ded3-05c6-44e8-a655-09a0d76d86f2\",\n                    \"name\": \"Summer 2021\"\n                }\n            },\n            {\n                \"id\": 6,\n                \"uuid\": \"79396619-e7dd-483c-81e1-8548bc996cdb\",\n                \"owner_id\": 1,\n                \"season_id\": 3,\n                \"team_a_id\": 2,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 5\",\n                \"played_at\": \"2022-09-01T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 2,\n                    \"uuid\": \"64be0c03-093c-4f60-9d9f-7d8e86c1671f\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team B\",\n                    \"team_number\": \"9hEtz\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 3,\n                    \"uuid\": \"f483af34-378e-41c7-92dd-d67ad640bded\",\n                    \"name\": \"Winter 2022\"\n                }\n            },\n            {\n                \"id\": 5,\n                \"uuid\": \"272268c8-1035-486a-bc39-2a8503678314\",\n                \"owner_id\": 1,\n                \"season_id\": 3,\n                \"team_a_id\": 3,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 4\",\n                \"played_at\": \"2022-09-08T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 3,\n                    \"uuid\": \"510bf243-5320-4c85-949c-3df68519f2a0\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 12,\n                    \"name\": \"Team C\",\n                    \"team_number\": \"LfLkN\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Error labore voluptate laboriosam voluptatem.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 3,\n                    \"uuid\": \"f483af34-378e-41c7-92dd-d67ad640bded\",\n                    \"name\": \"Winter 2022\"\n                }\n            },\n            {\n                \"id\": 8,\n                \"uuid\": \"1e78b8ad-ab1d-47e5-8aff-8073e5c76b39\",\n                \"owner_id\": 1,\n                \"season_id\": 1,\n                \"team_a_id\": 2,\n                \"team_b_id\": null,\n                \"team_b_name\": null,\n                \"tournament_name\": \"Tournament 7\",\n                \"played_at\": \"2022-09-09T01:56:17.000000Z\",\n                \"location\": null,\n                \"team_a_image_uuid\": null,\n                \"team_b_image_uuid\": null,\n                \"team_a\": {\n                    \"id\": 2,\n                    \"uuid\": \"64be0c03-093c-4f60-9d9f-7d8e86c1671f\",\n                    \"owner_id\": 1,\n                    \"image_uuid\": null,\n                    \"player_count\": 14,\n                    \"name\": \"Team B\",\n                    \"team_number\": \"9hEtz\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.\",\n                    \"image\": null\n                },\n                \"season\": {\n                    \"id\": 1,\n                    \"uuid\": \"378a3d3c-2823-4b14-90cd-b14f15533c22\",\n                    \"name\": \"Summer 2021\"\n                }\n            }\n        ],\n        \"first_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games?page=1\",\n        \"from\": 1,\n        \"last_page\": 1,\n        \"last_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games?page=1\",\n        \"links\": [\n            {\n                \"url\": null,\n                \"label\": \"&laquo; Previous\",\n                \"active\": false\n            },\n            {\n                \"url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games?page=1\",\n                \"label\": \"1\",\n                \"active\": true\n            },\n            {\n                \"url\": null,\n                \"label\": \"Next &raquo;\",\n                \"active\": false\n            }\n        ],\n        \"next_page_url\": null,\n        \"path\": \"http:\\/\\/boost.test\\/api\\/v1\\/games\",\n        \"per_page\": 50,\n        \"prev_page_url\": null,\n        \"to\": 10,\n        \"total\": 10\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/games_a_p_i.coffee",
    "groupTitle": "GamesAPI",
    "name": "GetApiV1Games",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/games",
    "title": "Create Game",
    "group": "GamesAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tournament_name",
            "description": "<p>Tournament name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "played_at",
            "description": "<p>2022-07-01T13</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "location",
            "description": "<p>&quot;The Palace&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "season_id",
            "description": "<p>Season ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "team_a_id",
            "description": "<p>Team A ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_a_image_uuid",
            "description": "<p>UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_b_image_uuid",
            "description": "<p>UUID for the team B profile picture. Get a UUID from file upload endpoint.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "team_b_name",
            "description": "<p>String</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"tournament_name\": \"Et molestiae et dignissimos blanditiis.\",\n        \"played_at\": \"2022-06-29T02:29:26.000000Z\",\n        \"location\": \"68C Brett Corner\\nNew Sebastian, VIC 2681\",\n        \"season_id\": 4,\n        \"team_b_name\": \"Team B\",\n        \"uuid\": \"7475212a-c5f4-4fd4-a38b-dc7352e7dbaa\",\n        \"id\": 29,\n        \"owner_id\": \"1\",\n        \"owner\": {\n            \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n            \"last_name\": null,\n            \"email\": \"apps+user@elegantmedia.com.au\",\n            \"email_verified_at\": null,\n            \"avatar_url\": null,\n            \"timezone\": \"Australia\\/Melbourne\",\n            \"first_name\": \"Peter Parker (REGULAR USER)\",\n            \"full_name\": \"Peter Parker (REGULAR USER)\"\n        }\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/games_a_p_i.coffee",
    "groupTitle": "GamesAPI",
    "name": "PostApiV1Games",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "PUT",
    "url": "api/v1/games/{uuid}",
    "title": "Update Game",
    "group": "GamesAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>Game UUID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tournament_name",
            "description": "<p>Tournament name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "played_at",
            "description": "<p>2022-07-01T13</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "location",
            "description": "<p>&quot;The Palace&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "season_id",
            "description": "<p>Season ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "team_a_id",
            "description": "<p>Team A ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_a_image_uuid",
            "description": "<p>UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_b_image_uuid",
            "description": "<p>UUID for the team B profile picture. Get a UUID from file upload endpoint.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "team_b_name",
            "description": "<p>String</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"tournament_name\": \"Incidunt maxime earum porro culpa minima cum officiis nisi.\",\n        \"played_at\": \"2022-06-29T02:29:26.000000Z\",\n        \"location\": \"Unit 44 2 Towne Amble\\nNew Conradside, WA 2830\",\n        \"season_id\": 4,\n        \"team_b_name\": \"Team B\",\n        \"uuid\": \"dbf6c319-45d5-4a95-936e-dbbb45e1c296\",\n        \"id\": 30\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/games_a_p_i.coffee",
    "groupTitle": "GamesAPI",
    "name": "PutApiV1GamesUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Guest settings and parameters</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/guests",
    "title": "Guest Settings",
    "group": "Guest",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"privacy_policy_url\": null,\n        \"terms_conditions_url\": null,\n        \"about_us_url\": null,\n        \"about_us\": \"About Us\\n\\n\",\n        \"privacy_policy\": \"PRIVACY POLICY\\n\\n1.\\tWe respect your privacy\\n \\t1.1.  Boost App (the \\\"Application\\\") respects your right to privacy and is committed to safeguarding the privacy of our customers and software application users. We adhere to the National Privacy Principles established by the Privacy Act 1988 (Cth). This policy sets out how we collect and treat your personal information.\\n \\t1.2.  \\\"Personal information\\\" is information we hold which is identifiable as being about you.\\n2.\\tCollection of personal information\\n \\t2.1.  The Application will, from time to time, receive and store personal information you enter onto our software, provide to us directly or give to us in other forms.\\n \\t2.2.  You may provide basic information such as your name, phone number, address and email address to enable us to send information, provide updates and process your product or service order. We may collect additional information at other times, including but not limited to, when you provide feedback, when you provide information about your personal or business affairs, change your content or email preference, respond to surveys and\\/or promotions, provide financial or credit card information, or communicate with our customer support.\\n \\t2.3.  Additionally, we may also collect any other information you provide while interacting with us.\\n3.\\tHow we collect your personal information\\n \\t3.1.  The Application collects personal information from you in a variety of ways, including when you interact with us electronically or in person, when you access our software application and when we provide our services to you. We may receive personal information from third parties. If we do, we will protect it as set out in this Privacy Policy.\\n4.\\tUse of your personal information\\n \\t4.1.  The Application may use personal information collected from you to provide you with information, updates and our services. We may also make you aware of new and additional products, services and opportunities available to you. We may use your personal information to improve our products and services and better understand your needs.\\n \\t4.2.  The Application may make third party social media features available to its users. We cannot ensure the security of any information you choose to make public in a social media feature. Also, we cannot ensure that parties who have access to such publicly available information will respect your privacy.\\n \\tThe Application may contact you by a variety of measures including, but not limited to telephone, email, sms or mail.\\n5.\\tDisclosure of your personal information\\n \\t5.1.  We may disclose your personal information to any of our employees, officers, insurers, professional advisers, agents, suppliers or subcontractors insofar as reasonably necessary for the purposes set out in this Policy. Personal information is only supplied to a third party when it is required for the delivery of our services.\\n \\t5.2.  We may from time to time need to disclose personal information to comply with a legal requirement, such as a law, regulation, court order, subpoena, warrant, in the course of a legal proceeding or in response to a law enforcement agency request.\\n \\t5.3.  We may also use your personal information to protect the copyright, trademarks, legal rights, property or safety of the Application, its application, website and customers or third parties.\\n \\t5.4.  Information that we collect may from time to time be stored, processed in or transferred between parties located in countries outside of Australia.\\n \\t5.5.  If there is a change of control in our business or a sale or transfer of business assets, we reserve the right to transfer to the extent permissible at law our user databases, together with any personal information and non-personal information contained in those databases. This information may be disclosed to a potential purchaser under an agreement to maintain confidentiality. We would seek to only disclose information in good faith and where required by any of the above circumstances.\\n \\t5.6.  By providing us with personal information, you consent to the terms of this Privacy Policy and the types of disclosure covered by this Policy. Where we disclose your personal information to third parties, we will request that the third party follow this Policy regarding handling your personal information.\\n6.\\tSecurity of your personal information\\n \\t6.1.  The Application is committed to ensuring that the information you provide to us is secure. In order to prevent unauthorised access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure information and protect it from misuse, interference, loss and unauthorised access, modification and disclosure.\\n \\t6.2.  The transmission and exchange of information is carried out at your own risk. We cannot guarantee the security of any information that you transmit to us, or receive from us. Although we take measures to safeguard against unauthorised disclosures of information, we cannot assure you that personal information that we collect will not be disclosed in a manner that is inconsistent with this Privacy Policy.\\n7.\\tAccess to your personal information\\n \\t7.1.  You may request details of personal information that we hold about you in accordance with the provisions of the Privacy Act 1988(Cth). A small administrative fee may be payable for the provision of information. If you would like a copy of the information which we hold about you or believe that any information we hold on you is inaccurate, out of date, incomplete, irrelevant or misleading, please email us at ifediorachris@gmail.com.\\n \\t7.2.  We reserve the right to refuse to provide you with information that we hold about you, in certain circumstances set out in the Privacy Act.\\n8.\\tComplaints about privacy\\n \\t8.1.  If you have any complaints about our privacy practices, please feel free to send in details of your complaints to 35 Newport Drive, Robina , Queensland, 4226. We take complaints very seriously and will respond shortly after receiving written notice of your complaint.\\n9.\\tOp out right\\n \\t9.1.  You can stop all collection of information by the Application easily by uninstalling the Application. You may use the standard uninstall processes as may be available as part of your mobile device or via the mobile application marketplace or network. You can also request to opt-out via the Contact methods provided on the Application or our website.\\n10.\\tChanges to Privacy Policy\\n \\t10.1.  Please be aware that we may change this Privacy Policy in the future. We may modify this Policy at any time, in our sole discretion and all modifications will be effective immediately upon our posting of the modifications on our website or notice board. Please check back from time to time to review our Privacy Policy.\\n11.\\tSoftware Application\\n \\t11.1. When you use our Application\\n \\tWhen you come to our application we may collect certain information such as mobile unique device ID, the IP address of your mobile device, mobile operating system, the type of mobile internet browsers you use, and information about the way you use the Application. This information is used in an aggregated manner to analyse how people use our site, such that we can improve our service.\\n \\t11.2. Cookies\\n \\tWe may from time to time use cookies on our software application. Cookies are very small files which a website uses to identify you when you come back to the application and to store details about your use of the application. Cookies are not malicious programs that access or damage your computer, tablet or smartphone. Most devices automatically accept cookies but you can choose to reject cookies by changing your devise settings. However, this may prevent you from taking full advantage of our application.\\n \\t11.3. Automatic collection\\n \\tThe software Application may collect certain information automatically, including, but not limited to, the type of mobile device you use, your mobile devices unique device ID, the IP address of your mobile device, your mobile operating system, the type of mobile Internet browsers you use, and information about the way you use the Application.\\n \\t11.4. Third parties\\n \\tOur software application may from time to time have links to other applications or websites not owned or controlled by us. These links are meant for your convenience only. Links to third party applications and websites do not constitute sponsorship or endorsement or approval of these third parties. Please be aware that The Application is not responsible for the privacy practises of other such applications or websites. We encourage our users to be aware, when they leave our application or website, to read the privacy statements of each and every application or website that collects personal identifiable information.\\n \\t11.5. Geo-location\\n \\tWhen you visit the mobile application, we may use GPS technology (or other similar technology) to determine your current location in order to determine the city you are located within and display a location map with relevant advertisements. We will not share your current location with other users or partners.\\n\\n\\n\",\n        \"terms_and_conditions\": \"TERMS AND CONDITIONS OF USE\\n\\n1.\\tAbout the Application\\n1.1.\\tWelcome to Boost App (the 'Application'). The Application may provide data, information and electornic assets to users in various formats.  (the 'Services').\\n1.2.\\tBy using the Application and other related services, you agree to the following Terms and Conditions of Use. Please read these terms and conditions (the 'Terms') carefully. By using, browsing and\\/or reading the Application, this signifies that you have read, understood and agree to be bound by the Terms. If you do not agree with the Terms, you must cease usage of the Application, or any of its Services, immediately.\\n1.3.\\tWe reserves the right to review and change any of the Terms by updating this page at its sole discretion. When we updates the Terms, it will use reasonable endeavours to provide you with notice of updates to the Terms. Any changes to the Terms take immediate effect from the date of their publication. Before you continue, we recommend you keep a copy of the Terms for your records.\\n2.\\tAcceptance of the Terms\\n \\tYou accept the Terms by using or browsing the Application. You may also accept the Terms by clicking to accept or agree to the Terms where this option is made available to you by We in the user interface.\\n3.\\tRegistration to use the Services\\n3.1.\\tIn order to access the Services, you must first register for an account through the Application (the 'Account').\\n3.2.\\tAs part of the registration process, or as part of your continued use of the Services, you may be required to provide personal information about yourself (such as identification or contact details), including:\\n(a)\\tEmail address\\n(b)\\tPreferred username\\n(c)\\tTelephone number\\n(d)\\ta Password\\n3.3.\\tYou warrant that any information you give to us in the course of completing the registration process will always be accurate, correct and up to date.\\n3.4.\\tOnce you have completed the registration process, you will be a registered member of the Application ('Member') and agree to be bound by the Terms.\\n3.5.\\tYou may not use the Services and may not accept the Terms if:\\n(a)\\tyou are not 16 years old or in the High secondary school to form a binding contract with us; or\\n(b)\\tyou are a person barred from receiving the Services under the laws of Australia or other countries including the country in which you are resident or from which you use the Services.\\n4.\\tYour obligations as a Member\\n4.1.\\tAs a Member, you agree to comply with the following:\\n(a)\\tyou will use the Services only for purposes that are permitted by:\\ni.\\tthe Terms; and\\nii.\\tany applicable law, regulation or generally accepted practices or guidelines in the relevant jurisdictions;\\n(b)\\tyou have the sole responsibility for protecting the confidentiality of your password and\\/or email address. Use of your password by any other person may result in the immediate cancellation of the Services;\\n(c)\\tany use of your registration information by any other person, or third parties, is strictly prohibited. You agree to immediately notify us of any unauthorised use of your password or email address or any breach of security of which you have become aware;\\n(d)\\taccess and use of the Application is limited, non-transferable and allows for the sole use of the Application by you for the purposes of the Application providing the Services;\\n(e)\\tyou will not use the Services or the Application in connection with any commercial endeavours except those that are specifically endorsed or approved by the management of this Application;\\n(f)\\tyou will not use the Services or Application for any illegal and\\/or unauthorised use which includes collecting email addresses of Members by electronic or other means for the purpose of sending unsolicited email or unauthorised framing of or linking to the Application;\\n(g)\\tyou agree that commercial advertisements, affiliate links, and other forms of solicitation may be removed from the Application without notice and may result in termination of the Services. Appropriate legal action will be taken by We for any illegal or unauthorised use of the Application; and\\n(h)\\tyou acknowledge and agree that any automated use of the Application or its Services is prohibited.\\n5.\\tPayment\\n5.1.\\tWhere the option is given to you, you may make payment for the Services (the 'Services Fee') by way of:\\n5.2.\\tAll payments made in the course of your use of the Services are made using ....... In using the Application, the Services or when making any payment in relation to your use of the Services, you warrant that you have read, understood and agree to be bound by the ...... terms and conditions which are available on their Application.\\n5.3.\\tYou acknowledge and agree that where a request for the payment of the Services Fee is returned or denied, for whatever reason, by your financial institution or is unpaid by you for any other reason, then you are liable for any costs, including banking fees and charges, associated with the Services Fee.\\n5.4.\\tYou agree and acknowledge that We can vary the Services Fee at any time .\\n6.\\tRefund Policy\\n \\tWe will only provide you with a refund of the Services Fee in the event they are unable to continue to provide the Services or if the manager from our side makes a decision, at its absolute discretion, that it is reasonable to do so under the circumstances (the 'Refund').\\n7.\\tCopyright and Intellectual Property\\n7.1.\\tThe Application, the Services and all of the related products we offer are subject to copyright. The material on the Application is protected by copyright under the laws of Australia and through international treaties. Unless otherwise indicated, all rights (including copyright) in the Services and compilation of the Application (including but not limited to text, graphics, logos, button icons, video images, audio clips, Application, code, scripts, design elements and interactive features) or the Services are owned or controlled for these purposes, and are reserved by the Application or its contributors.\\n7.2.\\tAll trademarks, service marks and trade names are owned, registered and\\/or licensed by us, who grants to you a worldwide, non-exclusive, royalty-free, revocable license whilst you are a Member to:\\n(a)\\tuse the Application pursuant to the Terms;\\n(b)\\tcopy and store the Application and the material contained in the Application in your device's cache memory; and\\n(c)\\tprint pages from the Application for your own personal and non-commercial use.\\n \\tWe does not grant you any other rights whatsoever in relation to the Application or the Services. All other rights are expressly reserved by the Application.\\n7.3.\\tWe retains all rights, title and interest in and to the Application and all related Services. Nothing you do on or in relation to the Application will transfer any:\\n(a)\\tbusiness name, trading name, domain name, trade mark, industrial design, patent, registered design or copyright, or\\n(b)\\ta right to use or exploit a business name, trading name, domain name, trade mark or industrial design, or\\n(c)\\ta thing, system or process that is the subject of a patent, registered design or copyright (or an adaptation or modification of such a thing, system or process),\\n \\tto you.\\n7.4.\\tYou may not, without the prior written permission of us and the permission of any other relevant rights owners: broadcast, republish, up-load to a third party, transmit, post, distribute, show or play in public, adapt or change in any way the Services or third party Services for any purpose, unless otherwise provided by these Terms. This prohibition does not extend to materials on the Application, which are freely available for re-use or are in the public domain.\\n8.\\tPrivacy\\n \\tWe takes your privacy seriously and any information provided through your use of the Application and\\/or Services are subject to the Application's Privacy Policy, which is available on the Application.\\n9.\\tGeneral Disclaimer\\n9.1.\\tNothing in the Terms limits or excludes any guarantees, warranties, representations or conditions implied or imposed by law, including the Australian Consumer Law (or any liability under them) which by law may not be limited or excluded.\\n9.2.\\tSubject to this clause, and to the extent permitted by law:\\n(a)\\tall terms, guarantees, warranties, representations or conditions which are not expressly stated in the Terms are excluded; and\\n(b)\\tthe Application will not be liable for any special, indirect or consequential loss or damage (unless such loss or damage is reasonably foreseeable resulting from our failure to meet an applicable Consumer Guarantee), loss of profit or opportunity, or damage to goodwill arising out of or in connection with the Services or these Terms (including as a result of not being able to use the Services or the late supply of the Services), whether at common law, under contract, tort (including negligence), in equity, pursuant to statute or otherwise.\\n9.3.\\tUse of the Application and the Services is at your own risk. Everything on the Application and the Services is provided to you \\\"as is\\\" and \\\"as available\\\" without warranty or condition of any kind. None of the affiliates, directors, officers, employees, agents, contributors and licensors of the Application make any express or implied representation or warranty about the Services or any products or Services (including the products or Services of the Application) referred to on the Application. This includes (but is not restricted to) loss or damage you might suffer as a result of any of the following:\\n(a)\\tfailure of performance, error, omission, interruption, deletion, defect, failure to correct defects, delay in operation or transmission, computer virus or other harmful component, loss of data, communication line failure, unlawful third party conduct, or theft, destruction, alteration or unauthorised access to records;\\n(b)\\tthe accuracy, suitability or currency of any information on the Application, the Services, or any of its Services related products (including third party material and advertisements on the Application);\\n(c)\\tcosts incurred as a result of you using the Application, the Services or any of the products of the Application; and\\n(d)\\tthe Services or operation in respect to links which are provided for your convenience.\\n10.\\tCompetitors\\n \\tIf you are in the business of providing similar Services for the purpose of providing them to users for a commercial gain, whether business users or domestic users, then you are a competitor of the Application. Competitors are not permitted to use or access any information or content on our Application. If you breach this provision, the Application will hold you fully responsible for any loss that we may sustain and hold you accountable for all profits that you might make from such a breach.\\n11.\\tLimitation of liability\\n11.1.\\tthe Application's total liability arising out of or in connection with the Services or these Terms, however arising, including under contract, tort (including negligence), in equity, under statute or otherwise, will not exceed the resupply of the Services to you.\\n11.2.\\tYou expressly understand and agree that the Application, its affiliates, employees, agents, contributors and licensors shall not be liable to you for any direct, indirect, incidental, special consequential or exemplary damages which may be incurred by you, however caused and under any theory of liability. This shall include, but is not limited to, any loss of profit (whether incurred directly or indirectly), any loss of goodwill or business reputation and any other intangible loss.\\n12.\\tTermination of Contract\\n12.1.\\tThe Terms will continue to apply until terminated by either you or by the Application as set out below.\\n12.2.\\tIf you want to terminate the Terms, you may do so by:\\n12.3.\\tthe Application may at any time, terminate the Terms with you if:\\n(a)\\tyou have breached any provision of the Terms or intend to breach any provision;\\n(b)\\tthe Application is required to do so by law;\\n(c)\\tthe provision of the Services to you by the Application is, in the opinion of the Application, no longer commercially viable.\\n12.4.\\tSubject to local applicable laws, the Application reserves the right to discontinue or cancel your membership at any time and may suspend or deny, in its sole discretion, your access to all or any portion of the Application or the Services without notice if you breach any provision of the Terms or any applicable law or if your conduct impacts the Application's name or reputation or violates the rights of those of another party.\\n13.\\tIndemnity\\n13.1.\\tYou agree to indemnify the Application, its affiliates, employees, agents, contributors, third party content providers and licensors from and against:\\n(a)\\tall actions, suits, claims, demands, liabilities, costs, expenses, loss and damage (including legal fees on a full indemnity basis) incurred, suffered or arising out of or in connection with Your Content;\\n(b)\\tany direct or indirect consequences of you accessing, using or transacting on the Application or attempts to do so; and\\/or\\n(c)\\tany breach of the Terms.\\n14.\\tDispute Resolution\\n14.1.\\tCompulsory:\\n \\tIf a dispute arises out of or relates to the Terms, either party may not commence any Tribunal or Court proceedings in relation to the dispute, unless the following clauses have been complied with (except where urgent interlocutory relief is sought).\\n14.2.\\tNotice:\\n \\tA party to the Terms claiming a dispute ('Dispute') has arisen under the Terms, must give written notice to the other party detailing the nature of the dispute, the desired outcome and the action required to settle the Dispute.\\n14.3.\\tResolution:\\n \\tOn receipt of that notice ('Notice') by that other party, the parties to the Terms ('Parties') must:\\n(a)\\tWithin 14 days of the Notice endeavour in good faith to resolve the Dispute expeditiously by negotiation or such other means upon which they may mutually agree;\\n(b)\\tIf for any reason whatsoever, 14 days after the date of the Notice, the Dispute has not been resolved, the Parties must either agree upon selection of a mediator or request that an appropriate mediator be appointed by the President of the Australian Mediation Association or his or her nominee;\\n(c)\\tThe Parties are equally liable for the fees and reasonable expenses of a mediator and the cost of the venue of the mediation and without limiting the foregoing undertake to pay any amounts requested by the mediator as a pre-condition to the mediation commencing. The Parties must each pay their own costs associated with the mediation;\\n(d)\\tThe mediation will be held in 195 the Applicationllington Road Clayton\\n14.4.\\tConfidential\\n \\tAll communications concerning negotiations made by the Parties arising out of and in connection with this dispute resolution clause are confidential and to the extent possible, must be treated as \\\"without prejudice\\\" negotiations for the purpose of applicable laws of evidence.\\n14.5.\\tTermination of Mediation:\\n \\tIf 2 weeks have elapsed after the start of a mediation of the Dispute and the Dispute has not been resolved, either Party may ask the mediator to terminate the mediation and the mediator must do so.\\n15.\\tVenue and Jurisdiction\\n \\tThe Services offered by the Application is intended to be viewed by residents of Australia. In the event of any dispute arising out of or in relation to the Application, you agree that the exclusive venue for resolving any dispute shall be in the courts of Victoria, Australia.\\n16.\\tGoverning Law\\n \\tThe Terms are governed by the laws of Victoria, Australia. Any dispute, controversy, proceeding or claim of whatever nature arising out of or in any way relating to the Terms and the rights created hereby shall be governed, interpreted and construed by, under and pursuant to the laws of Victoria, Australia, without reference to conflict of law principles, notwithstanding mandatory rules. The validity of this governing law clause is not contested. The Terms shall be binding to the benefit of the parties hereto and their successors and assigns.\\n17.\\tIndependent Legal Advice\\n \\tBoth parties confirm and declare that the provisions of the Terms are fair and reasonable and both parties having taken the opportunity to obtain independent legal advice and declare the Terms are not against public policy on the grounds of inequality or bargaining power or general grounds of restraint of trade.\\n18.\\tSeverance\\n \\tIf any part of these Terms is found to be void or unenforceable by a Court of competent jurisdiction, that part shall be severed and the rest of the Terms shall remain in force.\\n\\n\\n\\n\",\n        \"website_url\": \"http:\\/\\/www.elegantmedia.com.au\",\n        \"facebook_url\": \"http:\\/\\/www.facebook.com\\/boost-app\",\n        \"twitter_url\": \"http:\\/\\/www.twitter.com\\/boost-app\",\n        \"linkedin_url\": \"http:\\/\\/www.linkedin.com\\/boost-app\",\n        \"instagram_url\": \"http:\\/\\/www.instagram.com\\/boost-app\",\n        \"call_us_number\": \"031234234\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/guest.coffee",
    "groupTitle": "Guest",
    "name": "GetApiV1Guests"
  },
  {
    "version": "1.0.0",
    "type": "DELETE",
    "url": "api/v1/players/{uuid}",
    "title": "Delete Player",
    "group": "PlayersAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>uuid of the player to delete</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/players_a_p_i.coffee",
    "groupTitle": "PlayersAPI",
    "name": "DeleteApiV1PlayersUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/players",
    "title": "List Players",
    "group": "PlayersAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "team_id",
            "description": "<p>Team ID. Send with the request URL as <code>team_id=xxx</code></p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"current_page\": 1,\n        \"data\": [\n            {\n                \"id\": 15,\n                \"uuid\": \"ddb7a57f-d10e-44e7-b515-4a4a52108ea8\",\n                \"team_id\": 3,\n                \"image_uuid\": null,\n                \"name\": \"Dr. Nico Toy\",\n                \"email\": \"orice@yahoo.com\",\n                \"positions\": \"AB,CD,EF\",\n                \"metadata\": null,\n                \"performance_notes\": \"Minima ex et unde rerum.\"\n            },\n            {\n                \"id\": 14,\n                \"uuid\": \"f91c3d5b-c27d-4b0f-ae4a-85311c097e6c\",\n                \"team_id\": 3,\n                \"image_uuid\": null,\n                \"name\": \"Adaline Collins\",\n                \"email\": \"milford86@hotmail.com\",\n                \"positions\": \"AB,CD,EF\",\n                \"metadata\": null,\n                \"performance_notes\": \"Excepturi ullam optio molestiae explicabo.\"\n            },\n            {\n                \"id\": 13,\n                \"uuid\": \"ee850d5c-4c7b-418e-8454-3d5e1b0f23bb\",\n                \"team_id\": 3,\n                \"image_uuid\": null,\n                \"name\": \"Hector Ferry DVM\",\n                \"email\": \"muller.molly@yahoo.com.au\",\n                \"positions\": \"AB,CD,EF\",\n                \"metadata\": null,\n                \"performance_notes\": \"Consectetur vero laboriosam quia deserunt assumenda placeat sed quo.\"\n            },\n            {\n                \"id\": 12,\n                \"uuid\": \"d8fcee7f-7934-41cc-ac44-913fa241291a\",\n                \"team_id\": 3,\n                \"image_uuid\": null,\n                \"name\": \"Taylor Torphy DVM\",\n                \"email\": \"lkirlin@yahoo.com.au\",\n                \"positions\": \"AB,CD,EF\",\n                \"metadata\": null,\n                \"performance_notes\": \"Expedita quae voluptatem nesciunt numquam.\"\n            },\n            {\n                \"id\": 11,\n                \"uuid\": \"3b827982-a4b5-41e8-9615-a670cb4e7a4a\",\n                \"team_id\": 3,\n                \"image_uuid\": null,\n                \"name\": \"Marlene Collins PhD\",\n                \"email\": \"jaclyn07@mcclure.com\",\n                \"positions\": \"AB,CD,EF\",\n                \"metadata\": null,\n                \"performance_notes\": \"Quibusdam expedita aspernatur quis.\"\n            }\n        ],\n        \"first_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/players?page=1\",\n        \"from\": 1,\n        \"last_page\": 1,\n        \"last_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/players?page=1\",\n        \"links\": [\n            {\n                \"url\": null,\n                \"label\": \"&laquo; Previous\",\n                \"active\": false\n            },\n            {\n                \"url\": \"http:\\/\\/boost.test\\/api\\/v1\\/players?page=1\",\n                \"label\": \"1\",\n                \"active\": true\n            },\n            {\n                \"url\": null,\n                \"label\": \"Next &raquo;\",\n                \"active\": false\n            }\n        ],\n        \"next_page_url\": null,\n        \"path\": \"http:\\/\\/boost.test\\/api\\/v1\\/players\",\n        \"per_page\": 50,\n        \"prev_page_url\": null,\n        \"to\": 5,\n        \"total\": 5\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/players_a_p_i.coffee",
    "groupTitle": "PlayersAPI",
    "name": "GetApiV1Players",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/players",
    "title": "Create Player",
    "group": "PlayersAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Player name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>String</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "positions",
            "description": "<p>List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image_uuid",
            "description": "<p>UUID for the team profile picture. Get a UUID from file upload endpoint</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "team_id",
            "description": "<p>Team ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"name\": \"Frederique Ruecker\",\n        \"email\": \"gabriella.connelly@hotmail.com\",\n        \"team_id\": 3,\n        \"uuid\": \"01f6f203-a53d-44f1-81dc-c272fc382482\",\n        \"id\": 34,\n        \"image_uuid\": \"fceaf68e-01dd-40a2-a5bb-2f4a4335c277\",\n        \"owner\": {\n            \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n            \"last_name\": null,\n            \"email\": \"apps+user@elegantmedia.com.au\",\n            \"email_verified_at\": null,\n            \"avatar_url\": null,\n            \"timezone\": \"Australia\\/Melbourne\",\n            \"first_name\": \"Peter Parker (REGULAR USER)\",\n            \"full_name\": \"Peter Parker (REGULAR USER)\"\n        },\n        \"image\": {\n            \"key\": \"file_key_75e42dd1-9001-4016-8a47-38bd1ad520b5\",\n            \"uuid\": \"fceaf68e-01dd-40a2-a5bb-2f4a4335c277\",\n            \"original_filename\": null,\n            \"file_url\": \"https:\\/\\/via.placeholder.com\\/640x480.png\\/005500?text=est\",\n            \"permalink\": \"http:\\/\\/boost.test\\/files\\/fceaf68e-01dd-40a2-a5bb-2f4a4335c277\"\n        }\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n    \"message\": \"The team id field is required.\",\n    \"payload\": {\n        \"errors\": {\n            \"team_id\": [\n                \"The team id field is required.\"\n            ]\n        }\n    },\n    \"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/players_a_p_i.coffee",
    "groupTitle": "PlayersAPI",
    "name": "PostApiV1Players",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "PUT",
    "url": "api/v1/players/{uuid}",
    "title": "Update Player",
    "group": "PlayersAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Player name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>String</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "positions",
            "description": "<p>List of positions as a comma seperated list. The API does NOT validate the data. It is upto the client to store and fetch this field</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image_uuid",
            "description": "<p>UUID for the team profile picture. Get a UUID from file upload endpoint</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"name\": \"Freddie Hansen\",\n        \"email\": \"dell62@hotmail.com\",\n        \"uuid\": \"f541ba14-4fe1-4f42-b0fc-5c49626f64d9\",\n        \"id\": 35,\n        \"owner\": {\n            \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n            \"last_name\": null,\n            \"email\": \"apps+user@elegantmedia.com.au\",\n            \"email_verified_at\": null,\n            \"avatar_url\": null,\n            \"timezone\": \"Australia\\/Melbourne\",\n            \"first_name\": \"Peter Parker (REGULAR USER)\",\n            \"full_name\": \"Peter Parker (REGULAR USER)\"\n        }\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/players_a_p_i.coffee",
    "groupTitle": "PlayersAPI",
    "name": "PutApiV1PlayersUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Get currently logged in user's profile</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/profile",
    "title": "My Profile",
    "group": "Profile",
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n        \"last_name\": null,\n        \"email\": \"apps+user@elegantmedia.com.au\",\n        \"email_verified_at\": null,\n        \"avatar_url\": null,\n        \"timezone\": \"Australia\\/Melbourne\",\n        \"first_name\": \"Peter Parker (REGULAR USER)\",\n        \"full_name\": \"Peter Parker (REGULAR USER)\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "GetApiV1Profile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/avatar",
    "title": "Update My Avatar",
    "group": "Profile",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "image",
            "description": "<p>Image</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n        \"last_name\": null,\n        \"email\": \"apps+user@elegantmedia.com.au\",\n        \"email_verified_at\": null,\n        \"avatar_url\": \"http:\\/\\/boost.test\\/storage\\/avatars\\/1\\/x3TVa1Ps8Y5dKhjlZoeKfbhlN1dTpqZSlj5x3h7C.jpg\",\n        \"timezone\": \"Australia\\/Melbourne\",\n        \"first_name\": \"Peter Parker (REGULAR USER)\",\n        \"full_name\": \"Peter Parker (REGULAR USER)\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "PostApiV1Avatar",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "PUT",
    "url": "api/v1/profile",
    "title": "Update My Profile",
    "group": "Profile",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>First name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "last_name",
            "description": "<p>Last name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "phone",
            "description": "<p>Phone</p>"
          }
        ]
      }
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n    \"message\": \"The email has already been taken.\",\n    \"payload\": {\n        \"errors\": {\n            \"email\": [\n                \"The email has already been taken.\"\n            ]\n        }\n    },\n    \"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/profile.coffee",
    "groupTitle": "Profile",
    "name": "PutApiV1Profile",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Delete a score record.</p>",
    "version": "1.0.0",
    "type": "DELETE",
    "url": "api/v1/games/{gameUuid}/scores/{uuid}",
    "title": "Delete Score",
    "group": "ScoresAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>Score UUID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/scores_a_p_i.coffee",
    "groupTitle": "ScoresAPI",
    "name": "DeleteApiV1GamesGameuuidScoresUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Get a list of scores for a game. Pagination is supported.</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/games/{gameUuid}/scores",
    "title": "List Scores per Game",
    "group": "ScoresAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"current_page\": 1,\n        \"data\": [\n            {\n                \"id\": 11,\n                \"uuid\": \"ca97dbde-64f5-4166-9beb-b990e8a3c347\",\n                \"game_id\": 3,\n                \"time_segment\": \"Quarter 2\",\n                \"position\": \"Forward\",\n                \"player_id\": 1,\n                \"score\": 90,\n                \"player\": {\n                    \"id\": 1,\n                    \"uuid\": \"28258542-a3bb-430f-88cc-10d6fb73d52f\",\n                    \"team_id\": 1,\n                    \"image_uuid\": null,\n                    \"name\": \"Bria Hartmann\",\n                    \"email\": \"obecker@hotmail.com.au\",\n                    \"positions\": \"AB,CD,EF\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Iure sed modi tempore aliquam voluptatem.\"\n                }\n            },\n            {\n                \"id\": 12,\n                \"uuid\": \"68d09f76-4890-4fda-9909-a35a527a9405\",\n                \"game_id\": 3,\n                \"time_segment\": \"Quarter 1\",\n                \"position\": \"Midfielder\",\n                \"player_id\": 2,\n                \"score\": 53,\n                \"player\": {\n                    \"id\": 2,\n                    \"uuid\": \"530606a9-74e8-4e56-9159-3c0f76861d7a\",\n                    \"team_id\": 1,\n                    \"image_uuid\": null,\n                    \"name\": \"Rosalee Weimann I\",\n                    \"email\": \"dmarvin@hotmail.com\",\n                    \"positions\": \"AB,CD,EF\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Tenetur corporis voluptatem dolor iusto.\"\n                }\n            },\n            {\n                \"id\": 13,\n                \"uuid\": \"97de1800-f043-4cf6-9a45-ede72a7f65b9\",\n                \"game_id\": 3,\n                \"time_segment\": \"Quarter 3\",\n                \"position\": \"Goalkeeper\",\n                \"player_id\": 3,\n                \"score\": 9,\n                \"player\": {\n                    \"id\": 3,\n                    \"uuid\": \"fac1ab17-6ac1-4b69-8b16-a8422af2dec2\",\n                    \"team_id\": 1,\n                    \"image_uuid\": null,\n                    \"name\": \"Judd Lebsack\",\n                    \"email\": \"ukoepp@yahoo.com\",\n                    \"positions\": \"AB,CD,EF\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Neque itaque tempora ipsum aperiam sit.\"\n                }\n            },\n            {\n                \"id\": 14,\n                \"uuid\": \"8b7d258e-ce81-4ebe-8484-8ec4d1691e2d\",\n                \"game_id\": 3,\n                \"time_segment\": \"Quarter 3\",\n                \"position\": \"Midfielder\",\n                \"player_id\": 4,\n                \"score\": 68,\n                \"player\": {\n                    \"id\": 4,\n                    \"uuid\": \"62887be1-5040-4223-a25e-d133536f5bf7\",\n                    \"team_id\": 1,\n                    \"image_uuid\": null,\n                    \"name\": \"Mr. Shaun Huels Sr.\",\n                    \"email\": \"ybogan@yahoo.com\",\n                    \"positions\": \"AB,CD,EF\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Non quod rerum qui nulla.\"\n                }\n            },\n            {\n                \"id\": 15,\n                \"uuid\": \"200b4ae1-4af9-4cc4-a9a0-7154448e4d73\",\n                \"game_id\": 3,\n                \"time_segment\": \"Quarter 4\",\n                \"position\": \"Defender\",\n                \"player_id\": 5,\n                \"score\": 69,\n                \"player\": {\n                    \"id\": 5,\n                    \"uuid\": \"ea6a98c2-ce0d-443f-9aed-0f8437cd4e85\",\n                    \"team_id\": 1,\n                    \"image_uuid\": null,\n                    \"name\": \"Mr. Eugene Gusikowski\",\n                    \"email\": \"bergnaum.lisette@yahoo.com.au\",\n                    \"positions\": \"AB,CD,EF\",\n                    \"metadata\": null,\n                    \"performance_notes\": \"Temporibus aut nam aliquam in.\"\n                }\n            }\n        ],\n        \"first_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games\\/a95fc420-5e24-4084-b59b-0c541d3740b7\\/scores?page=1\",\n        \"from\": 1,\n        \"last_page\": 1,\n        \"last_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games\\/a95fc420-5e24-4084-b59b-0c541d3740b7\\/scores?page=1\",\n        \"links\": [\n            {\n                \"url\": null,\n                \"label\": \"&laquo; Previous\",\n                \"active\": false\n            },\n            {\n                \"url\": \"http:\\/\\/boost.test\\/api\\/v1\\/games\\/a95fc420-5e24-4084-b59b-0c541d3740b7\\/scores?page=1\",\n                \"label\": \"1\",\n                \"active\": true\n            },\n            {\n                \"url\": null,\n                \"label\": \"Next &raquo;\",\n                \"active\": false\n            }\n        ],\n        \"next_page_url\": null,\n        \"path\": \"http:\\/\\/boost.test\\/api\\/v1\\/games\\/a95fc420-5e24-4084-b59b-0c541d3740b7\\/scores\",\n        \"per_page\": 50,\n        \"prev_page_url\": null,\n        \"to\": 5,\n        \"total\": 5\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/scores_a_p_i.coffee",
    "groupTitle": "ScoresAPI",
    "name": "GetApiV1GamesGameuuidScores",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Create a new score for a player. Each record will be unique by <code>gameUuid</code>, <code>player_id</code>, <code>position</code> and <code>time_segment</code>. If the record already exists, it will be updated. If a score record must be deleted, you should send a null score value or use delete endpoint.</p>",
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/games/{gameUuid}/scores",
    "title": "Create Score",
    "group": "ScoresAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "gameUuid",
            "description": "<p>Game UUID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "player_id",
            "description": "<p>Player ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "position",
            "description": "<p>Position of the player in the game</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "time_segment",
            "description": "<p>Time segment on game. Examples <code>Quarter 1</code>, <code>Quarter 2</code>, <code>Quarter 3</code>, <code>Quarter 4</code>, <code>Overtime</code>, <code>Shootout</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "score",
            "description": "<p>To delete a record, send a score of <code>null</code>.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"id\": 59,\n        \"uuid\": \"c5465b22-d711-468c-af54-ecff991a1aaa\",\n        \"game_id\": 8,\n        \"time_segment\": \"Q1\",\n        \"position\": \"Center\",\n        \"player_id\": 10,\n        \"score\": 38\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/scores_a_p_i.coffee",
    "groupTitle": "ScoresAPI",
    "name": "PostApiV1GamesGameuuidScores",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/seasons",
    "title": "Seasons",
    "group": "SeasonsAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>Search query</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"current_page\": 1,\n        \"data\": [\n            {\n                \"id\": 4,\n                \"uuid\": \"12f8a2ad-2b7b-40a4-b3f0-654847b46e70\",\n                \"name\": \"Summer 2023\"\n            },\n            {\n                \"id\": 3,\n                \"uuid\": \"f483af34-378e-41c7-92dd-d67ad640bded\",\n                \"name\": \"Winter 2022\"\n            },\n            {\n                \"id\": 2,\n                \"uuid\": \"6257ded3-05c6-44e8-a655-09a0d76d86f2\",\n                \"name\": \"Summer 2021\"\n            },\n            {\n                \"id\": 1,\n                \"uuid\": \"378a3d3c-2823-4b14-90cd-b14f15533c22\",\n                \"name\": \"Summer 2021\"\n            }\n        ],\n        \"first_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/seasons?page=1\",\n        \"from\": 1,\n        \"last_page\": 1,\n        \"last_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/seasons?page=1\",\n        \"links\": [\n            {\n                \"url\": null,\n                \"label\": \"&laquo; Previous\",\n                \"active\": false\n            },\n            {\n                \"url\": \"http:\\/\\/boost.test\\/api\\/v1\\/seasons?page=1\",\n                \"label\": \"1\",\n                \"active\": true\n            },\n            {\n                \"url\": null,\n                \"label\": \"Next &raquo;\",\n                \"active\": false\n            }\n        ],\n        \"next_page_url\": null,\n        \"path\": \"http:\\/\\/boost.test\\/api\\/v1\\/seasons\",\n        \"per_page\": 50,\n        \"prev_page_url\": null,\n        \"to\": 4,\n        \"total\": 4\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/seasons_a_p_i.coffee",
    "groupTitle": "SeasonsAPI",
    "name": "GetApiV1Seasons",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Returns all app settings. Each setting value is identified by the respective key.</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/settings",
    "title": "Get Settings",
    "group": "Settings",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p><code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"settings\": [\n            {\n                \"id\": 1,\n                \"created_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"updated_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"key\": \"ABOUT_US\",\n                \"value\": null\n            },\n            {\n                \"id\": 2,\n                \"created_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"updated_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"key\": \"PRIVACY_POLICY\",\n                \"value\": null\n            },\n            {\n                \"id\": 3,\n                \"created_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"updated_at\": \"2020-06-17T11:05:27.000000Z\",\n                \"key\": \"TERMS_AND_CONDITIONS\",\n                \"value\": null\n            }\n        ]\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/settings.coffee",
    "groupTitle": "Settings",
    "name": "GetApiV1Settings"
  },
  {
    "description": "<p>Returns the value of a single app setting requested by key.</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/settings/{key}",
    "title": "Get Setting",
    "group": "Settings",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Key of the setting</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"id\": 1,\n        \"created_at\": \"2020-06-17T11:05:27.000000Z\",\n        \"updated_at\": \"2020-06-17T11:05:27.000000Z\",\n        \"key\": \"ABOUT_US\",\n        \"value\": null\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/settings.coffee",
    "groupTitle": "Settings",
    "name": "GetApiV1SettingsKey",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "DELETE",
    "url": "api/v1/teams/{uuid}",
    "title": "Delete Team",
    "group": "TeamsAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>uuid of the Team to delete</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": null,\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/teams_a_p_i.coffee",
    "groupTitle": "TeamsAPI",
    "name": "DeleteApiV1TeamsUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "description": "<p>Get a list of teams created by user</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/teams",
    "title": "List Teams",
    "group": "TeamsAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "q",
            "description": "<p>Search query to filter by a name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"current_page\": 1,\n        \"data\": [\n            {\n                \"id\": 3,\n                \"uuid\": \"510bf243-5320-4c85-949c-3df68519f2a0\",\n                \"owner_id\": 1,\n                \"image_uuid\": null,\n                \"player_count\": 12,\n                \"name\": \"Team C\",\n                \"team_number\": \"LfLkN\",\n                \"metadata\": null,\n                \"performance_notes\": \"Error labore voluptate laboriosam voluptatem.\"\n            },\n            {\n                \"id\": 2,\n                \"uuid\": \"64be0c03-093c-4f60-9d9f-7d8e86c1671f\",\n                \"owner_id\": 1,\n                \"image_uuid\": null,\n                \"player_count\": 14,\n                \"name\": \"Team B\",\n                \"team_number\": \"9hEtz\",\n                \"metadata\": null,\n                \"performance_notes\": \"Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.\"\n            },\n            {\n                \"id\": 1,\n                \"uuid\": \"b24c645d-f139-4816-9564-0b7118e7bae4\",\n                \"owner_id\": 1,\n                \"image_uuid\": null,\n                \"player_count\": 14,\n                \"name\": \"Team A\",\n                \"team_number\": \"G2H9K\",\n                \"metadata\": null,\n                \"performance_notes\": \"Sapiente placeat ut non tempora omnis commodi.\"\n            }\n        ],\n        \"first_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/teams?page=1\",\n        \"from\": 1,\n        \"last_page\": 1,\n        \"last_page_url\": \"http:\\/\\/boost.test\\/api\\/v1\\/teams?page=1\",\n        \"links\": [\n            {\n                \"url\": null,\n                \"label\": \"&laquo; Previous\",\n                \"active\": false\n            },\n            {\n                \"url\": \"http:\\/\\/boost.test\\/api\\/v1\\/teams?page=1\",\n                \"label\": \"1\",\n                \"active\": true\n            },\n            {\n                \"url\": null,\n                \"label\": \"Next &raquo;\",\n                \"active\": false\n            }\n        ],\n        \"next_page_url\": null,\n        \"path\": \"http:\\/\\/boost.test\\/api\\/v1\\/teams\",\n        \"per_page\": 50,\n        \"prev_page_url\": null,\n        \"to\": 3,\n        \"total\": 3\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/teams_a_p_i.coffee",
    "groupTitle": "TeamsAPI",
    "name": "GetApiV1Teams",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/teams",
    "title": "Create Team",
    "group": "TeamsAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Team name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_number",
            "description": "<p>A number for the team. Can be any value</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "player_count",
            "description": "<p>Number of players for the team</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image_uuid",
            "description": "<p>UUID for the team profile picture. Get a UUID from file upload endpoint</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"name\": \"Dare-Kovacek\",\n        \"team_number\": 13,\n        \"player_count\": 13,\n        \"uuid\": \"989148b4-1c5a-4bfe-bbfe-db7daac23762\",\n        \"id\": 23,\n        \"owner_id\": \"1\",\n        \"owner\": {\n            \"uuid\": \"c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6\",\n            \"last_name\": null,\n            \"email\": \"apps+user@elegantmedia.com.au\",\n            \"email_verified_at\": null,\n            \"avatar_url\": null,\n            \"timezone\": \"Australia\\/Melbourne\",\n            \"first_name\": \"Peter Parker (REGULAR USER)\",\n            \"full_name\": \"Peter Parker (REGULAR USER)\"\n        }\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/teams_a_p_i.coffee",
    "groupTitle": "TeamsAPI",
    "name": "PostApiV1Teams",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  },
  {
    "version": "1.0.0",
    "type": "PUT",
    "url": "api/v1/teams/{uuid}",
    "title": "Update Team",
    "group": "TeamsAPI",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "uuid",
            "description": "<p>uuid of the Team to update</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Team name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "team_number",
            "description": "<p>A number for the team. Can be any value</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "player_count",
            "description": "<p>Number of players for the team</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "image_uuid",
            "description": "<p>UUID for the team profile picture. Get a UUID from file upload endpoint</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "performance_notes",
            "description": "<p>Team performance notes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "metadata",
            "description": "<p>An array of key value pairs to store any metadata</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response / HTTP 200 OK",
          "content": "{\n    \"payload\": {\n        \"id\": 1,\n        \"uuid\": \"b24c645d-f139-4816-9564-0b7118e7bae4\",\n        \"owner_id\": 1,\n        \"image_uuid\": null,\n        \"player_count\": 14,\n        \"name\": \"Jaylen Hill\",\n        \"team_number\": \"G2H9K\",\n        \"metadata\": null,\n        \"performance_notes\": \"Rerum repellendus at recusandae quo adipisci.\"\n    },\n    \"message\": \"\",\n    \"result\": true\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/Users/shane/www/sites-laravel/boost/resources/docs/apidoc/auto_generated/teams_a_p_i.coffee",
    "groupTitle": "TeamsAPI",
    "name": "PutApiV1TeamsUuid",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Accept",
            "description": "<p>Set to <code>application/json</code></p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-api-key",
            "description": "<p>API Key</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "x-access-token",
            "description": "<p>Unique user authentication token</p>"
          }
        ]
      }
    }
  }
] });
