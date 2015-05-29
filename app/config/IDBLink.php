<?php
/**
 * This interface makes out the contract for ImageManagers dependencies
 */

interface IDBLink {

    /**
     * @return mysqli Returns the database link.
     */
    public function getDBLink();

}