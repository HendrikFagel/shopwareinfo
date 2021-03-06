# shopwareinfo
Hallo alle zusammen, <br>

gerne möchte ich micht mit Shopware-API beschäftigen. Leider habe ich wenig Ahnung von Programmierung und keine Ahnung von Shopware-API.

Was ich bis jetzt herausgefunden habe und Ausprobiert habe: 

Wenn man den Shop installiert hat, dann kann man in der Datei .env (welche im Root des Shops liegt), den Shop auf developer-Version umstellen. 
~~~
#APP_ENV="prod"
APP_ENV="dev"
~~~
Ab diesen Moment kann man auch den Swagger über die URL im Browser aufrufen. 
~~~
https://example.com/api/_info/swagger.html#/
https://example.com/store-api/_info/swagger.html
~~~

Dann kann man teile der Spezifikation einsehen. <br>
**Frage:** Hier kann man scheinbar einloggen. Weiß jemand ob das überhaupt geht? <br>
Ich habe im Admin bereich einen API Schlüssel Set erstellt, aber mit diesem kann ich mit im Swagger nicht einloggen. <br>

Als nächstes habe ich irgendwo im Internet gefunden, das man über die Console, (das ist sicherlich ein Symfony Funktion) sich die Routen anzeigen kann. 

Der Befehl dazu lautet: 
~~~
php bin/console debug:router
~~~

Dann werden alle Routen angezeigt. Alle Routen aus der v6.4.7.0-Stable-Version können hier eingesehen werden. <br>
https://github.com/HendrikFagel/shopwareinfo/blob/main/shopware-v6.4.7.0-Stable-Version.txt

Als nächstes möchte ich zeigen, wie eine Abfrage über die Shopware-API realisiert werden kann.

# API-Abfrage mit einer Datei: alle Produkte ausgeben
Hier für begebe ich mich in das Verzeichnis /var/www/example.com/public/ und erstelle hier ein neues Verzeichnis:<br>
~~~
mkdir -p api
~~~
Dann begebe ich mich in das api Verzeichnis und erstelle hier meine erste Datei namens: 
~~~
getAllProducts.php
~~~
Die Datei könnt Ihr im Browser aufrufen: 
~~~
https://www.example.com/api/getAllProducts.php
~~~
Damit wirst du alle Inhalte von dem Shop sehen können. 
Anmerkung:In der Datei:getAllProducts.php ist ein Filter eingestellt, welcher uns nur zwei spezifikationen von den Produkten anzeigt. 
~~~
$body = '{
    "includes": {
        "product": ["id", "name"]
    }
}';
~~~
Möchten wir uns mehr von den Produkten anzeigen lassen,so müssen entweder den Filter ausschalten oder weitere Parameter in den Filter aufnehmen.
Damit haben wir den ersten schritt getan und uns eine abfrage gebastelt.
## API-Abfrage:Zeige mir alle Ѕteuersätze an
Hierfür habe ich für dich eine neue Datei angelegt<br>
~~~
https://github.com/HendrikFagel/shopwareinfo/blob/main/getTaxID.php
~~~
Du kannst diese Datei im Broswer aufrufen und es werden die alle Steuersätze, welche im Shopangelegt sind, angezeigt.
~~~
https://www.example.com/api/getTaxID.php
~~~
## API-Abfrage:Zeige mir alle Spezifikationen eines Produktes
Hierfür kannst du folgende Datei verwenden
~~~
https://github.com/HendrikFagel/shopwareinfo/blob/main/getProduct.php
~~~
Diese datei kannst du im Browser aufrufen und dir werden alle Daten eines Produktes angezeigt
~~~
https://www.example.com/api/getTaxID.php
~~~
Zusatzinformation:Ich musste ich laut Spezifikation die GET-Methode verwenden. 

## API-CREATE:Lege einen Produkt an
Jetzt möchten wir einfach ein Produkt anlegen. <br>
Dafür habe ich eine neue Datei angelegt mit dem Namen: 
~~~
https://github.com/HendrikFagel/shopwareinfo/blob/main/setNewProducts.php
~~~
Die neue Datei kannst du jetzt im Browser aufrufen und du wirst feststellen, das wir über die API ein neues Produkt angelegt haben.
~~~
https://www.example.com/api/setNewProducts.php
~~~
jetzt möchte ich mir die Datei etwas genauer anschauen. Der wichtigste Part dabei ist, folgender: 
~~~
$body = '{
    "name": "Pronomen",
    "productNumber": "77w5624352345",
    "stock": 10,
    "taxId": "ffed26b3194143518140ea11d87b8a26",
    "price": [
        {
            "currencyId" : "b7d2554b0ce847cd82f3ac9bd1c0dfca", 
            "gross": 15, 
            "net": 10, 
            "linked" : false
        }
    ]
}';
~~~
Denn genau hier legen wir ein neues Produkt an. Ich werde einige Werte Dokumentieren, einige Werte erklären sich von selbst. 
~~~

"name": "Pronomen", -> diesen Wert habe ich mir ausgedacht.

"productNumber": "77w5624352345", -> auch diesen Wert habe ich mir ausgedacht.

"taxId": "ffed26b3194143518140ea11d87b8a26", -> diesen Wert habe ich mir aus der vorherigen Abfrage abgeschaut,
und zuwar die ID von dem 19% Mehrwertsteuer herausgepickt.

"currencyId" : "b7d2554b0ce847cd82f3ac9bd1c0dfca", -> auch diesen Wert habe ich mir herausgeholt.

~~~

## Bilder bzw. Media hinzufuegen
Wir haben bis jetzt einen Produkt angelegt,jedoch verfüght das Produkt noch über keine Bilder.<br>
Damit wir auch das Lösen können, sollten wir uns zuerst alle Meida-Inhalte anzeigen lassen. <br>
Das machen wir mit der Datei: 
~~~
https://github.com/HendrikFagel/shopwareinfo/blob/main/getAllMedia.php
~~~

Du kannst diese Datei über Browser aufrufen und du wirs alle Inhalte sehen können. 
~~~
https://www.example.com/api/getAllMedia.php
~~~
Damit wir einem Produkt ein Bild zuweisen können, müssen die ID von dem Bild kennen.<br>
In diesem Fall habe ich mich für folgendes Bild entschieden: 
~~~
{
"id": "2de02991cd0548a4ac6cc35cb11773a0",
"type": "media",
"attributes": {
"userId": "45a7560671d44c689d4026bdce892db1",
"mediaFolderId": "43cb90318989434c94adcdb2a3ba28c2",
"mimeType": "image/jpeg",
"fileExtension": "jpg",
"uploadedAt": "2021-12-14T15:17:10.529+00:00",
"fileName": "handschuh_600x600",
"fileSize": 20132,
"metaData": {
"width": 600,
"height": 600,
"type": 2
},
"mediaType": {
"name": "IMAGE",
"flags": [],
"extensions": []
},
"alt": null,
"title": null,
"url": "https://www.example.com/media/4c/81/b7/1639495030/handschuh_600x600.jpg",
"hasFile": true,
"private": false,
"customFields": null,
"createdAt": "2021-12-14T15:17:10.443+00:00",
"updatedAt": "2021-12-14T15:17:10.531+00:00",
"translated": {
"alt": null,
"title": null,
"customFields": {}
},
~~~
Du sehen kannst, gibt es eine URL zu dem Bild und eine eindeutige ID diese ist: 
~~~
2de02991cd0548a4ac6cc35cb11773a0
~~~
Jetzt werden wir versuchen, einen Produkt ein neues Bild zuweisen. 


