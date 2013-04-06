<?php



/**
 * This class defines the structure of the 'playlisttrack' table.
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
class PlayListTrackTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'rockalist.map.PlayListTrackTableMap';

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
        $this->setName('playlisttrack');
        $this->setPhpName('PlayListTrack');
        $this->setClassname('PlayListTrack');
        $this->setPackage('rockalist');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('synced', 'Synced', 'BOOLEAN', true, 1, false);
        $this->addForeignKey('playlist_id', 'PlaylistId', 'INTEGER', 'playlist', 'id', true, null, null);
        $this->addForeignKey('track_id', 'TrackId', 'INTEGER', 'track', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PlayList', 'PlayList', RelationMap::MANY_TO_ONE, array('playlist_id' => 'id', ), null, null);
        $this->addRelation('Track', 'Track', RelationMap::MANY_TO_ONE, array('track_id' => 'id', ), null, null);
    } // buildRelations()

} // PlayListTrackTableMap
