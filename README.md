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


Hier für begebe ich mich in das Verzeichnis /var/www/example.com/public/ und erstelle hier ein neues Verzeichnis:<br>
~~~
mkdir -p api
~~~
Dann begebe ich mich in das Verzeichnis und erstelle hier meine erste Datei namens: 
~~~
getAllProducts.php
~~~
Die Datei könnt Ihr im Browser aufrufen: 
~~~
https://www.example.com/api/getAllProducts.php
~~~
Damit wirst du alle Inhalte von dem Shop sehen können. 

Damit haben wir den ersten schritt getan und uns eine abfrage gebastelt 

