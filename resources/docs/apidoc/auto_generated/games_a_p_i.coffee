# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription Get a list of games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.
@apiVersion 1.0.0
@api {GET} api/v1/games List Games
@apiGroup GamesAPI
@apiParam {String} page Page number
@apiParam {String} [period] Period can be `past`, `future`, `from_today`. The default is `from_today`.
@apiParam {String} [order] Order can be `asc`, `desc`. The default is `asc`.
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "current_page": 1,
        "data": [
            {
                "id": 9,
                "uuid": "22505ec1-c751-466b-8645-d76a0580f3c8",
                "owner_id": 1,
                "season_id": 1,
                "team_a_id": 2,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 8",
                "played_at": "2022-06-29T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 2,
                    "uuid": "64be0c03-093c-4f60-9d9f-7d8e86c1671f",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team B",
                    "team_number": "9hEtz",
                    "metadata": null,
                    "performance_notes": "Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.",
                    "image": null
                },
                "season": {
                    "id": 1,
                    "uuid": "378a3d3c-2823-4b14-90cd-b14f15533c22",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 4,
                "uuid": "dd777ef9-410e-4824-b4fa-5afb9569bddd",
                "owner_id": 1,
                "season_id": 4,
                "team_a_id": 3,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 3",
                "played_at": "2022-06-30T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 3,
                    "uuid": "510bf243-5320-4c85-949c-3df68519f2a0",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 12,
                    "name": "Team C",
                    "team_number": "LfLkN",
                    "metadata": null,
                    "performance_notes": "Error labore voluptate laboriosam voluptatem.",
                    "image": null
                },
                "season": {
                    "id": 4,
                    "uuid": "12f8a2ad-2b7b-40a4-b3f0-654847b46e70",
                    "name": "Summer 2023"
                }
            },
            {
                "id": 3,
                "uuid": "a95fc420-5e24-4084-b59b-0c541d3740b7",
                "owner_id": 1,
                "season_id": 2,
                "team_a_id": 1,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 2",
                "played_at": "2022-07-04T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 1,
                    "uuid": "b24c645d-f139-4816-9564-0b7118e7bae4",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team A",
                    "team_number": "G2H9K",
                    "metadata": null,
                    "performance_notes": "Sapiente placeat ut non tempora omnis commodi.",
                    "image": null
                },
                "season": {
                    "id": 2,
                    "uuid": "6257ded3-05c6-44e8-a655-09a0d76d86f2",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 1,
                "uuid": "d1c7ab80-d185-4b41-ba17-320bb4dee879",
                "owner_id": 1,
                "season_id": 1,
                "team_a_id": 3,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 0",
                "played_at": "2022-07-13T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 3,
                    "uuid": "510bf243-5320-4c85-949c-3df68519f2a0",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 12,
                    "name": "Team C",
                    "team_number": "LfLkN",
                    "metadata": null,
                    "performance_notes": "Error labore voluptate laboriosam voluptatem.",
                    "image": null
                },
                "season": {
                    "id": 1,
                    "uuid": "378a3d3c-2823-4b14-90cd-b14f15533c22",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 2,
                "uuid": "39396b3b-8757-43c3-a299-c686529c2d44",
                "owner_id": 1,
                "season_id": 1,
                "team_a_id": 1,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 1",
                "played_at": "2022-07-26T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 1,
                    "uuid": "b24c645d-f139-4816-9564-0b7118e7bae4",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team A",
                    "team_number": "G2H9K",
                    "metadata": null,
                    "performance_notes": "Sapiente placeat ut non tempora omnis commodi.",
                    "image": null
                },
                "season": {
                    "id": 1,
                    "uuid": "378a3d3c-2823-4b14-90cd-b14f15533c22",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 7,
                "uuid": "f17ffb40-5f69-43fd-9ee1-071f2a45062c",
                "owner_id": 1,
                "season_id": 2,
                "team_a_id": 3,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 6",
                "played_at": "2022-08-04T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 3,
                    "uuid": "510bf243-5320-4c85-949c-3df68519f2a0",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 12,
                    "name": "Team C",
                    "team_number": "LfLkN",
                    "metadata": null,
                    "performance_notes": "Error labore voluptate laboriosam voluptatem.",
                    "image": null
                },
                "season": {
                    "id": 2,
                    "uuid": "6257ded3-05c6-44e8-a655-09a0d76d86f2",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 10,
                "uuid": "0a0cb357-9aa6-49a6-86dc-00b6846dd6a6",
                "owner_id": 1,
                "season_id": 2,
                "team_a_id": 1,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 9",
                "played_at": "2022-08-04T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 1,
                    "uuid": "b24c645d-f139-4816-9564-0b7118e7bae4",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team A",
                    "team_number": "G2H9K",
                    "metadata": null,
                    "performance_notes": "Sapiente placeat ut non tempora omnis commodi.",
                    "image": null
                },
                "season": {
                    "id": 2,
                    "uuid": "6257ded3-05c6-44e8-a655-09a0d76d86f2",
                    "name": "Summer 2021"
                }
            },
            {
                "id": 6,
                "uuid": "79396619-e7dd-483c-81e1-8548bc996cdb",
                "owner_id": 1,
                "season_id": 3,
                "team_a_id": 2,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 5",
                "played_at": "2022-09-01T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 2,
                    "uuid": "64be0c03-093c-4f60-9d9f-7d8e86c1671f",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team B",
                    "team_number": "9hEtz",
                    "metadata": null,
                    "performance_notes": "Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.",
                    "image": null
                },
                "season": {
                    "id": 3,
                    "uuid": "f483af34-378e-41c7-92dd-d67ad640bded",
                    "name": "Winter 2022"
                }
            },
            {
                "id": 5,
                "uuid": "272268c8-1035-486a-bc39-2a8503678314",
                "owner_id": 1,
                "season_id": 3,
                "team_a_id": 3,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 4",
                "played_at": "2022-09-08T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 3,
                    "uuid": "510bf243-5320-4c85-949c-3df68519f2a0",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 12,
                    "name": "Team C",
                    "team_number": "LfLkN",
                    "metadata": null,
                    "performance_notes": "Error labore voluptate laboriosam voluptatem.",
                    "image": null
                },
                "season": {
                    "id": 3,
                    "uuid": "f483af34-378e-41c7-92dd-d67ad640bded",
                    "name": "Winter 2022"
                }
            },
            {
                "id": 8,
                "uuid": "1e78b8ad-ab1d-47e5-8aff-8073e5c76b39",
                "owner_id": 1,
                "season_id": 1,
                "team_a_id": 2,
                "team_b_id": null,
                "team_b_name": null,
                "tournament_name": "Tournament 7",
                "played_at": "2022-09-09T01:56:17.000000Z",
                "location": null,
                "team_a_image_uuid": null,
                "team_b_image_uuid": null,
                "team_a": {
                    "id": 2,
                    "uuid": "64be0c03-093c-4f60-9d9f-7d8e86c1671f",
                    "owner_id": 1,
                    "image_uuid": null,
                    "player_count": 14,
                    "name": "Team B",
                    "team_number": "9hEtz",
                    "metadata": null,
                    "performance_notes": "Fugiat incidunt aspernatur ea deserunt necessitatibus veniam eius.",
                    "image": null
                },
                "season": {
                    "id": 1,
                    "uuid": "378a3d3c-2823-4b14-90cd-b14f15533c22",
                    "name": "Summer 2021"
                }
            }
        ],
        "first_page_url": "http:\/\/boost.test\/api\/v1\/games?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http:\/\/boost.test\/api\/v1\/games?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http:\/\/boost.test\/api\/v1\/games?page=1",
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
        "path": "http:\/\/boost.test\/api\/v1\/games",
        "per_page": 50,
        "prev_page_url": null,
        "to": 10,
        "total": 10
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
@api {POST} api/v1/games Create Game
@apiGroup GamesAPI
@apiParam {String} tournament_name Tournament name
@apiParam {String} played_at  2022-07-01T13
@apiParam {String} [location]  "The Palace"
@apiParam {String} [season_id] Season ID
@apiParam {String} team_a_id Team A ID
@apiParam {String} [team_a_image_uuid] UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.
@apiParam {String} [team_b_image_uuid] UUID for the team B profile picture. Get a UUID from file upload endpoint.
@apiParam {String} team_b_name String
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "tournament_name": "Et molestiae et dignissimos blanditiis.",
        "played_at": "2022-06-29T02:29:26.000000Z",
        "location": "68C Brett Corner\nNew Sebastian, VIC 2681",
        "season_id": 4,
        "team_b_name": "Team B",
        "uuid": "7475212a-c5f4-4fd4-a38b-dc7352e7dbaa",
        "id": 29,
        "owner_id": "1",
        "owner": {
            "uuid": "c1e7d9ce-f32b-428f-94bd-0e20a2bb87b6",
            "last_name": null,
            "email": "apps+user@elegantmedia.com.au",
            "email_verified_at": null,
            "avatar_url": null,
            "timezone": "Australia\/Melbourne",
            "first_name": "Peter Parker (REGULAR USER)",
            "full_name": "Peter Parker (REGULAR USER)"
        }
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
@api {PUT} api/v1/games/{uuid} Update Game
@apiGroup GamesAPI
@apiParam {String} uuid Game UUID
@apiParam {String} tournament_name Tournament name
@apiParam {String} played_at  2022-07-01T13
@apiParam {String} [location]  "The Palace"
@apiParam {String} [season_id] Season ID
@apiParam {String} team_a_id Team A ID
@apiParam {String} [team_a_image_uuid] UUID for the team A profile picture. Get a UUID from file upload endpoint. Only use this to override the default team A image.
@apiParam {String} [team_b_image_uuid] UUID for the team B profile picture. Get a UUID from file upload endpoint.
@apiParam {String} team_b_name String
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": {
        "tournament_name": "Incidunt maxime earum porro culpa minima cum officiis nisi.",
        "played_at": "2022-06-29T02:29:26.000000Z",
        "location": "Unit 44 2 Towne Amble\nNew Conradside, WA 2830",
        "season_id": 4,
        "team_b_name": "Team B",
        "uuid": "dbf6c319-45d5-4a95-936e-dbbb45e1c296",
        "id": 30
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
@api {DELETE} api/v1/games/{uuid} Delete Game
@apiGroup GamesAPI
@apiParam {String} uuid uuid of the Game to delete
@apiUse default_headers
@apiSuccessExample {json} Success-Response / HTTP 200 OK
{
    "payload": null,
    "message": "",
    "result": true
}
###