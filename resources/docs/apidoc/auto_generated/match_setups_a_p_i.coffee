# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiVersion 1.0.0
@api {POST} api/v1/match Match Setup
@apiGroup MatchSetupsAPI
@apiParam {Integer} game_id Game ID
@apiParam {Integer} team_id Team ID
@apiParam {String} players players array. player id required. position required. 
						(get the position id from the List Players Positions API end point). time_segment required. if the time segment is Quater 1. then, just send 1.


						[
							{
							"player_id" : 1,
							"position" : 2,
							"time_segment" : 1,
							},
							{
							"player_id" : 2,
							"position" : 5,
							"time_segment" : 1,
							},
							{
							"player_id" : 1,
							"position" : 5,
							"time_segment" : 2,
							}
							]
						
@apiUse default_headers
###
# ******************************************************** #
#           AUTO-GENERATED. DO NOT EDIT THIS FILE.         #
# ******************************************************** #
#    Create your files in `resources/docs/apidoc/manual`   #
# ******************************************************** #
###
@apiDescription Get a match details for a time segment
@apiVersion 1.0.0
@api {GET} api/v1/match Current Match
@apiGroup MatchSetupsAPI
@apiParam {Integer} game_id Game ID
@apiParam {Integer} team_id Team ID
@apiParam {Integer} time_segment If the time segment is Quater 1. then, just send 1.
@apiUse default_headers
###