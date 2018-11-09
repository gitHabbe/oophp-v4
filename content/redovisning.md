---
---
Redovisning
=========================

Detta innehåll är skrivet i markdown och du hittar innehållet i filen `content/redovisning.md`.



Kmom01
-------------------------

Efter att ha jobbat med objektorienterad Python så kändes det bra att komma tillbaka i samma banor för PHP. Kodens struktur blir så mycket snyggare och man har mer kontroll över vad som händer i appen. Dock var det en hel del med PHP som jag hade glömt bort. Jag kände mig rätt säker efter att ha läst igenom uppgiften men när själva kodningen satt igång så var det en del saker som tog längre tid än jag beräknat. Det största problemet var att hantera data som inte var passerat till URL:en. Av någon anledning trodde jag att det gick att spara tillståndet av objektet i attributerna men gick inte. Till exempel om spelet var över eller inte. Det slutade med att jag använde en simpel teknik för att istället gömma delar av formuläret om rätt nummer var gissat. 

Att sätta sig in i Anax är väldigt svårt tycker jag. Såhär efter första kursmomentet så känner jag mig fortfarande hjälplös, så jag hoppas att många frågor blir besvarad i nästa veckas övningar och uppgifter. Jag har aldrig jobbat med något liknande ramverk så det kommer nog bli en utmaning. Det går nog inte riktigt att jämföra Anax med Python’s Flask, men jag har spanat in PHP’s Laravel som ser otroligt intressant ut. Efter denna kurs kommer jag nog läsa vidare om Laravel för att utöka mina kunskaper då det i nuläget faktiskt lockar mer än Node och Django. 

Något som jag aldrig tänkt på tidigare kring PHP är hur snyggt man kan plantera HTML kod i en forloop i en fil som innehåller båda språken. Likt Jinja tillsammans med HTML så har jag aldrig sett denna typ av struktur vilket förvånar mig en hel del. I Htmlphp kursen så måste jag ha gjort någon liknande typ av hantering av data, men kan inte minnas att denna metod var använd på det här viset.  

Det känns bra att ha starkare grunder för Github inför kursmomentet, jag ska försöka ha som mål att göra fler commits, men jag vet hur svårt det är att hålla det löftet. Practice makes perfect. 



Kmom02
-------------------------

Det var rätt roligt att jobba i ramverket denna vecka. Instruktionerna som kom med uppgiften gick igenom grunderna bra så att portera spelet från ens egna filer var relativt smärtfritt. På många vis så liknar det Flask genom att dela upp varje uppgift till en egen sektion. Klassen tar han dom strukturen för vad information man ska ha tillgång till, routen hämtar relevant och nödvändig data och vyn tar emot datan och försöker skapa en fin representation för användaren att jobba med. Detta är nog en populär teknik för ramverk att använda då alla arbetsuppgifter är bra indelade och minimerar misstag. Jag skulle inte vilja gå tillbaka till vanlig ren PHP för att bygga en hemsida. Det känns så klumpigt att blanda HTML och PHP med en drös if-satser för att kolla upp om applikationen fungerar som den ska.

Det är lite för tidigt för mig att ha en åsikt kring hur hjälpfullt genererad dokumentation är för att förstår hur en applikation fungerar. Det är rätt smidigt att få en snabb överblick till var metoder åstadkommer men hittills så kan jag inte utnyttja den informationen på ett bra sätt. Jag hade uppskattat om den är kunde generera en mindre UML version som tydligare visar hur klasser är kopplade till varandra. Kanske är det för mycket att fråga efter då jag inte vet hur stort allting sträcker sig.

Av någon anledning så krånglade min genererade dokumentation. Under förklaringen för metoderna kom ett error på flera hundra rader. Jag är inte helt säker på vad som orsakade problemet men det är möjligt att det var för att jag hade flera parametrar än efterfrågat på ett av mina objekt. I förra kursmomentet ville jag att man skulle få ett resultat som visade hur många försök man tog på sig men lyckades inte hantera informationen (förutom med sessioner) så jag strök det. PHP bryr sig inte om jag instansierar med för många parametrar så jag brydde mig inte mer om det. Hursomhelst så försvann meddelandet om jag reducerade till det korrekta antalet och genererade om dokumentationen. 

Jag lärde mig denna vecka att Anax tar han om sessionen för användaren. Jag försökte manipulera den genom att ge mitt egen namn men det gick inte. Tydligen så tar en av modulerna han om den och jag blev tipsad att kika vidare på hur den fungerar eftersom vi kommer jobba med den i senare kursmoment. 




Kmom03
-------------------------

Detta var en intressant vecka tycker jag. Jag hade väldigt stora problem med tärningsspelet 100 och det tog på tok för mycket tid att lösa uppgiften och jag tappade en del motivation. Som tur var fick jag i alla fall en bättre överblick på vad enhetstester faktiskt åstadkommer. Tidigare har jag alltid tyckt att dom är meningslösa och inte tillför något men nu har jag lite mer respekt för dom. Något som är lite tråkigt med kodteckning är ju hur lite det faktiskt ibland kan betyda. 100% kodteckning kan jag tycka är näst in till irrelevant då den kan testa för så lite fall. Det gäller att man bygger många testfall om man ska våga lita på att den redigerat metod faktiskt beter sig som förväntat. 
 
Jag har tidigare gjort enhetstester i Python vilket gav en idé för hur strukturen skulle se ut. Nytt för PHP var dock hur PHPUnit kan skriva ut statistik för hur mycket av klasserna som är testat. Det finns säkert liknande verktyg för Python vilket jag förmodligen kommer kolla upp någon dag. Mycket av den kod som jag skrev för spelet blev rätt kluddig. Den är relativt läsbar men jag lyckades inte komma på simpla metoder för att lösa problem eller läsa vart spelet befinner sig. Jag hade hellre kortat ner längden på metoderna och gjort fler av dom men efter att ha börjat om 2 gånger redan så kunde jag inte komma på ett effektivare sätt. 

