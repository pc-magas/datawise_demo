<?php
/**
 * Error Code Conventions
 * Each Error Code will be consisted of 3 digits:
 * 1. The first digit will be either 1 for file errors or 2 for Dropbox API Error
 * 2. The Secvond digit will be either 1 for io error or 2 for security error
 * 3. The third digit will be an incremental number for error
 * 
 * For example if a file does not have the correct permissions the error will be 121 and if it cannot be found will be 112 
 */

namespace PCMagas\Exceptions;

class ErrorCodes {
 // FileIO $Error Codes
 const FILE_NOT_FOUND=111;
 const FILE_NOR_CORRECT_PERMISSIONS=122;

 // DropBoxApiErrorCode
 const USER_NOT_AUTHORISED=221;
 const MISFORMATTED_API_CALL=212;
}