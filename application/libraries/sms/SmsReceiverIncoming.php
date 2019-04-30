<?php


class SmsReceiverIncoming{
    private $date; 
    private $from;
    private $id;
    private $linkId;
    private $text;
    private $to;

    /*
        decode the json data an get them to an array
        Get data from Json objects
        check the validity of the response
    **/
    public function __construct(){
        $array = json_decode(file_get_contents('php://input'),TRUE);
        $this->from = $array['from'];
        $this->text = $array['text'];
        $this->id = $array['id'];
        $this->linkId = $array['linkId'];
        $this->to = $array['to'];
        $this->date = $array['date'];
        if ($this->from==null && $this->text==null) {
            throw new Exception("Some of the required parameters are not provided");
        } else {
            // Success received response
            $responses = array("statusCode" => "200", "statusDetail" => "Success");
            header("Content-type: application/json");
        //    echo json_encode($responses);
        }
    }

    /*
        Define getters to return receive data
    **/

    public function getAddress(){
        return $this->from;
    }

    public function getMessage(){
        return $this->text;
    }

    public function getID(){
        return $this->id;
    }

    public function getLinkID(){
        return $this->linkId;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTo(){
        return $this->to;
    }

}

?>