<?php


class paymentMethods
{
    private $paymentMethod;
    private $accessKey;
    private $secretKey;

    private $amount;
    private $cardNumber;
    private $cardName;
    private $cardExpiry;
    private $cardCVC;

    private $trackingNumber;
    private $invoiceNumber;
    private $firstName;
    private $lastName;
    private $houseNumber;
    private $streetAddress;
    private $city;
    private $state;
    private $zipCode;
    private $country;
    private $mobileNumber;
    private $email;





    function __construct(){
        $this->paymentMethod = null;
        $this->country = "USA";
        $this->accessKey = null;
        $this->secretKey = null;
    }

    public function setPaymentOption($paymentMethod = null,$accessKey = null,$secretKey = null,$amount = 0,$cardNumber = null, $cardName = null, $cardExpiry = null, $cardCVC = null){
        $this->paymentMethod = $paymentMethod;
        $this->accessKey     = $accessKey;
        $this->secretKey     = $secretKey;
        $this->amount        = $amount;
        $this->cardNumber    = $cardNumber;
        $this->cardName      = $cardName;
        $this->cardExpiry    = $cardExpiry;
        $this->cardCVC       = $cardCVC;
    }

    public function chargePayment($userData = []){

        $this->trackingNumber   = $userData["trackingNumber"];
        $this->invoiceNumber    = $userData["invoiceNumber"];
        $this->firstName        = $userData["firstName"];
        $this->lastName         = $userData["lastName"];
        $this->houseNumber      = $userData["houseNumber"];
        $this->streetAddress    = $userData["streetAddress"];
        $this->city             = $userData["city"];
        $this->state            = $userData["state"];
        $this->zipCode          = $userData["zipCode"];
        $this->mobileNumber     = $userData["mobileNumber"];
        $this->email            = $userData["email"];


        try{
            switch ($this->paymentMethod){
                case "BINARY_GATEWAYS" :
                    return $this->paymentBinaryGateways();
                default :
                    return response(403,"Sorry, Payment method is not set",$userData);
            }
        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    private function paymentBinaryGateways(){
        include_once __DIR__."/../sdk/sdkBinaryGateways.php";
        $sdkBinaryGateways = new sdkBinaryGateways();
        try{

            $sdkBinaryGateways->setLogin($this->accessKey);
            $sdkBinaryGateways->setBilling(
                $this->firstName,
                $this->lastName,
                "",
                $this->houseNumber,
                $this->streetAddress,
                $this->city,
                $this->state,
                $this->zipCode,
                $this->country,
                $this->mobileNumber,
                "",
                $this->email,
                ""
            );

            $sdkBinaryGateways->setShipping(
                $this->firstName,
                $this->lastName,
                "",
                $this->houseNumber,
                $this->streetAddress,
                $this->city,
                $this->state,
                $this->zipCode,
                $this->country,
                $this->email
            );

            $sdkBinaryGateways->setOrder(
                $this->trackingNumber,
                "Change address request generated - ".$this->invoiceNumber,
                0,
                0,
                $this->invoiceNumber,
                ""
            );

            $paymentResponse = $sdkBinaryGateways->doAuth($this->amount,$this->cardNumber,$this->cardExpiry,$this->cardCVC);
            //$paymentResponse = $sdkBinaryGateways->doSale($this->amount,$this->cardNumber,$this->cardExpiry,$this->cardCVC);
            if(!isset($paymentResponse["response"]))
                throw new Exception("Payment failed - No response");

            if($paymentResponse["response"] != 1){
                throw new Exception("Payment failed - ".$paymentResponse["responsetext"]);
            }

            return response(200,"Payment successfully",$paymentResponse);

        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    private function paymentAuthorize(){
        include_once __DIR__."/../sdk/sdkPaymentAuthorize.php";
        $sdkPaymentAuthorize = new sdkPaymentAuthorize();

        try{

            $sdkPaymentAuthorize->setLogin($this->accessKey,$this->secretKey);
            $paymentResponse = $sdkPaymentAuthorize->doPayment($this->cardNumber,$this->cardExpiry,$this->cardCVC,$this->amount,$this->trackingNumber,$this->trackingNumber);

            if(!$paymentResponse["status"]){
                throw new Exception($paymentResponse["message"]);
            }
            return response(200,"Payment proceed successfully");

        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }



}