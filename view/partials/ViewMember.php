<?php
class ViewMember{

  private $memberId;
  private $firstname;
  private $lastname;
  private $personalNumber;
  private $boats;

  public function __construct($memberDetails, $memberBoats){
    $this->memberId = $memberDetails['ID'];
    $this->firstname = $memberDetails['firstName'];
    $this->lastname = $memberDetails['lastName'];
    $this->personalNumber = $memberDetails['passportNumber'];
    $this->boats = $memberBoats;
  }

  private function boatlist(){
    $boats = $this->boats;

    if(!count($boats)){
      return "No boats";
    }
    //
    $str = "<dl>";
    for($i = 0; $i < count($boats); $i++){
      $id = $boats[$i]['ID'];
      $type = $boats[$i]['type'];
      $length = $boats[$i]['length'];

      $str .= "
      <dt>Boat {$i}:<br>
        <a href='?action=editBoat&boatId={$id}'>edit</a><br>
        <a href='?action=deleteBoat&boatId={$id}'>Delete</a>
      </dt>
      <dd>Type:&nbsp;&nbsp;&nbsp;{$type}</dd>
      <dd>Length: {$length}</dd>
      <dd>Id:&nbsp;&nbsp;&nbsp;&nbsp; {$id}</dd>
      ";
    }
    return $str . "</dl>";
  }

  public function show(){
    $boatlist = $this->boatlist();
    return "
    <div>
      <span>name: {$this->firstname} {$this->lastname}</span>
      <span>Personal number: {$this->personalNumber}</span>
      {$boatlist}
    </div>
    <a href='?action=deleteMember&memberId={$this->memberId}'>Delete member</a>
    <a href='?action=updateMember&id={$this->memberId}'>Update member info</a>
    <a href='?action=addBoat&memberId={$this->memberId}'>Add a boat</a>
    ";
  }
}
