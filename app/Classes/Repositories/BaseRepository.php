<?php namespace LeadAssurance\Classes\Repositories;

/**
 * Class BaseRepository
 */
class BaseRepository
{
    /**
     * @return null
     */
    public function getClassName() 
    {
        return null;
    }

    /**
     * @return mixed
     */
    private function getInstance()
    {
        $className = $this->getClassName();
        return new $className();
    }

    /**
     * @param $entity
     * @param $type
     * @return string
     */
    private function getEventClass($entity, $type)
    {
        return 'LeadAssurance\Events\\' . ucfirst($entity->getEntityType()) . 'Was' . $type;
    }
    
}
