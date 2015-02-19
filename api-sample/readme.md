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

* Request price list of almost all game objects (mechs, items..)

  ```GET http:/mwo.smurfy-net.de/api/data/prices.FORMAT```

* Request list of modules

  ```GET http://mwo.smurfy-net.de/api/data/modules.FORMAT```
  
* Request list of weapons

  ```GET http://mwo.smurfy-net.de/api/data/weapons.FORMAT```
  
* Request list of ammo

  ```GET http://mwo.smurfy-net.de/api/data/ammo.FORMAT```
  
* Request list of omnipods

  ```GET http://mwo.smurfy-net.de/api/data/omnipods.FORMAT```
  
* Request list of mechs

  ```GET http:/mwo.smurfy-net.de/api/data/mechs.FORMAT```

* Request a specific mech by id

  ```GET http:/mwo.smurfy-net.de/api/data/mechs/ID.FORMAT```

* Request a mech loadout by ids

  ```GET http:/mwo.smurfy-net.de/api/data/mechs/ID/loadouts/LOADOUTID.FORMAT```

* Send new loadout to server

  ```POST http:/mwo.smurfy-net.de/api/data/mechs/ID/loadouts.FORMAT```
  
  Body: format like received on a GET
  

* Request user details (Requires API-KEY)

  ```GET https:/mwo.smurfy-net.de/api/data/user/details.FORMAT```

* Request users mechbay (Requires API-KEY)

  ```GET https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT```
  
* Update users mechbay mech name (Requires API-KEY)

  ```PUT https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT```

  Body: One single mechbay entry. most values are ignored. used ones are ```.name``` (new name) ```.loadout.id``` and ```.loadout.mechId```

* Add or remove one or more mechs to mechbay (Requires API-KEY)

  Add:
  
  ```LINK https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT```
  
  Remove:
  
  ```UNLINK https:/mwo.smurfy-net.de/api/data/user/mechbay.FORMAT```
  
  Custom request header example: 
  
    ```Link: </api/data/mechs/150/loadouts/837a3eaf04d321aff5922859c451bcf21ed1114b>```
    
  You can add or remove more than one mech at the same time by separating multiple IRL by a comma (,)
  The method always returns a 204 http status and adds all successfully added or removed links to the response header.
  
  More infos: https://tools.ietf.org/html/rfc5988
  
