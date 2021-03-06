<div id="help-template" class="outer">
    <h1 class="head">Help:
        <a class="ui-corner-all tooltip" href="<{$xoops_url}>/modules/<{$smarty.const._MI_WFL_DIRNAME}>/admin/index.php"
           title="Back to the administration of <{$smarty.const._MI_WFL_NAME}>"> <{$smarty.const._MI_WFL_NAME}>
            <img src="<{xoAdminIcons home.png}>"
                 alt="Back to the Administration of <{$smarty.const._MI_WFL_NAME}>">
        </a></h1>
    <title>Link Management</title>


    <p><strong><font size="+2" face="Verdana, Arial, Helvetica, sans-serif"><u>Link Management</u></font></strong></p>
    <p>&nbsp;</p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Gebruik de Link Management om nieuwe linken aan te
        maken.<br>
        Dit formulier heeft de volgende velden/opties:</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link titel</strong></u><br>
        Voer hier de naam in voor de nieuwe link.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link url</strong></u><br>
        Voer hier de url in van de nieuwe link.<br>
        Klik op het wereldbol icoon om de url in het invoerveld te openen in een browser tab/venster.<br>
        U kunt dit icoon gebruiken als knop om de url te kontrolleren.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link hoofd categorie</strong></u><br>
        Kies de hoofd categorie voor de link.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link omschrijving</strong></u><br>
        Hier kunt u een omschrijving geven van de link.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Keywords</strong></u><br>
        In dit veld kunt u de meta keywords invoeren. Voer de keywords in als: keyword1, keyword2, keyword3, ...<br>
        Het maximaal aantal karakters kan bij Instelling worden ingestelt.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link screenshot
        afbeelding</strong></u><br>
        Screenshot afbeelding dienen een geplaatst te zijn in de map <font face="Courier New, Courier, monospace">uploads/images/screenshots</font>
        (bijv. shot.gif).<br>
        Kies <em>Geen afbeelding</em> om geen screenshot te laten zien.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Google Kaarten, Yahoo Kaarten en
        Multimap</strong></u><br>
        Deze drie velden kunnen gebruikt worden om een url in te voeren naar een online kaart.<br>
        Klik op een van de drie iconen om een nieuwe tab/venster in de browser te open.<br>
        Bij Multimap en Yahoo Kaarten kunt u de url boven in de browser gebruiken. <br>
        Bij Google Kaarten dient u op link te klikken rechtsboven de kaart. Er opent dan een venstertje met de url die u
        bij WF-Links kunt invoeren.</font><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> <br>
        U kunt de iconen of knoppen gebruiken om de kaart-url te kontrolleren of te wijzigen.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Adres velden</strong></u><br>
        Gebruik deze velden om Kontakt Gegevens aan de link toe te geven. Het adres wordt samengestelt aan de hand van
        het land.<br>
        Als u een ander adres formaat wenst dient u het bestand <font face="Courier New, Courier, monospace">../include/address.php</font>
        te bewerken.<br>
        Voor informatie over adres formaten zie de <a
                href="http://www.upu.int/post_code/en/postal_addressing_systems_member_countries.shtml" target="_blank"><strong>Universal
            Postal Union</strong></a> website.<br>
        Email adresen kunnen op 2 manieren ingevoerd worden:</font></p>
    <ul>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">naam@adres.com</font></li>
        <li><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">mailto:naam@adres.com</font></li>
    </ul>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Beide email formaten worden automatisch omgezet
        naar: name AT address DOT com</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Stel publikatiedatum in</strong></u><br>
        Geef de datum waarop de link gepubliceerd dient te worden.<br>
        De tijd gaat in stappen van 10 minuten.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link verloopdatum</strong></u><br>
        Hier kunt u een verlooptijd instellen voor de link. De link zal dan vanaf de ingestelde tijd niet meer zichtbaar
        zijn voor bezoekers.<br>
        U kunt met deze optie de verloopdatum ook weer verwijderen.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link offline plaatsen</strong></u><br>
        Kies <em>Ja</em> om de link offline te plaatsen. De link is dan niet langer zichtbaar voor bezoekers.<br>
        Standaard: <em>Nee</em></font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Link status weergeven als
        bijgewerkt</strong></u><br>
        Kies <em>Ja</em> om de link als Bijgewerkt (updated) aan te duiden. <br>
        Een icoon verschijnt achter de titel om bezoekers erop te wijzen dat de inhoud van de link is bijgewerkt.<br>
        U dient hiervoor ook de publikatiedatum in te stellen op de huidige datum en tijd.<br>
        Standaard: <em>Nee</em></font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Discussieer in dit forum
        toevoegen</strong></u><br>
        Kies een forum en een icoon will geplaatst worden om de link dat forum te bespreken.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Nieuwe link inzenden als
        nieuwsbericht</strong></u><strong>*</strong><br>
        Maak een nieuwsbericht in de module News over de nieuwe link<br>
        Standaard: <em>Nee</em></font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><u><strong>Selekteer nieuwscategorie om
        nieuwsbericht in te zenden</strong></u><strong>*</strong><br>
        Kies een categorie om het nieuwsbericht in te plaatsen.</font></p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong><u>Nieuwstitel</u>*</strong><br>
        Voer hier de titel van het nieuwsbericht in.<br>
        Laat het veld leeg om de link titel te gebruiken.</font></p>
    <p>&nbsp;</p>
    <p><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">* De velden voor het plaatsen van een nieuwsbericht
        verschijnen alleen als de <em>News</em> module geïnstalleerd is</font><font size="-2"
                                                                                    face="Verdana, Arial, Helvetica, sans-serif">.</font><br>
    </p>
    <p>&nbsp;</p>

    <!-- -----Help Content ---------- -->

</div>
