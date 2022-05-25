define({ "api": [
  {
    "description": "<p>Logout the user from current device</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/logout",
    "title": "Logout",
    "group": "Auth",
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
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
    "type": "GET",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "GetApiV1VerifyEmailCode",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
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
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n\"message\": \"The email must be a valid email address.\",\n\"payload\": {\n\"errors\": {\n\"email\": [\n\"The email must be a valid email address.\"\n]\n}\n},\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
    "groupTitle": "Auth",
    "name": "PostApiV1Register"
  },
  {
    "version": "1.0.0",
    "type": "POST",
    "url": "api/v1/resend-code",
    "title": "Resend Verification Code",
    "group": "Auth",
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/auth.coffee",
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
    "error": {
      "examples": [
        {
          "title": "Error-Response / HTTP 422 Unprocessable Content",
          "content": "{\n\"message\": \"Failed to send password reset email. Ensure your email is correct and try again.\",\n\"payload\": null,\n\"result\": false\n}",
          "type": "json"
        }
      ]
    },
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/forgot_password.coffee",
    "groupTitle": "ForgotPassword",
    "name": "PostApiV1PasswordEmail"
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/guest.coffee",
    "groupTitle": "Guest",
    "name": "GetApiV1Guests"
  },
  {
    "description": "<p>Get currently logged in user's profile</p>",
    "version": "1.0.0",
    "type": "GET",
    "url": "api/v1/profile",
    "title": "My Profile",
    "group": "Profile",
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/profile.coffee",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/profile.coffee",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/profile.coffee",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/settings.coffee",
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
    "filename": "C:/Users/DELL/Desktop/elegant/sportstats/pr463_sportstats_backend/resources/docs/apidoc/auto_generated/settings.coffee",
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
  }
] });
