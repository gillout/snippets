<?php

class Manager
{
    /**
     * @var PDO
     */
    protected $_db; // Instance de PDO

    /**
     * LanguageManager constructor.
     * @param PDO $_db
     */
    public function __construct(PDO $_db)
    {
        $this->_db = $_db;
    }

    // $data = [id=>1, label=>PHP]
    protected function hydrate(array $data, $obj)
    {
        foreach ($data as $key => $value) { // => [snippetId][title][language][code][dateCrea][comment][requirement][userId]
            $method = "set" . ucfirst($key); // setSnippetId, setTitle, setLanguage, setCode, setDateCrea, setComment, setRequirement, setUserId
            if (method_exists($obj, $method)) {
                $obj->$method($value);
            }
        }
        return $obj;
    }

}
