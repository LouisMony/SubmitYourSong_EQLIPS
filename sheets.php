<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form GSheets</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <div class="confirmation" id="confirmation">
          T'as prod a bien été envoyé bg ! <br/> <br/>
          Rejoins nous sur <a href="https://www.twitch.tv/namsco_" target="_blank">Twitch</a> <br/><br/>
          <br/>
          <a href="index.html">
              <button class="button">Retour</button>
          </a>
    </div>

    <div class="logo">
        <img src="media/img/logo.png" alt="logo">
    </div>

    <?php
        $range = "page1";
        $name = $_POST['name'];
        $link = $_POST['link'];
        $insta = $_POST['insta'];
        $message = $_POST['message'];
        $categorie = $_POST["Categorie"];

        if($categorie == "ligue"){
            $range = "page1";
        }
        else if ($categorie == "ecouteprod"){
            $range = "page2";
        }


        require __DIR__ . '/vendor/autoload.php';

        $client = new \Google_Client();
        $client -> setApplicationName('Google Sheets and PHP');
        $client -> setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client -> setAccessType('offline');
        $client -> setAuthConfig(__DIR__ . "/credentials.json");

        $service = new Google_Service_Sheets($client);
        $spreadsheetId = "1rgQRABB1St2nuEKJ4crQB7pR_ZCvlCRU-IfU8Z6Z8aI";

        
        
        $values = [
            [$name, $insta, $link, $message ]
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];

        $result = $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
    ?>

</body> 
</html>