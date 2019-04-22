<?php
namespace PCMagas\Exceptions;

class FileNotFoundException extends Exception {

    /**
     * @param String $file The path that Does not exist
     */
    public function __construct($file){
      parent::__construct("The file ${file} does not exist.", ErrorCodes::FILE_NOT_FOUND);
    }

}