Mitt TIL för denna veckan är hur mycket logik det gick att klämma in i klasserna. När jag lästa om uppgiften så fick jag direkt känslan av att hela spelet nästan skulle utspelas i routen och att klasserna mest bara skulle dela ut poäng och returerna resultat till vyn. Det blev mest bara att instansiera i routen och sedan passa vidare spelets objekt i sessionen. Jag valde att använda 2 extra routes när det kom till att hantera anrop för att rulla tärningarna igen eller stanna på den poäng som man lyckats skrapa ihop. Jag valde även att göra några extra tester för att få lite mer grönt på resultatet av PHPUnit. Med många setters och getters så krävdes det några extra för att få bort det röda och gula från den genererade sidan. Det känns bra att ha koll på all kod som ska testas i alla fall. Jag vet inte ens hur jag skulle testa kod som jag inte har tillgång till. Det är väldigt viktigt att den som skrev dom metoderna använder bra namn för att testaren ska kunna göra bra tester. 



Kmom04
-------------------------

Intelligensen för min hemsida var relativt simpel. Sedan tidigare kursmoment hade jag redan kodat in lite IQ så jag valde att bygga lite mer på det. Mestadels var det tankegångar som en vanlig människa skulle ha om man spelade liknande spel. Om det är för stort mellanrum mellan sina egna poäng och motståndarens så är det dags att börja riskera lite för att komma ikapp eller om man är nära mållinjen så slår man en gång till. Kanske hade varit lite roligare om man skrev ut en lite mer “verbose” händelsehistorik i spelet, men det är något att tänka på till nästa gång.  

Jag visste inte att traits existerade i något programmeringsspråk. Det var väldigt intressant att jobba med. Det kändes väldigt farligt i början då en referens görs via nyckelordet “this”. Det kan skapa eventuella falluckor i koden tycker jag eftersom det ser ut som om klassen själv har den koden. Annars är det väldigt händigt att kunna utöka klasserna på detta vis utan att behöva stöka ner en mall som redan kort och gott gör sitt jobb. Mitt TIL för denna vecka är nog bara att denna teknologi finns i PHP och kanske till och med i andra språk. Känns väldigt bra då vissa klasser ibland delar användningsområden och man behöver inte ärva från en annan fil.  

Interfaces har jag lite skilda åsikter om. Dom känns lite som enhetstester som ser till att en utlovad metod verkligen finns i klassen. Just nu kan jag inte riktigt se hur mycket det kommer komma till hands när man gör ett projekt men det skadar väl inte att dom finns redo att användas. I början var det lite förvirrande eftersom ett interface kan lova att en metod som är implementerad i en klass även om den kommer från en trait. 

För varje vecka som går så tycker jag allt mer och mer om ramverket måste jag säga. Det ser ju lite snyggare ut att hämta variabler via en metod istället för från dom globala verktyg som kommer med PHP. Jag är inte helt säker på vad Anax gör innan den returnerar det från metoden. Kanske den filtrerar möjliga injektioner, eller så hämtar den bara informationen helt enkelt. Jag gjorde mer eller mindre alla mina testfall i förra veckans kursmoment så jag behövde inte göra så mycket inom ramverket för detta område.



Kmom05
-------------------------

Det är möjligt att jag missuppfattat denna veckas uppgift kring ramverket. Det gick rätt bra att jobba igenom övningen för kursmomentet, tillsammans med den kunskap från databas och htmlphp så var det inga större frågetecken på vad som sker när jag följer dom kodexemplen som vi blev försedd med. Om jag hade fått valt själv så hade jag delat in uppgiften i flera routes och vyer. Några av dom skulle kunna lyssna på ett “wildcard” för att hämta rätt information från databasen. Istället följde jag övningen närmare vilket gjorde att strukturen inte blev riktigt lika snygg tycker jag, men den fungerar i alla fall. 

Det var intressant att se hur man på riktigt sätter upp en miljö för utveckling och en förproduktion till en applikation som kan publiceras för allmänheten att använda. Jag har inte riktigt tänkt på att det kan vara så simpelt som att kika på vad servervariabeln har för information att dela av sig med och sedan returnera relevant konfiguration.  

Vid några tillfällen så hade jag problem att lägga till formulär till hemsidan för att hämta data om filmerna. Jag beslöt mig för att använda mig av små vyer och fästa dom via ramverket på den route som tar hand om filmhanteringen. När informationen är hämtad och en query kan skapas till mysql så valde jag att skicka vidare informationen via anax egna “redirect” modul vilket fungerade väldigt bra. Jag hade faktiskt ingen aning om att man kunde spara både post och get data samtidigt i en vy. Det är verkligen min TIL för denna veckas arbete. 

Med tanke på att jag ligger efter i arbete så valde jag inte att utöka funktionaliteten för hemsidan något mer än dom krav dom behövdes. Jag skummade igenom extra uppgifterna och gjorde en mental överblick för hur jag skulle strukturera den koden. Under inspektionen så lärde jag mig även att det går att skriva terminalkommandon rakt in i PHP med hjälp av inbyggda funktioner. Mycket bra att veta inför framtiden när jag jobbar med detta språk. Detta bygger ut min TIL ännu mer skulle jag vilja säga eftersom det är ett rätt viktigt verktyg att veta om och kunna använda på ett effektivt sätt.


Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
