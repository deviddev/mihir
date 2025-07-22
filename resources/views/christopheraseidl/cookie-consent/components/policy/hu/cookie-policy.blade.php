<div id="cookie-policy">
    <livewire:cookie-consent-changer />

    <h1><strong>{{ config('app.name') }}</strong> tájékoztatást ad a sütik használatáról weboldalán: <a
            href="{{ config('app.url') }}">{{ config('app.url') }}.</a></h1>

    <h2>Mik azok a sütik?</h2>

    <p>A sütik olyan fájlok, amelyeket a weboldalak letölthetnek a számítógépedre. Ezek olyan eszközök, amelyek alapvető
        szerepet játszanak számos információs társadalmi szolgáltatás nyújtásában. Többek között lehetővé teszik a
        weboldal számára, hogy információt tároljon és kérjen le a felhasználó vagy a számítógép böngészési szokásairól,
        és a megszerzett információktól függően felhasználhatók a felhasználó azonosítására és a szolgáltatás
        fejlesztésére.</p>

    <h2>A sütik típusai</h2>

    <p>Attól függően, hogy ki az az entitás, amely a domain kezelését végzi, ahonnan a sütik érkeznek, és ki kezeli az
        így nyert adatokat, két típus különböztethető meg:</p>

    <ol>
        <li>Saját sütik: ezek a felhasználó eszközére olyan számítógépről vagy doménről kerülnek elküldésre, amelyet
            maga a szerkesztő kezel, és amelyről a felhasználó által kért szolgáltatás biztosított.</li>
        <li>Harmadik féltől származó sütik: ezek a felhasználó eszközére olyan számítógépről vagy doménről kerülnek
            elküldésre, amelyet nem a szerkesztő kezel, hanem egy másik entitás, amely az így nyert adatokat
            feldolgozza.</li>
    </ol>

    <p>Amennyiben a sütik olyan számítógépről vagy doménről kerülnek telepítésre, amelyet maga a szerkesztő kezel, de az
        információkat egy harmadik fél kezeli, ezek nem tekinthetők saját sütiknek.</p>

    <p>Van egy másik osztályozás is, az alapján, hogy mennyi ideig maradnak a sütik a weboldalon. Ezek lehetnek:</p>

    <ol>
        <li>Munkamenet sütik: az adatokat csak a weboldalhoz való hozzáférés ideje alatt gyűjtik és tárolják. Általában
            olyan információk tárolására használják, amelyek csak egyszeri szolgáltatásnyújtás során fontosak (pl.
            vásárolt termékek listája).</li>
        <li>Tartós sütik: az adatok hosszabb ideig tárolódnak az eszközön, és a süti kezelője által meghatározott ideig
            hozzáférhetők és feldolgozhatók, ami néhány perctől akár több évig is terjedhet.</li>
    </ol>

    <p>Végül létezik egy osztályozás a felhasználás célja szerint is:</p>

    <ol>
        <li>Technikai sütik: lehetővé teszik a felhasználó számára a weboldalon való navigálást, valamint az ott
            elérhető különféle funkciók és szolgáltatások használatát, például: adatforgalom és kommunikáció kezelése,
            munkamenet azonosítása, védett területekhez való hozzáférés, rendelés elemeinek megjegyzése, vásárlási
            folyamat lebonyolítása, regisztrációs vagy eseményrészvételi űrlapok kezelése, biztonsági funkciók
            használata, videó- vagy hangtartalom tárolása, tartalommegosztás közösségi médián keresztül.</li>
        <li>Testreszabási sütik: lehetővé teszik, hogy a felhasználó a szolgáltatáshoz előre beállított jellemzőkkel
            férjen hozzá, például nyelv, böngésző típusa vagy földrajzi elhelyezkedés alapján.</li>
        <li>Elemzési sütik: lehetővé teszik, hogy a kezelő figyelemmel kísérje és elemezze a weboldalak felhasználóinak
            viselkedését. Az ilyen típusú sütik által gyűjtött információkat a weboldalak, alkalmazások vagy platformok
            aktivitásának mérésére, valamint a felhasználói profilok készítésére használják a szolgáltatás fejlesztése
            érdekében.</li>
        <li>Reklámsütik: lehetővé teszik a hirdetési helyek leghatékonyabb kezelését.</li>
        <li>Viselkedésalapú reklámsütik: tárolják a felhasználók viselkedéséről szóló információkat, amelyeket a
            böngészési szokásaik folyamatos megfigyelésével nyernek, így személyre szabott hirdetéseket jeleníthetnek
            meg.</li>
        <li>Külső közösségi hálózati sütik: lehetővé teszik a látogatók számára, hogy kapcsolatba lépjenek különböző
            közösségi platformok tartalmaival (Facebook, YouTube, Twitter, LinkedIn stb.). Ezek a sütik csak a közösségi
            hálózatok felhasználói számára generálódnak, és használatukat az adott platform adatvédelmi szabályzata
            szabályozza.</li>
    </ol>

    <h2>Sütik letiltása és törlése</h2>

    <p>Lehetősége van arra, hogy engedélyezze, blokkolja vagy törölje a számítógépén telepített sütiket a böngésző
        beállításain keresztül. A sütik letiltása esetén bizonyos szolgáltatások nem biztos, hogy megfelelően működnek.
        A sütik letiltásának módja böngészőnként eltérő, de általában az Eszközök vagy Beállítások menüben található
        meg.</p>

    <p>További információt a böngésző súgójában találhat. A felhasználó bármikor kiválaszthatja, hogy mely sütiket
        engedélyezi ezen a weboldalon. A sütik engedélyezését, blokkolását vagy törlését a számítógépen telepített
        böngésző beállításaiban végezheti el:</p>

    <ul>
        <li><a href="{{ __('cookie-consent::links.microsoft_cookie_link') }}" target="_blank">Microsoft Internet Explorer
                vagy Microsoft Edge</a></li>
        <li><a href="{{ __('cookie-consent::links.firefox_cookie_link') }}" target="_blank">Mozilla Firefox</a></li>
        <li><a href="{{ __('cookie-consent::links.chrome_cookie_link') }}" target="_blank">Chrome</a></li>
        <li><a href="{{ __('cookie-consent::links.safari_cookie_link') }}" target="_blank">Safari</a></li>
        <li><a href="{{ __('cookie-consent::links.opera_cookie_link') }}" target="_blank">Opera</a></li>
    </ul>

    <h2>Használt sütik a(z) {{ config('app.url') }} oldalon</h2>

    <p>Az általunk használt sütik a következők:</p>

    <ul>
        <li>"cas_laravel_cookie_consent" – annak érzékelésére szolgál, hogy a felhasználó elfogadta-e a sütik
            használatát. Élettartama: pozitív válasz esetén egy év, negatív esetén egy hónap.</li>
        <li>"XSRF-TOKEN" – a weboldal védelmét szolgálja XSS támadások ellen.</li>
    </ul>

    <h2>A sütik elfogadása</h2>

    <p>{{ config('app.name') }} feltételezi, hogy Ön elfogadja a sütik használatát. Ugyanakkor minden bejelentkezéskor
        az oldal tetején vagy alján tájékoztatja Önt a süti szabályzatról annak érdekében, hogy tudomást szerezzen róla.
    </p>

    <p>A fenti információk ismeretében az alábbi műveletek hajthatók végre:</p>

    <ol>
        <li>A sütik elfogadása: ebben az esetben az értesítés nem jelenik meg újra a portál bármely oldalának
            megtekintésekor az aktuális munkamenet során.</li>
        <li>Elutasítás vagy bezárás: az értesítés eltűnik.</li>
        <li>Beállítások módosítása: a(z) <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> süti
            szabályzatának megtekintésével lehetősége van a sütik használatának elfogadására vagy elutasítására.</li>
    </ol>
</div>
