# shopwareinfo
Meine Information über Shopware
Hallo alle zusammen, 

gerne möchte ich micht etwas mit der API von Shopware beschäftigen, und dabei habe ich keine Ahnung von Programmierung und keine große Ahnung von Shopware API.

Was ich bis jetzt herausgefunden habe und Ausprobiert habe, ist folgendes. 

Wenn man den Shop installiert  hat dann kann man in der Datei .env ( welche im Root des Shops liegt den Shop auf dev umstellen. 
~~~
#APP_ENV="prod"
APP_ENV="dev"
~~~
ab diesen Moment kann man auch den Swagger über die URL im Browser aufrufen. 

https://example.com/api/_info/swagger.html#/

Dann kann man teile der Spezifikation einsehen. 
Frage: Hier kann man scheinbar einloggen. Weiß jemand ob das überhaupt geht? 
Ich habe im Admin bereich einen API Schlüssel Set erstellt, aber mit diesem kann ich mit im Swagger nicht einloggen. 
Frage: Weiß jemand warum Swagger hier nicht alles anzeigt? 

Als nächstes habe ich irgendwo im Internet gefunden, das man über die Console, (das ist sicherlich ein Symfony Funktion) sich die Routen anzeigen kann. 
