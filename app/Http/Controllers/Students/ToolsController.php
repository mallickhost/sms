<?php

namespace App\Http\Controllers\Students;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{
    public function index()
    {
        // Session::flash('success', 'Successfully registerd now login');
        return view('pages/contact-us');
    }



    public function doTest()
    {
        echo "<Pre/>";

        $storage_path = storage_path('docs/certs/');


        //https://vrs-api.test.tracktraceweb.com/verify/gtin/
        //https://api-int.vrs.optelcloud.com/verify/gtin/
        //'https://ld.movilitas.cloud/verify/gtin/';


        $pemfile = $storage_path.'marrk.crt'; //change according to the client
        $setUrl ='https://ld.movilitas.cloud/verify/gtin/';


        $gtin ='00338300905276';
        $lot = 'MVC008';
        $ser = 'JU8NNNSJ02R7ZL';

        $url = $setUrl.$gtin."/lot/".$lot."/ser/".$ser;

        $dataArray = [
            'exp' => '250531',
            'linkType' => 'verificationService',
            'context' => 'dscsaSaleableReturn',
            'reqGLN' => '0338300871687',
            'corrUUID' => '08dd5e1b-78e7-4dee-9f55-e69f5edf099b',
            'ctrlPossessAtt' => 'true',
            'email' => 'demo@mail.com',
            'telephone' => '9874563210'
        ];

        $data = http_build_query($dataArray);

        $getUrl = $url."?".$data;

        $arr_header = [];

        $arr_header[] = 'Content-type: application/json';
        // $arr_header[] = 'GS1US-Version: 1.3.0'; // VRS 1.3 this header is mandatory
        $arr_header[] = 'Authorization: c9ce748f59449fd47dc4ee8d99c95eb8:S:16f1d0129f4630057bae0e6489382a236c26057003717ed65f54f3f2de60ea782ab7d8f4d64ea208bbb28eaf87';


        $tempPemFile = tmpfile();
        fwrite($tempPemFile, $pemfile);
        $tempPemPath = stream_get_meta_data($tempPemFile);
        $tempPemPath = $tempPemPath['uri'];

        $getUrl = 'https://optapi.pre-test.tracktraceweb.com/2.0/inventory/basic_query/gs1_barcode?gs1_barcode=011070707001010221315707299749245%1D1725060710AFC33FA8';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getUrl);


        curl_setopt($ch, CURLOPT_HTTPHEADER, $arr_header);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking

        curl_setopt($ch, CURLOPT_CAINFO, $pemfile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        $response = curl_exec($ch);

        // Then, after your curl_exec call:
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerSrt = substr($response, 0, $headerSize);
        $arrHeader = $this->headersToArray($headerSrt);
        $bodyStr = substr($response, $headerSize);
        $arrBody = json_decode($bodyStr, true);


        fclose($tempPemFile);
        curl_close($ch);



        echo $httpcode."<br>";
        print_r($arrHeader);
        print_r($arrBody);

        echo "<br><br><br><br><br>";
        die('***********************');



    }

    public function ok_doTest()
    {
        echo "<Pre/>";

        $storage_path = storage_path('docs/certs/');


        //https://vrs-api.test.tracktraceweb.com/verify/gtin/{gtin}/lot/{lot}/ser/{ser}
        //https://api-int.vrs.optelcloud.com/checkConnectivity
        //'https://ld.movilitas.cloud/verify/gtin/';


        $pemfile = $storage_path.'vrs.crt'; //change according to the client
        $setUrl ='https://vrs-api.test.tracktraceweb.com/verify/gtin/';


        $gtin ='20369499330604';
        $lot = 'LOT1544001';
        $ser = '1002303';

        $url = $setUrl.$gtin."/lot/".$lot."/ser/".$ser;

        $dataArray = [
            'exp' => '220524',
            'linkType' => 'verificationService',
            'context' => 'dscsaSaleableReturn',
            'reqGLN' => '0369499000008',
            'corrUUID' => '08dd5e1b-78e7-4dee-9f55-e69f5edf099b',
            'ctrlPossessAtt' => true,
            'email' => 'demo@mail.com',
            'telephone' => '9874563210'
        ];

        $data = http_build_query($dataArray);

        $getUrl = $url."?".$data;

        $arr_header = [];

        $arr_header[] = 'Content-type: application/json';
        // $arr_header[] = 'GS1US-Version: 1.3.0'; // VRS 1.3 this header is mandatory
        // $arr_header[] = 'Authorization: c9ce748f59449fd47dc4ee8d99c95eb8:S:16f1d0129f4630057bae0e6489382a236c26057003717ed65f54f3f2de60ea782ab7d8f4d64ea208bbb28eaf87';


        $tempPemFile = tmpfile();
        fwrite($tempPemFile, $pemfile);
        $tempPemPath = stream_get_meta_data($tempPemFile);
        $tempPemPath = $tempPemPath['uri'];

        // $getUrl = 'https://optapi.pre-test.tracktraceweb.com/2.0/inventory/basic_query/gs1_barcode?gs1_barcode=011070707001010221315707299749245%1D1725060710AFC33FA8';


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        // curl_setopt($ch, CURLOPT_SSLCERT, $tempPemPath);
        // curl_setopt($ch, CURLOPT_SSLCERTTYPE, "PEM");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $arr_header);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking

        curl_setopt($ch, CURLOPT_CAINFO, $pemfile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        $response = curl_exec($ch);

        // Then, after your curl_exec call:
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerSrt = substr($response, 0, $headerSize);
        $arrHeader = $this->headersToArray($headerSrt);
        $bodyStr = substr($response, $headerSize);
        $arrBody = json_decode($bodyStr, true);


        fclose($tempPemFile);
        curl_close($ch);



        echo $httpcode."<br>";
        print_r($arrHeader);
        print_r($arrBody);

        echo "<br><br><br><br><br>";
        die('***********************');



    }

   public function headersToArray($str)
   {
       $headers = array();
       $headersTmpArray = explode("\r\n", $str);
       for ($i = 0 ; $i < count($headersTmpArray) ; ++$i) {
           // we dont care about the two \r\n lines at the end of the headers
           if (strlen($headersTmpArray[$i]) > 0) {
               // the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
               if (strpos($headersTmpArray[$i], ":")) {
                   $headerName = substr($headersTmpArray[$i], 0, strpos($headersTmpArray[$i], ":"));
                   $headerValue = substr($headersTmpArray[$i], strpos($headersTmpArray[$i], ":")+1);
                   $headers[$headerName] = $headerValue;
               }
           }
       }
       return $headers;
   }

    public function x_doTest()
    {

        //https://blog.devgenius.io/how-to-get-the-response-headers-with-curl-in-php-2173b10d4fc5

        $storage_path = storage_path('docs/certs/');

        //https://vrs-api.test.tracktraceweb.com/verify/gtin/{gtin}/lot/{lot}/ser/{ser}

        $gtin ='20369499330604';
        $lot = 'LOT1544001';
        $ser = '1002303';

        $url = "https://vrs-api.test.tracktraceweb.com/verify/gtin/".$gtin."/lot/".$lot."/ser/".$ser;

        $dataArray = [
            'exp' => '220524',
            'linkType' => 'verificationService',
            'context' => 'dscsaSaleableReturn',
            'reqGLN' => '0369499000008',
            'corrUUID' => '08dd5e1b-78e7-4dee-9f55-e69f5edf099b',
            'ctrlPossessAtt' => true,
            'email' => 'demo@mail.com',
            'telephone' => '9874563210'
        ];

        $data = http_build_query($dataArray);

        $getUrl = $url."?".$data;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_SSLCERT, $storage_path.'vrs_test.pem');
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, "PEM");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch);



        curl_close($ch);

        echo "<pre/>";
        print_r($result);

        echo "<br><br><br><br><br>";
        die('***********************');



    }


}
