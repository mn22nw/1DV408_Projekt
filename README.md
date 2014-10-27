Projekt - Music Logbook
======================

### Länk till körbar applikation

**Använd CHROME som webbläsare för testning (funkar i Firefox men ser inte lika bra ut)**
- [Music Logbook](http://mianygren.nu/MusicLogbook)

- *Användarnamn:User Lösen:Password*

### Användarfall

- [Användarfall](http://www.mianygren.nu/PHP-1DV408/Projekt/Anv%C3%A4ndarfall.pdf)

  *Jag implementerade även att man kan välja huvudinstument + registrera användare*
  *(Dessa hann jag inte lägga till som användarfall i efterhand)*

### Klassdiagram

- [Klassdiagram](http://www.mianygren.nu/PHP-1DV408/Projekt/klassdiagram.pdf)

### Testfall 

- [Testfall](http://www.mianygren.nu/PHP-1DV408/Projekt/Testfall.pdf)
*(Har ej skrivit testfall för de implementationer som inte finns med bland användarfallen)*
- [Testrapport](http://www.mianygren.nu/PHP-1DV408/Projekt/Testrapport.pdf) 

*har fixat timer-bugg, som ej gick igenom i testfallet, har inte commitat ändringen till github men det fungerar i den körbara versionen)


### Checklista för release på nytt webbhotell
* Ladda upp samtliga filer och mappar med deras innehåll på er server. Dessa är:
	- (Filer utanför mappar:)
		- index.php
		- Settings.php
	 	- errors.log
 	- (Mappar:)
 		 - css
 		 - helpers
 		 - src
 		 - db
  	  
* Importera databasen musiclogbook.sql till er databas för webhotellet. 

* Ändra inställningar i Settings.php så att de stämmer överens med uppgifterna till er databas. 
