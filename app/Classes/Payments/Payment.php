<?php namespace LeadAssurance\Classes\Payments;

use Auth;
use Cart;
use Session;
class Payment{

    public static function payBoxData($data){
        $pbx_site = SITE;								//variable de test 1999888
        $pbx_rang = RANG;									//variable de test 32
        $pbx_identifiant = Identifiant;				//variable de test 3
        $user_data =Auth::user();
       //dd($data);
        //$pbx_cmd = 'votre n° de commande';								//variable de test cmd_test1
        $pbx_cmd ='cmd_actudata'.uniqid();
        //$pbx_porteur = 'email de l acheteur';							//variable de test test@test.fr
        //$pbx_porteur = 'gt@gmail.com';
        $pbx_porteur = $user_data->email;
        //$pbx_total = 'votre montant';									//variable de test 100
        $pbx_total =$data['montant'] ;
        // Suppression des points ou virgules dans le montant
        $pbx_total = str_replace(",", "", $pbx_total);
        $pbx_total = str_replace(".", "", $pbx_total);
        //$pbx_total =strval($data['montant']);
        Session::put('type_payment',$data['type']);

        // Paramétrage des urls de redirection après paiement    PACK
        if ($data['type'] == 'CART') {
            $pbx_effectue = PBX_EFFECTUE_CART;
        }else{
            $pbx_effectue = PBX_EFFECTUE_CRE;
        }
        
        $pbx_annule = PBX_ANNULE;
        $pbx_refuse = PBX_REFUSE;
        // Paramétrage de l'url de retour back office site
        $pbx_repondre_a =  PBX_REPONDRE_A;
        // Paramétrage du retour back office site
        $pbx_retour = 'Mt:M;Ref:R;Auto:A;Erreur:E;Trans:T';

        // Connection à la base de données
        // mysql_connect...
        // On récupère la clé secrète HMAC (stockée dans une base de données par exemple) et que l’on renseigne dans la variable $keyTest;
        $keyTest = KEY_TEST;
        //$keyTest = 'votre clé générée depuis le back office (admin.paybox.com)';


        // --------------- TESTS DE DISPONIBILITE DES SERVEURS ---------------

        $serveurs = array('tpeweb.paybox.com', //serveur primaire
            'tpeweb1.paybox.com'); //serveur secondaire
        $serveurOK = "";
        //phpinfo(); <== voir paybox
        foreach($serveurs as $serveur){
            $doc = new \DOMDocument();
            $doc->loadHTMLFile('https://'.$serveur.'/load.html');
            $server_status = "";
            $element = $doc->getElementById('server_status');
            if($element){
                $server_status = $element->textContent;}
            if($server_status == "OK"){
                // Le serveur est prêt et les services opérationnels
                $serveurOK = $serveur;
                break;}
            // else : La machine est disponible mais les services ne le sont pas.
        }
        //curl_close($ch); //<== voir paybox
        //curl_close($ch); <== voir paybox
        if(!$serveurOK){
            die("Erreur : Aucun serveur n'a ÈtÈ trouvÈ");}
        // Activation de l'univers de prÈproduction
        $serveurOK = 'preprod-tpeweb.e-transactions.fr';

        //CrÈation de l'url cgi paybox
        $serveurOK = 'https://'.$serveurOK.'/cgi/MYchoix_pagepaiement.cgi';
        // echo $serveurOK;



        //Création de l'url cgi paybox
        //$serveurOK = 'https://'.$serveurOK.'/cgi/MYchoix_pagepaiement.cgi';

        // --------------- TRAITEMENT DES VARIABLES ---------------

        // On récupère la date au format ISO-8601
        $dateTime = date("c");
       // dd($dateTime);
        // On crée la chaîne à hacher sans URLencodage
        $msg = "PBX_SITE=".$pbx_site.
            "&PBX_RANG=".$pbx_rang.
            "&PBX_IDENTIFIANT=".$pbx_identifiant.
            "&PBX_TOTAL=".$pbx_total.
            "&PBX_DEVISE=978".
            "&PBX_CMD=".$pbx_cmd.
            "&PBX_PORTEUR=".$pbx_porteur.
            "&PBX_REPONDRE_A=".$pbx_repondre_a.
            "&PBX_RETOUR=".$pbx_retour.
            "&PBX_EFFECTUE=".$pbx_effectue.
            "&PBX_ANNULE=".$pbx_annule.
            "&PBX_REFUSE=".$pbx_refuse.
            "&PBX_HASH=SHA512".
            "&PBX_TIME=".$dateTime;

        // echo $msg;

        // Si la clé est en ASCII, On la transforme en binaire
        $binKey = pack("H*", $keyTest);

        // On calcule l’empreinte (à renseigner dans le paramètre PBX_HMAC) grâce à la fonction hash_hmac et //
        // la clé binaire
        // On envoi via la variable PBX_HASH l'algorithme de hachage qui a été utilisé (SHA512 dans ce cas)
        // Pour afficher la liste des algorithmes disponibles sur votre environnement, décommentez la ligne //
        // suivante
        // print_r(hash_algos());

        $hmac = strtoupper(hash_hmac('sha512', $msg, $binKey));

        // La chaîne sera envoyée en majuscule, d'où l'utilisation de strtoupper()
        // On crée le formulaire à envoyer
        // ATTENTION : l'ordre des champs est extrêmement important, il doit
        // correspondre exactement à l'ordre des champs dans la chaîne hachée

        return [
            'SERVEUR'			=> $serveurOK,
            'PBX_SITE' 			=> $pbx_site,
            'PBX_RANG' 			=> $pbx_rang,
            'PBX_IDENTIFIANT'	=> $pbx_identifiant,
            'PBX_TOTAL' 		=> $pbx_total,
            'PBX_DEVISE' 		=> "978",
            'PBX_CMD' 			=> $pbx_cmd,
            'PBX_PORTEUR' 		=> $pbx_porteur,
            'PBX_REPONDRE_A'	=> $pbx_repondre_a,
            'PBX_RETOUR' 		=> $pbx_retour,
            'PBX_EFFECTUE' 		=> $pbx_effectue,
            'PBX_ANNULE' 		=> $pbx_annule,
            'PBX_REFUSE' 		=> $pbx_refuse,
            'PBX_HASH' 			=> "SHA512",
            'PBX_TIME' 			=> $dateTime,
            'PBX_HMAC' 			=> $hmac,

        ];

    }

}
