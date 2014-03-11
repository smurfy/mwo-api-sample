mwo.smurfy-net.de API documentation
=========================================

The api is based on a RESTFul interface to access data and uses a simple api-key authentication.

The api-key authentication is only needed if you want to request a users mechbay.

Based on you preferences you can use either XML or JSON to access the api.
The format can be specified via http accept header or with a format suffix.

The API-KEY:
-------------

The user needs to provide the api key. The api key unique for the user is access-able after login.
Via: http:/mwo.smurfy-net.de/change-password

The Application needs to put the API-KEY to the http request Header.

Example:

    Authorization: APIKEY b0513c7be3e7184b66112a0157d6d267208857d5

Available API Commands:
------------------------

* Request list of mechs

  GET http:/mwo.smurfy-net.de/api/data/mechs.FORMAT

* Request a specific mech by id

  GET http:/mwo.smurfy-net.de/api/data/mechs/ID.FORMAT

* Request a mech loadout by ids

  GET http:/mwo.smurfy-net.de/api/data/mechs/ID/loadouts/LOADOUTID.FORMAT

* Send new loadout to server

  POST http:/mwo.smurfy-net.de/api/data/mechs/ID/loadouts.FORMAT

* Request user details (Requires API-KEY)

  GET https:/mwo.smurfy-net.de/api/data/user/details.FORMAT

* Request users mechbay (Requires API-KEY)

  GET https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT
