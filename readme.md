mwo.smurfy-net.de API documentation
=========================================

The api is based on a RESTFul interface to access data and uses an OAuth2 authentication.

Before you can use the API you need a valid client_id and client_secret for oauth2.
Which could be requested by writing an pm to smurfynet in the mwomercs.com forums or an email to mwostats@smurfy.de

The following data is required to grant a client access:

* email
* a name of your application (which will be shown to the user)
* a short description about your application (which will be also shown to the user)
* one or more urls back to your site where the oauth authentication will redirect the user to.

NOTE:
-----

Normally the interface should only use https!, but i have some problems with ssl right now so please access it http.
But this will change soon.

The following oauth2 urls/params exists:
----------------------------------------

Request for user auth:

https:/mwo.smurfy-net.de/api/oauth2/auth?response_type=code&redirect_uri=XXXX&client_id=NNN

Token requests:

All token request should be run server to server and the user should never see any of this communication!

Access without user interaction but only to non user specific data

https:/mwo.smurfy-net.de/api/oauth2/token?grant_type=client_credentials&client_id=XXXX&client_secret=YYYYY

After requesting user auth you will get a "code" query param to your redirect uri.

With that code you can request an access_token aswell. (for a short time)

https:/mwo.smurfy-net.de/api/oauth2/token?grant_type=authorization_code&client_id=XXXX&client_secret=YYYYY&code=NNNN&redirect_uri=MMMMM

Each access_token only works for a while until it times out. you will receive an refresh token aswell to renew a access_token.

You normally can save both tokens in your database/session for reuse.

https:/mwo.smurfy-net.de/api/oauth2/token?grant_type=refresh_token&client_id=XXXX&client_secret=YYYYY&refresh_token=NNNN

The following api data urls exists to date:
-------------------------------------------

Each data request needs an "access_token" query param with a valid token.

FORMAT can be "json" or "xml"

Request list of mechs

https:/mwo.smurfy-net.de/api/data/mechs.FORMAT

Request a specific mech by id

https:/mwo.smurfy-net.de/api/data/mechs/ID.FORMAT

Request a mech loadout by ids

https:/mwo.smurfy-net.de/api/data/mechs/ID/loadouts/LOADOUTID.FORMAT

Request user details (currently only username)

https:/mwo.smurfy-net.de/api/data/user/details.FORMAT

Request users mechbay

https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT
