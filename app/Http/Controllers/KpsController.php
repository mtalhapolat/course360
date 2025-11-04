<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpsController extends Controller
{
    public static function insertstudent($identity, $birthday, $phone)
    {

        if ($identity == null || $birthday == null) {
            return "identityempty";
        }

        $date = strtotime($birthday);

        $birthday = date('Y-m-d',$date);

        $student = student::where('identity', $identity)->where('birthday', $birthday)->first();

        if ($student) {
            $kpsresult = self::kpsbridge($identity, $birthday);
            if ($kpsresult != null) {
                $student->city = $kpsresult['city'];
                $student->town = $kpsresult['town'];
                $student->district = $kpsresult['district'];
                $student->street = $kpsresult['street'];
                $student->exteriorDoor = $kpsresult['exteriorDoor'];
                $student->interiorDoor = $kpsresult['interiorDoor'];
                $student->address = $kpsresult['address'];
                $student->nationality = $kpsresult['nationality'];
                $student->save();
            }
            if ($student->phone == null && $phone != null) {
                $student->phone = $phone;
                $student->save();
            }
            return $student;
        } else {

            $kpsresult = self::kpsbridge($identity, $birthday);

            if ($kpsresult == null)
                return "identityerror";
            else {
                if ($kpsresult['gender'] == 1)
                    $studentimage = 'male.png';
                else
                    $studentimage = 'female.png';

                $newstudentid = DB::table('students')->insertGetId([
                    'name' => $kpsresult['name'],
                    'surname' => $kpsresult['surname'],
                    'identity' => $identity,
                    'birthday' => $birthday,
                    'nationality' => $kpsresult['nationality'],
                    'motherName' => $kpsresult['motherName'],
                    'fatherName' => $kpsresult['fatherNam'],
                    'gender' => $kpsresult['gender'],
                    'image' => $studentimage,
                    'birthPlace' => $kpsresult['birthPlace'],
                    'maritalStatus' => $kpsresult['maritalStatus'],
                    'identitySerial' => $kpsresult['SeriNo'],
                    'city' => $kpsresult['city'],
                    'town' => $kpsresult['town'],
                    'district' => $kpsresult['district'],
                    'street' => $kpsresult['street'],
                    'exteriorDoor' => $kpsresult['exteriorDoor'],
                    'interiorDoor' => $kpsresult['interiorDoor'],
                    'address' => $kpsresult['address'],
                    'statu' => "active"
                ]);
                $newstudent = Student::where('id', $newstudentid)->first();
                if ($newstudent != null) {
                    if ($phone != null) {
                        $newstudent->phone = $phone;
                        $newstudent->save();
                    }
                    return $newstudent;
                } else {
                    return "error";
                }
            }
        }
    }

    public static function kpsbridge($identity, $birthday)
    {

        // API URL
        $url = 'https://iletisimapi.beyoglu.bel.tr/http';

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $action = "authenticateMember";
        $params = array(
            'username' => 'kpsbilgiislem',
            'password' => '302010bB**',
            'language'=> "tr"
        );
        $sp = array(
            'currentCompanyId' => 3443,
            'platform' => '3rdParty',
            'language'=> "tr"
        );

        $payload = json_encode(array("action" => $action, "params" => $params, "SP" => $sp));

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);

        if ($result == null) {
            return null;
        }

        $arr=explode('"', $result);
        $arr2=explode(':', $arr[10]);
        $arr3=explode(',', $arr2[1]);

        $url = 'https://iletisimapi.beyoglu.bel.tr/http';

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $action = "getCollocutorFromNvi";
        $params = array(
            'identityNumber' => $identity,
            'birthdate' => $birthday
        );
        $sp = array(
            'currentCompanyId' => 3443,
            'platform' => '3rdParty',
            'language'=> "tr",
            'originatorMemberId' => (int)$arr3[0],
            'proxyMemberId' => null,
            'sessionId'=> $arr[15]
        );
        $payload = json_encode(array("action" => $action, "params" => $params, "SP" => $sp));

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);

        if ($result == null) {
            return null;
        }

        $resultarr = json_decode($result, true);

        if ($resultarr['code'] != 0)
            return null;

        if (isset($resultarr["data"]["collocutor"]["nationalityDescription"])){
            $kpsresult['nationality'] = $resultarr["data"]["collocutor"]["nationalityDescription"];
        }

        $kpsresult['name'] = $resultarr["data"]["collocutor"]["name"];
        $kpsresult['surname'] = $resultarr["data"]["collocutor"]["surname"];
        $kpsresult['motherName'] = $resultarr["data"]["collocutor"]["motherName"];
        $kpsresult['fatherNam'] = $resultarr["data"]["collocutor"]["fatherName"];
        $kpsresult['identityNumber'] = $resultarr["data"]["collocutor"]["identityNumber"];
        $kpsresult['gender'] = $resultarr["data"]["collocutor"]["genderId"];
        $kpsresult['birthPlace'] = $resultarr["data"]["collocutor"]["birthPlace"];
        $kpsresult['maritalStatus'] = $resultarr["data"]["collocutor"]["maritalStatusId"];
        $kpsresult['birthday'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Gun"];
        $kpsresult['birthmonth'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Ay"];
        $kpsresult['birthyear'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Yil"];
        $kpsresult['SeriNo'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["SeriNo"];

        if ($resultarr["data"]["address"] == null) {
            $kpsresult['city'] = null;
            $kpsresult['town'] = null;
            $kpsresult['district'] = null;
            $kpsresult['street'] = null;
            $kpsresult['exteriorDoor'] = null;
            $kpsresult['interiorDoor'] = null;
            $kpsresult['address'] = null;

            if ($kpsresult['nationality'] != 'TR' && $kpsresult['nationality'] != 'TC') {
                $newidentity = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["YabanciKisiKutukleri"]["KisiBilgisi"]["KazanilanTCKimlikNo"];
                $kpsresultforeign = self::kpsbridgeforeignaddress($newidentity, $birthday);
                if (isset($kpsresult['SeriNo']))
                    $kpsresult['SeriNo'] = $kpsresultforeign['SeriNo'];
                if (isset($kpsresult['birthmonth']))
                    $kpsresult['birthmonth'] = $kpsresultforeign['birthmonth'];
                if (isset($kpsresult['birthyear']))
                    $kpsresult['birthyear'] = $kpsresultforeign['birthyear'];
                if (isset($kpsresult['birthday']))
                    $kpsresult['birthday'] = $kpsresultforeign['birthday'];

                if (isset($kpsresult['address'])) {
                    $kpsresult['city'] = $kpsresultforeign['city'];
                    $kpsresult['town'] = $kpsresultforeign['town'];
                    $kpsresult['district'] = $kpsresultforeign['district'];
                    $kpsresult['street'] = $kpsresultforeign['street'];
                    $kpsresult['exteriorDoor'] = $kpsresultforeign['exteriorDoor'];
                    $kpsresult['interiorDoor'] = $kpsresultforeign['interiorDoor'];
                    $kpsresult['address'] = $kpsresultforeign['address'];
                }
            }

        } else {
            $kpsresult['city'] = $resultarr["data"]["address"]["cityDescription"];
            $kpsresult['town'] = $resultarr["data"]["address"]["townDescription"];
            $kpsresult['district'] = $resultarr["data"]["address"]["districtDescription"];
            $kpsresult['street'] = $resultarr["data"]["address"]["streetDescription"];
            $kpsresult['exteriorDoor'] = $resultarr["data"]["address"]["exteriorDoorNumber"];
            $kpsresult['interiorDoor'] = $resultarr["data"]["address"]["interiorDoorNumber"];
            $kpsresult['address'] = $resultarr["data"]["address"]["explicitAddress"];
        }

        return $kpsresult;
    }

    public static function kpsbridgeforeignaddress($identity, $birthday)
    {

        // API URL
        $url = 'https://iletisimapi.beyoglu.bel.tr/http';

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $action = "authenticateMember";
        $params = array(
            'username' => 'kpsbilgiislem',
            'password' => '302010bB**',
            'language'=> "tr"
        );
        $sp = array(
            'currentCompanyId' => 3443,
            'platform' => '3rdParty',
            'language'=> "tr"
        );

        $payload = json_encode(array("action" => $action, "params" => $params, "SP" => $sp));

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);

        $arr=explode('"', $result);
        $arr2=explode(':', $arr[10]);
        $arr3=explode(',', $arr2[1]);

        $url = 'https://iletisimapi.beyoglu.bel.tr/http';

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $action = "getCollocutorFromNvi";
        $params = array(
            'identityNumber' => $identity,
            'birthdate' => $birthday
        );
        $sp = array(
            'currentCompanyId' => 3443,
            'platform' => '3rdParty',
            'language'=> "tr",
            'originatorMemberId' => (int)$arr3[0],
            'proxyMemberId' => null,
            'sessionId'=> $arr[15]
        );
        $payload = json_encode(array("action" => $action, "params" => $params, "SP" => $sp));

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);

        $resultarr = json_decode($result, true);

        if ($resultarr['code'] != 0)
            return null;

        return $resultarr;

        if ($resultarr["data"]["address"] == null) {
            $kpsresult['city'] = null;
            $kpsresult['town'] = null;
            $kpsresult['district'] = null;
            $kpsresult['street'] = null;
            $kpsresult['exteriorDoor'] = null;
            $kpsresult['interiorDoor'] = null;
            $kpsresult['address'] = null;

        } else {
            $kpsresult['city'] = $resultarr["data"]["address"]["cityDescription"];
            $kpsresult['town'] = $resultarr["data"]["address"]["townDescription"];
            $kpsresult['district'] = $resultarr["data"]["address"]["districtDescription"];
            $kpsresult['street'] = $resultarr["data"]["address"]["streetDescription"];
            $kpsresult['exteriorDoor'] = $resultarr["data"]["address"]["exteriorDoorNumber"];
            $kpsresult['interiorDoor'] = $resultarr["data"]["address"]["interiorDoorNumber"];
            $kpsresult['address'] = $resultarr["data"]["address"]["explicitAddress"];
        }

        $kpsresult['SeriNo'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["SeriNo"];
        $kpsresult['birthday'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Gun"];
        $kpsresult['birthmonth'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Ay"];
        $kpsresult['birthyear'] = $resultarr["data"]["collocutor"]["KPSSorguMesaj"]["SorguSonucu"][0]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"]["DogumTarih"]["Yil"];

        return $kpsresult;
    }
}
