<?php
require_once("constants.php");
require_once("IDBLink.php");

class DatabaseConnector implements IDBLink {

  private $dbLink = null;

  /**
   * @return mysqli Returns the database link!
   */
  public function getDBLink() {
    if($this->isLinkValid($this->dbLink)) {
      return $this->dbLink;
    }
    else {
      $this->dbLink = $this->getNewDBLink();
      return $this->dbLink;
    }
  }

  /**
   * @return mysqli|NULL Returns a mysqli object or NULL.
   */
  private function getNewDBLink() {
    $newLink = mysqli_connect(Config::$DB_HOST_NAME,
                              Config::$DB_USER_NAME,
                              Config::$DB_USER_PASSWORD,
                              Config::$DB_DB_NAME);

    return $newLink;
  }

  /**
   * @param $dbLink mysqli The db link to be validated.
   * @return bool Returns true if the object is an instance of the mysqli class.
   */
  private function isLinkValid($dbLink) {
    $isValid = false;

    if(isset($dbLink) && $dbLink instanceof mysqli && $dbLink->connect_errno === 0) {
      $isValid = true;
    }

    return $isValid;
  }

}

// Lazy "hack" so we dont have to refactor all the .php files.
$dbconnector = new DatabaseConnector();
$db = $dbconnector->getDBLink();
