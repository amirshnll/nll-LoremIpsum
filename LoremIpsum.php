<?php

/**
 * Lorem Ipsum Generator
 *
 * PHP version 5.3+
 *
 * Licensed under The MIT License.
 * Redistribution of these files must retain the above copyright notice.
 *
 * @author    Amir Shokri <amirsh.nll@gmail.com>
 * @copyright Copyright 2021 Amir Shokri
 * @license   http://www.opensource.org/licenses/mit-license.html
 * @link      https://github.com/amirshnll/Lorem-Ipsum
 */

namespace amirshnll;

class LoremIpsum
{
    
    /* Private Member Member */
    /**
     * Data Path
     *
     * JSON Data File Folder Path
     *
     * @access private
     * @var    string
     */
    private $dataPath = "data/";

    /**
     * Data File Name
     *
     * JSON Data File Name
     *
     * @access private
     * @var    string
     */
    private $dataFileName = "data.json";

    /**
     * Data
     *
     * Raw Data JSON File
     *
     * @access private
     * @var    array
     */
    private $data = array();


    /**
     * Data Exists
     *
     * check JSON File Exists
     *
     * @access private
     * @return boolean   true = File is Exists, false = File is not Exists
     */
    private function dataExists() {
        if( file_exists( $this->dataPath . $this->dataFileName ) )
            return true;
        return false;
    }

    /**
     * Read Data
     *
     * Read JSON Data From File
     *
     * @access private
     * @return mixed   array or null
     */
    private function readData() {
        $loremData = file_get_contents($this->dataPath . $this->dataFileName);
        if($this->isJson($loremData))
            return json_decode($loremData, true);
        return null;
    }

