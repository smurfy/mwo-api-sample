mwo.smurfy-net.de API documentation
=========================================

The api is based on a RESTFul interface to access data and uses an OAuth2 authentication.

Before you can use the API you need a valid client_id and client_secret for oauth2.
Send me a request via PM on the mwomercs.com form, username "smurfynet" or via email to mwostats@smurfy.de

Send the following data to request client access:

* E-mail Address
* Application Name  
The name of your application, displayed on the user autorization screen
* Application Description  
A short description of what your application does, displayed on the user authorization screen
* Redirect URI(s)  
One or more urls back to your site for Oauth User autorization.  Users will be redirected back to this location if they allow your application to access their data.

NOTE:
-----

Normally the interface should only use https!, but I have some problems with SSL right now so please access it http.
But this will change soon.

About oauth2 Access Tokens:
---------------------------
In order to make API requests to the Mechlab, you must have a valid access token.  These tokens are retrieved from the Smurfy Oauth provider.  You send your client_id and client_secret and recieve a JSON formated reply which contains the access token.

There are two classes of Oauth tokens avalible: 
Generic and User Specific

**Generic Tokens**  
These can be retrieved without any user interaction, requiring only a client_id and client_secret provided by smurfy above.  The majority of requests can be completed with a generic token.

**User Specific Tokens**  
These tokens require the user to authorize your application to access their smurfy profile.  

The process requires 3 steps:

1. Construct an authorization URL to the smurf site which the user must click on
2. The user will click the "Allow" button which will redirect back to your provided redirect_uri
3. With the code provided on the end of your redirect uri you will request an access token


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

**MECHID** is an integer which refers to a specific chassis/varient  
**LOADOUTID** is an 40 character string which uniquely identifies a loadout for a chassis/varient

**Generic Token Requests**  
+ Request list of all mechs  
https:/mwo.smurfy-net.de/api/data/mechs.FORMAT
+ Request a specific mech by Mech ID  
https:/mwo.smurfy-net.de/api/data/mechs/MECHID.FORMAT
+ Request a stock mech loadout by Mech ID  
https:/mwo.smurfy-net.de/api/data/mechs/MECHID/loadouts/stock.FORMAT
+ Request a mech loadout by Mech and Loadout ID  
https:/mwo.smurfy-net.de/api/data/mechs/MECHID/loadouts/LOADOUTID.FORMAT

**User Token Requests**  
+ Request user details (currently only username)  
https:/mwo.smurfy-net.de/api/data/user/details.FORMAT
+ Request users mechbay  
https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT
