<?php



/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.rockalist.map
 */
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'rockalist.map.UserTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('User');
        $this->setPackage('rockalist');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addPrimaryKey('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 128, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('subscribed', 'Subscribed', 'BOOLEAN', true, 1, false);
        $this->addColumn('registered', 'Registered', 'BOOLEAN', true, 1, false);
        $this->addColumn('uniqueid', 'Uniqueid', 'VARCHAR', true, 255, null);
        $this->addColumn('date_added', 'DateAdded', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_login', 'LastLogin', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Track', 'Track', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Tracks');
        $this->addRelation('Friend', 'Friend', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Friends');
        $this->addRelation('Playlist', 'PlayList', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Playlists');
    } // buildRelations()

} // UserTableMap
