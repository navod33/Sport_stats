# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription Get a list of scores for a game. Pagination is supported.
@apiVersion 1.0.0
@api {GET} api/v1/games/{gameUuid}/scores List Scores per Game
@apiGroup ScoresAPI
@apiParam {String} gameUuid Game UUID
@apiParam {String} page Page number
@apiParam {Integer} [time_segment] Time segment. if quater 1, then send 1.
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "current_page": 1,
        "data": [
            {
                "id": 11,
                "uuid": "ca97dbde-64f5-4166-9beb-b990e8a3c347",
                "game_id": 3,
                "time_segment": "Quarter 2",
                "position": "Forward",
                "player_id": 1,
                "score": 90,
                "player": {
                    "id": 1,
                    "uuid": "28258542-a3bb-430f-88cc-10d6fb73d52f",
                    "team_id": 1,
                    "image_uuid": null,
                    "name": "Bria Hartmann",
                    "email": "obecker@hotmail.com.au",
                    "positions": "AB,CD,EF",
                    "metadata": null,
                    "performance_notes": "Iure sed modi tempore aliquam voluptatem."
                }
            },
            {
                "id": 12,
                "uuid": "68d09f76-4890-4fda-9909-a35a527a9405",
                "game_id": 3,
                "time_segment": "Quarter 1",
                "position": "Midfielder",
                "player_id": 2,
                "score": 53,
                "player": {
                    "id": 2,
                    "uuid": "530606a9-74e8-4e56-9159-3c0f76861d7a",
                    "team_id": 1,
                    "image_uuid": null,
                    "name": "Rosalee Weimann I",
                    "email": "dmarvin@hotmail.com",
                    "positions": "AB,CD,EF",
                    "metadata": null,
                    "performance_notes": "Tenetur corporis voluptatem dolor iusto."
                }
            },
            {
                "id": 13,
                "uuid": "97de1800-f043-4cf6-9a45-ede72a7f65b9",
                "game_id": 3,
                "time_segment": "Quarter 3",
                "position": "Goalkeeper",
                "player_id": 3,
                "score": 9,
                "player": {
                    "id": 3,
                    "uuid": "fac1ab17-6ac1-4b69-8b16-a8422af2dec2",
                    "team_id": 1,
                    "image_uuid": null,
                    "name": "Judd Lebsack",
                    "email": "ukoepp@yahoo.com",
                    "positions": "AB,CD,EF",
                    "metadata": null,
                    "performance_notes": "Neque itaque tempora ipsum aperiam sit."
                }
            },
            {
                "id": 14,
                "uuid": "8b7d258e-ce81-4ebe-8484-8ec4d1691e2d",
                "game_id": 3,
                "time_segment": "Quarter 3",
                "position": "Midfielder",
                "player_id": 4,
                "score": 68,
                "player": {
                    "id": 4,
                    "uuid": "62887be1-5040-4223-a25e-d133536f5bf7",
                    "team_id": 1,
                    "image_uuid": null,
                    "name": "Mr. Shaun Huels Sr.",
                    "email": "ybogan@yahoo.com",
                    "positions": "AB,CD,EF",
                    "metadata": null,
                    "performance_notes": "Non quod rerum qui nulla."
                }
            },
            {
                "id": 15,
                "uuid": "200b4ae1-4af9-4cc4-a9a0-7154448e4d73",
                "game_id": 3,
                "time_segment": "Quarter 4",
                "position": "Defender",
                "player_id": 5,
                "score": 69,
                "player": {
                    "id": 5,
                    "uuid": "ea6a98c2-ce0d-443f-9aed-0f8437cd4e85",
                    "team_id": 1,
                    "image_uuid": null,
                    "name": "Mr. Eugene Gusikowski",
                    "email": "bergnaum.lisette@yahoo.com.au",
                    "positions": "AB,CD,EF",
                    "metadata": null,
                    "performance_notes": "Temporibus aut nam aliquam in."
                }
            }
        ],
        "first_page_url": "http:\/\/boost.test\/api\/v1\/games\/a95fc420-5e24-4084-b59b-0c541d3740b7\/scores?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http:\/\/boost.test\/api\/v1\/games\/a95fc420-5e24-4084-b59b-0c541d3740b7\/scores?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http:\/\/boost.test\/api\/v1\/games\/a95fc420-5e24-4084-b59b-0c541d3740b7\/scores?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http:\/\/boost.test\/api\/v1\/games\/a95fc420-5e24-4084-b59b-0c541d3740b7\/scores",
        "per_page": 50,
        "prev_page_url": null,
        "to": 5,
        "total": 5
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
@apiDescription Create a new score for a player. Each record will be unique by `gameUuid`, `player_id`, `position` and `time_segment`. If the record already exists, it will be updated. 
@apiVersion 1.0.0
@api {POST} api/v1/games/{gameUuid}/scores Create Score
@apiGroup ScoresAPI
@apiParam {String} gameUuid Game UUID
@apiParam {String} player_id Player ID
@apiParam {String} position Position of the player in the game
@apiParam {String} time_segment Time segment on game. Examples `Quarter 1`, `Quarter 2`, `Quarter 3`, `Quarter 4`, `Overtime`, `Shootout`
@apiParam {String} score_type  `goal_in`,`goal_missed`, `error_record`,
                    `contract`,
                    `center_pass`,
                    `intercept`,
                    `tip`,
                    `rebound`,
                    `goal_in_reverse`,
                    `goal_missed_reverse`,
                    `error_record_reverse`,
                    `contract_reverse`,
                    `center_pass_reverse`,
                    `intercept_reverse`,
                    `tip_reverse`,
                    `rebound_reverse`
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "id": 59,
        "uuid": "c5465b22-d711-468c-af54-ecff991a1aaa",
        "game_id": 8,
        "time_segment": "Q1",
        "position": "Center",
        "player_id": 10,
        "score": 38
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
@apiDescription Create a new score for team B.
@apiVersion 1.0.0
@api {POST} api/v1/games/scores/teamb Create Team B Score
@apiGroup ScoresAPI
@apiParam {String} gameUuid Game UUID
@apiParam {String} score_type  `goal_in`,`goal_missed`,`goal_in_reverse`,`goal_missed_reverse`
@apiUse default_headers
###
