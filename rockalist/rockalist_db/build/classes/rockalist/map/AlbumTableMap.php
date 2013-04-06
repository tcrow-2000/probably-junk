<?php



/**
 * This class defines the structure of the 'album' table.
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
class AlbumTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'rockalist.map.AlbumTableMap';

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
        $this->setName('album');
        $this->setPhpName('Album');
        $this->setClassname('Album');
        $this->setPackage('rockalist');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('year', 'Year', 'INTEGER', false, null, null);
        $this->addForeignKey('artist_id', 'ArtistId', 'INTEGER', 'artist', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Artist', 'Artist', RelationMap::MANY_TO_ONE, array('artist_id' => 'id', ), null, null);
        $this->addRelation('Track', 'Track', RelationMap::ONE_TO_MANY, array('id' => 'album_id', ), null, null, 'Tracks');
    } // buildRelations()

} // AlbumTableMap
