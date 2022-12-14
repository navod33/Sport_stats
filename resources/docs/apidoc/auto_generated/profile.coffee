# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription Get currently logged in user's profile
@apiVersion 1.0.0
@api {GET} api/v1/profile My Profile
@apiGroup Profile
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "uuid": "c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6",
        "last_name": null,
        "email": "apps+user@elegantmedia.com.au",
        "email_verified_at": null,
        "avatar_url": null,
        "timezone": "Australia\/Melbourne",
        "first_name": "Peter Parker (REGULAR USER)",
        "full_name": "Peter Parker (REGULAR USER)"
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
@api {PUT} api/v1/profile Update My Profile
@apiGroup Profile
@apiParam {String} first_name First name
@apiParam {String} [last_name] Last name
@apiParam {String} email Email
@apiParam {String} [phone] Phone
@apiUse default_headers
@apiErrorExample {json} Error-Response / HTTP 422 Unprocessable Content
{
    "message": "The email has already been taken.",
    "payload": {
        "errors": {
            "email": [
                "The email has already been taken."
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
@api {POST} api/v1/avatar Update My Avatar
@apiGroup Profile
@apiParam {File} image Image
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "uuid": "c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6",
        "last_name": null,
        "email": "apps+user@elegantmedia.com.au",
        "email_verified_at": null,
        "avatar_url": "http:\/\/boost.test\/storage\/avatars\/1\/x3TVa1Ps8Y5dKhjlZoeKfbhlN1dTpqZSlj5x3h7C.jpg",
        "timezone": "Australia\/Melbourne",
        "first_name": "Peter Parker (REGULAR USER)",
        "full_name": "Peter Parker (REGULAR USER)"
    },
    "message": "",
    "result": true
}
###
