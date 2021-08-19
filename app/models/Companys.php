<?php
namespace App\Models;
class Companys extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $company_id;

    /**
     *
     * @var string
     */
    public $company_name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("companys");

        //relationships
        $this->hasMany(
            'company_id',
            Users::class,
            'company_id',
            [
                'alias'    => 'users',
                'reusable' => true,
            ]
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Companys[]|Companys|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Companys|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