    /**
     * Word Limiter
     *
     * Words Count Limiter From String
     *
     * @access private
     * @param  string   $string string text
     * @param  integer  $limit how many words in result string
     * @return string   generated lorem ipsum word
     */
    private function wordLimiter($string, $limit = 1) {
        if ( trim( $string ) === '' )
            return $string;
        preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $string, $matches);
        return rtrim( $matches[0] );
    }

    /**
     * is Json
     *
     * JSON Data Validation
     *
     * @access private
     * @param  string   $jsonData string For Check json Validation
     * @return boolean  true = is valid, false = not valid
     */
    private function isJson($jsonData) {
        return ((is_string($jsonData) &&
            (is_object(json_decode($jsonData)) ||
            is_array(json_decode($jsonData))))) ? true : false;
    }

    /**
     * check Language Exists
     *
     * check Language Exists for generate lorem ipsum
     *
     * @access private
     * @param  string   $language language short name
     * @return boolean  true = language is Exists, false = language is not Exists
     */
    private function checkLanguageExists($language) {
        if( isset($this->data[$language]) )
            return true;
        else
            return false;
    }

    /* Public Class Member */
    /**
     * __construct
     *
     * class constructor
     *
     * @return boolean  true = class have'nt problem, false = class have problem, 
     */
    function __construct() {
        if( $this->dataExists() ) {
            $this->data = $this->readData();
            if(!is_null($this->data))
                return true;
        }
        return false;
    }
    
    /**
     * Word
     *
     * Generates a single word of lorem ipsum.
     *
     * @access public
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return string   generated lorem ipsum word
     */
    public function word($language = 'en', $tags = false) {
        return $this->words(1, $tags, $language, false);
    }

    /**
     * Words Array
     *
     * Generates an array of lorem ipsum words.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return array    generated lorem ipsum words
     */
    public function wordsArray($length = 1, $language = 'en', $tags = false) {
        return $this->words($length, $tags, $language, true);
    }

    /**
     * Words
     *
     * Generates words of lorem ipsum.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @param  boolean  $array whether an array or a string should be returned
     * @return mixed    string or array of generated lorem ipsum words
     */
    public function words($length = 1, $tags = false, $language = 'en', $array = false) {
        
        if(!is_numeric($length) || $length < 1)
            $length = 1;

        $language = strtolower(ltrim(rtrim($language)));
        if(!$this->checkLanguageExists($language))
            $language = 'en';

        $string = explode(" ", $this->data[$language]);
        if(count($string) < $length) {
            $limit = round($length / count($string)) + 1;
            $string = implode(" ", $string);
            $newString = "";
            for ($i=0; $i < $limit; $i++)
                $newString .= $string;

            $string = $newString;
            unset($newString, $limit);
        }
        else
            $string = $this->data[$language];

        if($tags) {
            if($array) {
                $resultString = explode(" ", $this->wordLimiter($string, $length));
                $resultArray = array();
                $resultArray[0] = "<$tags>" . $resultString[0] . "</$tags>";
                for ($i=1; $i < $length; $i++)
                    $resultArray[$i] = "<$tags>" . $resultString[$i] . "</$tags>";

                unset($resultString);
                return $resultArray;
            }
            else
                return "<$tags>" . $this->wordLimiter($string, $length) . "</$tags>";
        }
        else
            if($array)
                return explode(" ", $this->wordLimiter($string, $length));
            else
                return $this->wordLimiter($string, $length);

    }

    /**
     * Sentence
     *
     * Generates a full sentence of lorem ipsum.
     *
     * @access public
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return array    generated lorem ipsum sentences
     */
    public function sentence($language = 'en', $tags = false) {
        return $this->sentences(1, $tags, $language, false);
    }

    /**
     * Sentences
     *
     * Generates sentences of lorem ipsum.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return mixed    string or array of generated lorem ipsum sentences
     */
    public function sentencesArray($length = 1, $language = 'en', $tags = false) {
        return $this->sentences($length, $tags, $language, true);
    }

    /**
     * Sentences
     *
     * Generates sentences of lorem ipsum.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @param  boolean  $array whether an array or a string should be returned
     * @return mixed    string or array of generated lorem ipsum sentences
     */
    public function sentences($length = 1, $tags = false, $language = 'en', $array = false) {
        if(!is_numeric($length) || $length < 1)
            $length = 1;

        $language = strtolower(ltrim(rtrim($language)));
        if(!$this->checkLanguageExists($language))
            $language = 'en';

        $string = explode(".", $this->data[$language]);
        if(count($string) < $length) {
            $limit = round($length / 2) + 1;
            $string = implode(".", $string);
            $newString = "";
            for ($i=0; $i < $limit; $i++)
                $newString .= $string;

            $string = $newString;
            unset($newString, $limit);
        }
        else
            $string = $this->data[$language];

        if($array) {
            $resultString = explode(".", $string);
            $resultArray = array();

            if($tags) {
                $resultArray[0] = "<$tags>" . $resultString[0] . "</$tags>";
                for ($i=1; $i < $length; $i++)
                    $resultArray[$i] = "<$tags>" . $resultString[$i] . "</$tags>";
            } else {
                $resultArray[0] = $resultString[0];
                for ($i=1; $i < $length; $i++)
                    $resultArray[$i] = $resultString[$i];
            }

            unset($resultString);
            return $resultArray;
        }
        else {
            $resultString = explode(".", $string);
            if($tags) {
                $result = "<$tags>";
                for ($i=0; $i < $length; $i++)
                    $result .= $resultString[$i];
                $result .= "</$tags>";
            } else {
                $result = "";
                for ($i=0; $i < $length; $i++)
                    $result .= $resultString[$i];
            }

            return $result;
        }
    }

    /**
     * Paragraph
     *
     * Generates a full paragraph of lorem ipsum.
     *
     * @access public
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return string   generated lorem ipsum paragraph
     */
    public function paragraph($language = 'en', $tags = false) {
        return $this->paragraphs(1, $tags, $language, false);
    }

    /**
     * Paragraph Array
     *
     * Generates an array of lorem ipsum paragraphs.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @return array    generated lorem ipsum paragraphs
     */
    public function paragraphsArray($length = 1, $language = 'en', $tags = false) {
        return $this->paragraphs($length, $tags, $language, true);
    }

    /**
     * Paragraphss
     *
     * Generates paragraphs of lorem ipsum.
     *
     * @access public
     * @param  integer  $length how many words to generate
     * @param  string   $tags string of HTML tags to wrap output with
     * @param  string   $language language short name
     * @param  boolean  $array whether an array or a string should be returned
     * @return mixed    string or array of generated lorem ipsum paragraphs
     */
    public function paragraphs($length = 1, $tags = false, $language = 'en', $array = false) {
        if(!is_numeric($length) || $length < 1)
            $length = 1;

        $language = strtolower(ltrim(rtrim($language)));
        if(!$this->checkLanguageExists($language))
            $language = 'en';

        $string = $this->data[$language];

        if($array) {
            $resultArray = array();
            if($tags) {
                $resultArray[0] = "<$tags>" . $string . "</$tags>";
                for ($i=1; $i < $length; $i++)
                    $resultArray[$i] = "<$tags>" . $string . "</$tags>";
            } else {
                $resultArray[0] = $string;
                for ($i=1; $i < $length; $i++)
                    $resultArray[$i] = $string;
            }
            return $resultArray;
        }
        else {
            if($tags) {
                $result = "<$tags>";
                for ($i=0; $i < $length; $i++)
                    $result .= $string;
                $result .= "</$tags>";
            } else {
                $result = "";
                for ($i=0; $i < $length; $i++)
                    $result .= $string;
            }

            return $result;
        }
    }
}