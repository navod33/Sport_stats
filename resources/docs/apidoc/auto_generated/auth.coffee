# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription This endpoint registers a user.If you need to update a profile image, upload the profile image in thebackground using `/avatar` endpoint.
@apiVersion 1.0.0
@api {POST} api/v1/register Register
@apiGroup Auth
@apiParam {String} device_id Unique ID of the device
@apiParam {String} device_type Type of the device `APPLE` or `ANDROID`
@apiParam {String} [device_push_token] Unique push token for the device
@apiParam {String} email Email address of user
@apiParam {String} password Password. Must be at least 8 characters.
@apiParam {String} password_confirmation Confirm password. Must be at least 8 characters.
@apiHeader {String} Accept `application/json`
@apiHeader {String} x-api-key API Key
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "email": "vconroy@example.net",
        "uuid": "abfe791b-fe2f-4d2d-b25d-819cedce41c7",
        "first_name": null,
        "full_name": "",
        "access_token": "1656469765HWbZYFGtj3bq3omTEFEqigyASo07ywGviaT"
    },
    "message": "",
    "result": true
}
@apiErrorExample {json} Error-Response / HTTP 422 Unprocessable Content
{
					"message": "The email must be a valid email address.",
					"payload": {
						"errors": {
							"email": [
								"The email must be a valid email address."
							]
						}
					},
					"result": false
				}
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiVersion 1.0.0
@api {POST} api/v1/login Login
@apiGroup Auth
@apiParam {String} device_id Unique ID of the device
@apiParam {String} device_type Type of the device `APPLE` or `ANDROID`
@apiParam {String} [device_push_token] Unique push token for the device
@apiParam {String} email Email
@apiParam {String} password Password
@apiHeader {String} Accept `application/json`
@apiHeader {String} x-api-key API Key
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "uuid": "b86e43f4-8a82-4ef6-a059-0f836968e574",
        "last_name": null,
        "email": "apps+suadmin@elegantmedia.com.au",
        "email_verified_at": null,
        "avatar_url": null,
        "timezone": "Australia\/Melbourne",
        "first_name": "Tony Stark (SUPER-ADMIN)",
        "full_name": "Tony Stark (SUPER-ADMIN)",
        "access_token": "16564697658JWLDvsUjp6emwofDcjOhyvYXHzer9ITWW9"
    },
    "message": "",
    "result": true
}
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiVersion 1.0.0
@api {POST} api/v1/verify-email/{code} Email Verification
@apiGroup Auth
@apiParam {Integer} code Verification Code
@apiUse default_headers
@apiErrorExample {json} Error-Response / HTTP 422 Unprocessable Content
{
    "message": "Invalid verification code, Resend and try again",
    "payload": null,
    "result": false
}
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiVersion 1.0.0
@api {POST} api/v1/resend-code Resend Verification Code
@apiGroup Auth
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": null,
    "message": "A verification code has been sent to your email. Test environment code is always 0",
    "result": true
}
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription Logout the user from current device
@apiVersion 1.0.0
@api {GET} api/v1/logout Logout
@apiGroup Auth
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": null,
    "message": "Logged out from the account.",
    "result": true
}
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiVersion 1.0.0
@api {POST} api/v1/password/edit Update Password
@apiGroup Auth
@apiParam {String} password Password
@apiParam {String} current_password Current password
@apiParam {String} password_confirmation Password confirmation
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": "",
    "message": "Password successfully updated.",
    "result": true
}
###
